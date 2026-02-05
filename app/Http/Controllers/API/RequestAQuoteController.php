<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAQuoteRequests\StoreRequestAQuote;
use App\Services\RequestAQuoteService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RequestAQuoteController extends Controller
{
    use ApiResponse;

    protected RequestAQuoteService $service;

    public function __construct(RequestAQuoteService $service)
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
    public function store(StoreRequestAQuote $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('file')) {
                $validatedData['file'] = $request->file('file')->store('files', 'public');
            }
            $contactUS = $this->service->store($validatedData);
            return $this->successResponse($contactUS, 'Request for a quote created successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
