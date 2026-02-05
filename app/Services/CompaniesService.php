<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompaniesService
{
    public function index(){
        try{
            return Company::all()->map(function ($update) {
                return [
                    'id'          => $update->id,
                    'priority' => $update->priority,
                    'logo'  => Storage::disk('public')->url($update->logo),
                    'created_at'  => $update->created_at,
                    'updated_at'  => $update->updated_at,
                ];
            });
        }catch(\Exception $e){
            throw new \Exception("Failed to retrieve companies: " . $e->getMessage());
        }
    }
}
