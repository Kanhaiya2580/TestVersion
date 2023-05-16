<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PragmaRX\Version\Package\Facade as Version;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $version = Version::version(); // Get the version information
        $version = Version::format('compact'); // Get the version information
        dd($version);
        // Use the version information as needed

        // return view('your-view', ['version' => $version]);
    }
}
