<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkProcessResource;
use App\Models\WorkProcess;
use App\Traits\ApiResponse;

class WorkProcessController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $processes = WorkProcess::ordered()->get();

        return $this->successResponse(
            WorkProcessResource::collection($processes),
            'work processes fetched successfully',
            200
        );
    }
}
