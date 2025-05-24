<?php

namespace App\Http\Controllers\ThirdParty;

use App\Http\Controllers\Controller;
use App\Jobs\SaveInGoogleDrive;
use App\Models\Member;
use Illuminate\Http\Request;


class GoogleServicesController extends Controller
{
    public function save() {

        dispatch(new SaveInGoogleDrive());

    }
}
