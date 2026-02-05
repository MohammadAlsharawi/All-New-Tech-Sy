<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponse;
    protected ReviewService $service;

    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        try {
            $reviews = $this->service->index();
            return $this->successResponse($reviews, 'All reviews retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $review = $this->service->show($id);
            return $this->successResponse($review, 'Review retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 404);
        }
    }
}
