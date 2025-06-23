<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class DeploymentController extends Controller
{
    public function deploy() {
        try {
            $path = base_path();
            Process::run("git config --global --add safe.directory {$path}");
            $process = Process::run("cd $path && git pull");

            if($process->successful()) {
                Log::info("Successfully deployeed in server");
            }

            Log::info($process->errorOutput());
        } catch (\Throwable $e){
            Log::error($e);
        }
    }
}
