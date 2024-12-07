<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PurgeOldClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:purge-old-clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Client::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(30))
            ->forceDelete();  // Supprimer définitivement après 30 jours
    }

}
