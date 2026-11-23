---
trigger: glob
globs: "tests/**/*.php, phpunit.xml, pest.php"
description: Testing standards with Pest/PHPUnit for Laravel: feature tests, validation, authorization, factories, fakes.
---

# Testing Standard

Use the framework already in the project (Pest preferred for new projects, PHPUnit otherwise). Check `composer.json` and existing tests first.

## 1. What to test

| Priority | Test type | Examples |
|---|---|---|
| High | **Feature tests** (HTTP) | CRUD flows, redirects, flash messages, pagination, public pages render |
| High | **Authorization** | Guests redirected, unauthorized users get 403, owners-only access |
| High | **Validation** | Required/unique/format failures return errors and don't write to DB |
| Medium | **Services/Actions** (unit-ish) | Business rules, transactions, file handling |
| Medium | **Models** | Scopes, accessors, casts, relationships |
| Low | Pure unit tests | Helpers, value objects, enums |

Every new route gets at least: happy path, validation failure, and unauthorized case.

## 2. Conventions

- Test names describe behavior: `it('creates a project with valid data')`, `it('rejects duplicate slugs')`.
- Arrange → Act → Assert; one behavior per test.
- Use **factories** and states, never hand-written inserts with magic values.
- Use `RefreshDatabase` (or `LazilyRefreshDatabase`). Do not depend on seed data unless the test seeds it.
- Authenticate with `actingAs($user)`; create roles/permissions via factories/states.
- Use fakes: `Storage::fake('public')`, `Mail::fake()`, `Notification::fake()`, `Queue::fake()`, `Event::fake()`, `Http::fake()`.
- Assert the **database** (`assertDatabaseHas/Missing`, `assertSoftDeleted`) and the **response** (`assertRedirect`, `assertSessionHasErrors`, `assertSee`, `assertForbidden`).
- Do not mock Eloquent models or the database; use the real test DB.
- Tests must be deterministic: freeze time (`$this->travelTo()`), avoid randomness, avoid network.

## 3. Example (Pest)

```php
use App\Models\{Project, User};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('lets an admin create a project', function () {
    Storage::fake('public');
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->post(route('admin.projects.store'), [
            'title' => 'My Project',
            'slug' => 'my-project',
            'status' => 'draft',
            'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        ])
        ->assertRedirect(route('admin.projects.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('projects', ['slug' => 'my-project']);
});

it('rejects invalid data', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.projects.store'), [])
        ->assertSessionHasErrors(['title', 'slug']);
});

it('forbids guests', function () {
    $this->get(route('admin.projects.index'))->assertRedirect(route('login'));
});
```

## 4. Bug-fix workflow

1. Reproduce with a **failing test**.
2. Fix the code.
3. Confirm the test passes and the suite stays green.

## 5. Running

- `php artisan test` (or `./vendor/bin/pest`). Use `--filter` for focus, `--parallel` for speed.
- Report the real result: counts of passed/failed, or "not run" with the reason.
- Never delete, skip, or weaken a failing test to make the suite pass without explaining why.
