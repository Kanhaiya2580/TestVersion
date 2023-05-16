<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PragmaRX\Version\Package\Facade as Version;
use Illuminate\Support\Facades\Artisan;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function indexs()
    {
        $version = Version::version(); // Get the version information
        $version = Version::format('compact'); // Get the version information
        dd($version);
        // Use the version information as needed

        // return view('your-view', ['version' => $version]);
    }


    public function index()
    {
        // Check if the current branch is "main"
        $currentBranch = trim(shell_exec('git rev-parse --abbrev-ref HEAD'));
        if ($currentBranch != 'main') {
            return;
        }
        dd($currentBranch);
        // Generate the new version
        $res = Artisan::call('version:commit');

        // Push the new version tag to Git
        $newVersion = trim(shell_exec('git describe --tags --abbrev=0'));
        dd($newVersion);

        shell_exec('git tag -a ' . $newVersion . ' -m "Version ' . $newVersion . '"');
        shell_exec('git push origin ' . $newVersion);
    }
}
