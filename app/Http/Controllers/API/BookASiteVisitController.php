<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookASiteVisitRequests\BookASiteVisitRequest;
use App\Services\BookASiteVisitService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BookASiteVisitController extends Controller
{
    use ApiResponse;

    protected BookASiteVisitService $service;

    public function __construct(BookASiteVisitService $service)
    {
        $this->service = $service;
    }
    public function formData()
    {
        try{
            $data = $this->service->getFormData();
            return $this->successResponse($data, 'Form data loaded successfully');
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    public function store(BookASiteVisitRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $contactUS = $this->service->store($validatedData);
            return $this->successResponse($contactUS, 'Book a visit created successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
