<?php

namespace App\Services;

use Symfony\Component\Translation\Exception\NotFoundResourceException;

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
        if(!$image) {
            return;
        }
        $imagePath = $image->store('profile_pictures', 'public'); // Save in storage/app/public/profile_pictures
        return $imagePath;
    }
}
