<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class UploadImage
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function upload($base64Image, $folderPath) {
        
        if(preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return response()->json(['error' => 'Invalid image type'], 400);
            }

            $base64Image = base64_decode($base64Image);

            if ($base64Image === false) {
                return response()->json(['error' => 'Base64 decode failed'], 400);
            }

            $fileName = uniqid() . '.' . $type;
            $filePath = $folderPath . $fileName;

            // Save image to storage/app/public/...
            Storage::disk('public')->put($filePath, $base64Image);
        }

        return $filePath;
    }
}
