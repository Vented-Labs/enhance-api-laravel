<?php

namespace Vented\EnhanceApiLaravel\Commands;

use Illuminate\Console\Command;

class EnhanceApiLaravelCommand extends Command
{
    public $signature = 'enhance-api-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
