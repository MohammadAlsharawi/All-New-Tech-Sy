<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CompaniesService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    use ApiResponse;

    protected CompaniesService $service;

    public function __construct(CompaniesService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $news = $this->service->index();
            return $this->successResponse($news, 'All companies retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
