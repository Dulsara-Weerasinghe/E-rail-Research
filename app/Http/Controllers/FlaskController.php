<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FlaskController extends Controller
{
    public function executeFlaskApp()
    {
        $pythonPath = '"C:\Users\rajit\anaconda3\pkgs\python-3.9.16-h6244533_2\python.exe"'; // Replace with the actual path to your Python executable

        $command = [
            $pythonPath,
            base_path('virtual_env/app.py')
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}



