<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class GenerateSwaggerDocs extends Command
{
    protected $signature = 'swagger:generate';

    protected $description = 'Generate Swagger documentation';

    public function handle()
    {
        $command = 'php ' . base_path('vendor/zircote/swagger-php/bin/openapi') .
            ' --output ' . base_path('public/docs/api-docs.json') .
            ' ' . implode(' ', [
                base_path('app'),
                base_path('routes'),
            ]) .
            ' --exclude ' . base_path('vendor');

        $process = Process::fromShellCommandline($command);
        $process->run();

        $isSuccessful = $process->run() == 1;

        if ($isSuccessful) {
            $this->info('Swagger documentation generated successfully.');
        } else {
            $this->error('Swagger documentation generation failed.');
        }
    }
}
