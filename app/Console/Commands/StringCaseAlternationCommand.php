<?php

namespace App\Console\Commands;

use App\Helpers\StringHelper;
use Illuminate\Console\Command;

class StringCaseAlternationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roma:case-alter {string} {--reverse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make even string character is an uppercase letter, an odd string character is a lowercase letter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $formattedString = StringHelper::doCaseAlternation(
            $this->argument('string'),
            $this->option('reverse')
        );

        $this->info($formattedString);
    }
}
