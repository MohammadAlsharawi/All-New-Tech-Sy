<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getAllSimple()
    {
        try {
            return Project::all();
        } catch (\Exception $e) {
            throw new \Exception("Failed to retrieve projects: " . $e->getMessage());
        }
    }

    public function getAllWithDetails()
    {
        try {
            return Project::with(['service', 'propertyType'])->get();
        } catch (\Exception $e) {
            throw new \Exception("Failed to retrieve projects with details: " . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            return Project::with(['service', 'propertyType'])->findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception("Project not found or failed to retrieve: " . $e->getMessage());
        }
    }
}
