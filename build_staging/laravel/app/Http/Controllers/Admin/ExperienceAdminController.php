<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExperienceRequest;
use App\Http\Requests\Admin\UpdateExperienceRequest;
use App\Models\Experience;

class ExperienceAdminController extends Controller
{
    public function index()
    {
        $experiences = Experience::ordered()->get()->groupBy('type');

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.form', ['experience' => new Experience]);
    }

    public function store(StoreExperienceRequest $request)
    {
        Experience::create($request->validated());

        return redirect()->route('admin.experiences.index')->with('success', 'Entry added.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());

        return redirect()->route('admin.experiences.index')->with('success', 'Entry updated.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Entry deleted.');
    }
}
