<?php

namespace AlexStorozhenko\EloquentCriteria\Commands;

use Illuminate\Console\Command;

class EloquentCriteriaCommand extends Command
{
    public $signature = 'eloquent-criteria';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
