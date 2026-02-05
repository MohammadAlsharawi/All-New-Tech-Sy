<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequests\StoreContactUs;
use App\Services\ContactUsService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use ApiResponse;

    protected ContactUsService $service;

    public function __construct(ContactUsService $service)
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
    public function store(StoreContactUs $request)
    {
        try {
            $validatedData = $request->validated();
            $contactUS = $this->service->store($validatedData);
            return $this->successResponse($contactUS, 'contact us created successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
