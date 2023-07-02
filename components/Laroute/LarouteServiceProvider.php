<?php
/**
 * Created by enea dhack.
 */

namespace Mandu\Components\Laroute;

use Illuminate\Support\ServiceProvider;
use Mandu\Components\Laroute\Console\Command\LarouteGenerateCommand;

class LarouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            LarouteGenerateCommand::class,
        ]);
    }
}
