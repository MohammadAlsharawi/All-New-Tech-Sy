<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequests\FilterServiceFilterRequest;
use App\Services\ServiceService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponse;

    protected ServiceService $service;

    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }

    public function index(FilterServiceFilterRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $news = $this->service->index($validatedData);
            return $this->successResponse($news, 'All  services retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

}
