<?php

namespace App\Services;

use App\Models\BudgetRange;
use App\Models\PreferredContactMethod;
use App\Models\PropertyType;
use App\Models\QuoteRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class RequestAQuoteService
{
    public function getFormData()
    {
        try {
            return [
                'services' => Service::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->title,
                ]),
                'propertyType' => PropertyType::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->name,
                ]),
                'preferredContactMethod' => PreferredContactMethod::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->name,
                ]),
                'budgetRange' => BudgetRange::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->range,
                ]),
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function store($data){
        try{
            $QuoteRequest = QuoteRequest::create($data);
            $response = $QuoteRequest
                ->load(['budgetRange','preferredContactMethod','service','propertyType'])
                ->toArray();

            if ($QuoteRequest->file) {
                $response['file'] = Storage::disk('public')->url($QuoteRequest->file);
            }
            if ($QuoteRequest->service) {
                $response['service']['image'] = Storage::disk('public')->url($QuoteRequest->service->image);
            }
            return $response;
        }catch(\Exception $e){
            throw new \Exception("Failed to create a request for a quote : " . $e->getMessage());
        }
    }
}
