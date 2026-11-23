---
name: crud-module
description: Step-by-step playbook and reference code for building a complete Laravel + Blade CRUD module (migration, model, enum, factory, requests, policy, service, controller, routes, views, tests). Use when asked to add a new resource/module/admin section.
---

# CRUD Module Playbook

Example resource: **Project** (`projects`). Replace names/fields. **Always inspect the existing code first and match its conventions**; the code below is a reference shape, not a mandate.

## Order of work

1. Migration → 2. Enum → 3. Model → 4. Factory/Seeder → 5. FormRequests → 6. Policy → 7. Service (only if needed) → 8. Controller → 9. Routes → 10. Views → 11. Sidebar link → 12. Tests → 13. Pint + test run.

## 1. Migration

```php
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('summary')->nullable();
    $table->longText('description')->nullable();
    $table->string('cover_image')->nullable();
    $table->string('status', 20)->default('draft')->index();
    $table->boolean('is_featured')->default(false);
    $table->unsignedInteger('sort_order')->default(0);
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->index(['status', 'published_at']);
});
```

## 2. Enum

```php
enum ProjectStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return __('projects.status.'.$this->value);
    }
}
```

## 3. Model

```php
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'cover_image',
        'status', 'is_featured', 'sort_order', 'published_at',
    ];

    protected function casts(): array   // use $casts on Laravel < 11
    {
        return [
            'status' => ProjectStatus::class,
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', ProjectStatus::Published);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    protected function coverUrl(): Attribute
    {
        return Attribute::get(fn () => $this->cover_image
            ? Storage::disk('public')->url($this->cover_image)
            : null);
    }
}
```

## 4. Factory

```php
public function definition(): array
{
    $title = fake()->unique()->sentence(3);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'summary' => fake()->sentence(),
        'status' => ProjectStatus::Draft,
        'is_featured' => false,
        'sort_order' => 0,
    ];
}

public function published(): static
{
    return $this->state(fn () => [
        'status' => ProjectStatus::Published,
        'published_at' => now(),
    ]);
}
```

## 5. FormRequests

```php
class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', Project::class) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('title', '')),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('projects', 'slug')],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::enum(ProjectStatus::class)],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
```

`UpdateProjectRequest`: same rules, but `authorize()` uses `can('update', $this->route('project'))` and the slug rule is `Rule::unique('projects', 'slug')->ignore($this->route('project'))`.

## 6. Policy

```php
class ProjectPolicy
{
    public function viewAny(User $user): bool { return $user->is_admin; }
    public function create(User $user): bool  { return $user->is_admin; }
    public function update(User $user, Project $project): bool { return $user->is_admin; }
    public function delete(User $user, Project $project): bool { return $user->is_admin; }
}
```
Adapt to the project's role system. Policies named `{Model}Policy` are auto-discovered.

## 7. Service (when files/multi-writes are involved)

```php
class ProjectService
{
    public function create(array $data, ?UploadedFile $cover = null): Project
    {
        return DB::transaction(function () use ($data, $cover) {
            if ($cover) {
                $data['cover_image'] = $cover->store('projects', 'public');
            }
            return Project::create($data);
        });
    }

    public function update(Project $project, array $data, ?UploadedFile $cover = null): Project
    {
        return DB::transaction(function () use ($project, $data, $cover) {
            if ($cover) {
                if ($project->cover_image) {
                    Storage::disk('public')->delete($project->cover_image);
                }
                $data['cover_image'] = $cover->store('projects', 'public');
            }
            $project->update($data);
            return $project;
        });
    }

    public function delete(Project $project): void
    {
        $project->delete(); // soft delete; remove files only on forceDelete
    }
}
```

## 8. Controller

```php
class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $projects) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Project::class);

        $items = Project::query()
            ->when($request->string('q')->toString(), fn ($q, $term) => $q->where('title', 'like', "%{$term}%"))
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('admin.projects.index', compact('items'));
    }

    public function create(): View
    {
        $this->authorize('create', Project::class);
        return view('admin.projects.create', ['project' => new Project()]);
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->projects->create($request->safe()->except('cover_image'), $request->file('cover_image'));

        return redirect()->route('admin.projects.index')->with('success', __('projects.created'));
    }

    public function edit(Project $project): View
    {
        $this->authorize('update', $project);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->projects->update($project, $request->safe()->except('cover_image'), $request->file('cover_image'));

        return redirect()->route('admin.projects.index')->with('success', __('projects.updated'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);
        $this->projects->delete($project);

        return redirect()->route('admin.projects.index')->with('success', __('projects.deleted'));
    }
}
```

## 9. Routes

```php
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projects', ProjectController::class)->except('show');
});
```

## 10. Views

- `index.blade.php`: page header + "New" button, search form, `<x-admin.table>`, `@forelse` rows, `@can` actions, empty state, `{{ $items->links() }}`.
- `create.blade.php` / `edit.blade.php`: include `_form.blade.php` with `$project`.
- `_form.blade.php`: `@csrf`, `@method` on edit, `old()`, `@error`, `enctype="multipart/form-data"`, image preview.
- Delete = small form with `@method('DELETE')` and a confirm step.

## 11. Tests

Use the Pest examples in the `testing` rule: create (happy), validation errors, guest redirect, non-admin forbidden, update with unique-slug ignore, delete (soft), upload stored via `Storage::fake`.

## Done when

Migration runs up/down, no N+1 on index, every route authorized, tests pass, Pint clean, sidebar link added, lang strings added.
