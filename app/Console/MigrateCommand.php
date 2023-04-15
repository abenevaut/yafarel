<?php

namespace App\Console;

use Illuminate\Console\Command;
class MigrateCommand extends Command
{
    protected $signature = 'migrate';

    protected $description = 'Manage migrations';

    public function handle()
    {
        $this->comment('Hello World');
    }
}
