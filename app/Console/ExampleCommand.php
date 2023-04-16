<?php

namespace App\Console;

use Illuminate\Console\Command;
class ExampleCommand extends Command
{
    protected $signature = 'example';

    protected $description = 'Example command';

    public function handle()
    {
        $this->comment('Example command');
    }
}
