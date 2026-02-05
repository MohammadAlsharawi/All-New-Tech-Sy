<?php

namespace App\Services;

use App\Models\Review;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Storage;

class ReviewService
{
    public function index(){
        try{
            return Review::all()->map(function ($update) {
                return [
                    'id'          => $update->id,
                    'description' => $update->description,
                    'rating'      => $update->rating,
                    'user_image'  => Storage::disk('public')->url($update->user_image),
                    'created_at'  => $update->created_at,
                    'updated_at'  => $update->updated_at,
                ];
            });
        }catch(\Exception $e){
            throw new \Exception("Failed to retrieve reviews: " . $e->getMessage());
        }
    }
    public function show(int $id)
    {
        try {
            $review = Review::findOrFail($id);

            return [
                'id'          => $review->id,
                'description' => $review->description,
                'rating'      => $review->rating,
                'user_image'  => Storage::disk('public')->url($review->user_image),
                'created_at'  => $review->created_at,
                'updated_at'  => $review->updated_at,
            ];
        } catch (\Exception $e) {
            throw new \Exception("Review not found: " . $e->getMessage());
        }
    }
}
