<?php

namespace App\Services;

class ImageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function upload($image) {
        $imagePath = $image->store('profile_pictures', 'public'); // Save in storage/app/public/profile_pictures
        return $imagePath;
    }
}
