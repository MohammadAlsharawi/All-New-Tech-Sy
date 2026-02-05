<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectSimpleResource;
use App\Services\ProjectService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }
    public function simple()
    {
        try {
            $projects = $this->service->getAllSimple();

            return $this->successResponse(
                ProjectSimpleResource::collection($projects),
                'Projects retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function index()
    {
        try {
            $projects = $this->service->getAllWithDetails();

            return $this->successResponse(
                ProjectResource::collection($projects),
                'Projects retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $project = $this->service->getById($id);

            return $this->successResponse(
                new ProjectResource($project),
                'Project retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 404);
        }
    }
}
