<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\UpdateSkillRequest;
use App\Models\Skill;

class SkillAdminController extends Controller
{
    public function index()
    {
        $skills = Skill::ordered()->get()->groupBy('category');

        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => new Skill]);
    }

    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->validated());

        return redirect()->route('admin.skills.index')->with('success', 'Skill added.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted.');
    }
}
