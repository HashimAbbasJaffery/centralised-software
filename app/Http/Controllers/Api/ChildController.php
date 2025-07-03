<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use App\Services\ImageService;

class ChildController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'child_name' => 'required|string|max:255',
            'member_id' => 'required',
            'membership_id' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_issue' => 'required|date',
            'validity' => 'required|date',
            'blood_group' => 'required',
            'cnic' => 'required',
            'profile_pic' => 'nullable|image|max:2048', // 2MB limit
        ]);

    if ($request->hasFile('profile_pic')) {
        $filePath = app(ImageService::class)->upload($request->file("profile_pic"));
        $validated['profile_pic_path'] = $filePath;
    }

    // Save to DB (example)
    $child = Child::create($validated);

    return response()->json([
        'message' => 'Child created successfully!',
        'data' => $child
    ]);
    }
}
