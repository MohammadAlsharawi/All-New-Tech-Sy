<?php

namespace App\Services;

use App\Models\LatestNews;
use Illuminate\Support\Facades\Storage;

class LatestNewsService
{
    public function index()
    {
        try {
            return LatestNews::all()->map(function ($update) {
                return [
                    'id'          => $update->id,
                    'title'       => $update->title,
                    'content'     => $update->content,
                    'image'       => Storage::disk('public')->url($update->image),
                    'created_at'  => $update->created_at,
                    'updated_at'  => $update->updated_at,
                ];
            });
        } catch (\Exception $e) {
            throw new \Exception("Failed to retrieve news: " . $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            $update = LatestNews::findOrFail($id);

            return [
                'id'          => $update->id,
                'title'       => $update->title,
                'content'     => $update->content,
                'image'       => Storage::disk('public')->url($update->image),
                'created_at'  => $update->created_at,
                'updated_at'  => $update->updated_at,
            ];
        } catch (\Exception $e) {
            throw new \Exception("News not found: " . $e->getMessage());
        }
    }
}
