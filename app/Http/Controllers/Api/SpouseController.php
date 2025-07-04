<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpouseController extends Controller
{
    public function store(Request $request) {
         $validated = $request->validate([
            'spouse_name' => 'required|string|max:255',
            'member_id' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_issue' => 'required|date',
            'validity' => 'required|date',
            'blood_group' => 'required',
            'cnic' => 'required',
            'picture' => 'nullable|image|max:2048', // 2MB limit
        ]);

    if ($request->hasFile('picture')) {
        $directory = "uploads/spouse_pictures";
        $fileName = $request->spouse_name . "_" . time() . "." . $request->picture->extension();
            
        Storage::disk("public")->putFileAs($directory, $request->picture, $fileName);
        $filePath = $directory . "/" . $fileName;
           
        $validated['picture'] = $filePath;
    } else {
        $validated["picture"] = "profile_pictures/default-user.png";
    }

    // Save to DB (example)
    $spouse = Spouse::create($validated);

    return response()->json([
        'message' => 'Spouse created successfully!',
        'data' => $spouse
    ]);
    }
}
