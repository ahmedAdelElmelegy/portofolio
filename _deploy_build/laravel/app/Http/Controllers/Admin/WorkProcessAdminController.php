<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkProcessRequest;
use App\Http\Requests\Admin\UpdateWorkProcessRequest;
use App\Models\WorkProcess;

class WorkProcessAdminController extends Controller
{
    public function index()
    {
        $processes = WorkProcess::ordered()->get();

        return view('admin.work-processes.index', compact('processes'));
    }

    public function create()
    {
        return view('admin.work-processes.form', ['workProcess' => new WorkProcess]);
    }

    public function store(StoreWorkProcessRequest $request)
    {
        WorkProcess::create($request->validated());

        return redirect()->route('admin.work-processes.index')->with('success', 'Step added.');
    }

    public function edit(WorkProcess $workProcess)
    {
        return view('admin.work-processes.form', compact('workProcess'));
    }

    public function update(UpdateWorkProcessRequest $request, WorkProcess $workProcess)
    {
        $workProcess->update($request->validated());

        return redirect()->route('admin.work-processes.index')->with('success', 'Step updated.');
    }

    public function destroy(WorkProcess $workProcess)
    {
        $workProcess->delete();

        return redirect()->route('admin.work-processes.index')->with('success', 'Step deleted.');
    }
}
