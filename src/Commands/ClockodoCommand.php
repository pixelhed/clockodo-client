<?php

namespace Fs98\ClockodoClient\Commands;

use Illuminate\Console\Command;

class ClockodoCommand extends Command
{
    public $signature = 'clockodo-client';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
