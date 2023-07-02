<?php
/**
 * Created by enea dhack.
 */

namespace Mandu\Components\Laroute\Console\Command;

use Illuminate\Console\Command;
use Mandu\Components\Laroute\LarouteException;
use Mandu\Components\Laroute\Publisher;

class LarouteGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laroute:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the file with the routes for a group';

    public function handle(Publisher $publisher): int
    {
        try {
            $publisher->publish();
            $this->info('Routes published');
            return 0;
        } catch (LarouteException $exception) {
            $this->error('Sorry we have an exception: ' . $exception->getMessage());
            return 1;
        }
    }
}
