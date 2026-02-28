<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LocationService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    use ApiResponse;

    protected LocationService $service;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        try {
            $news = $this->service->index();
            return $this->successResponse($news, 'All locations retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
