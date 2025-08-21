<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CleanupHotelsCommand extends Command
{
    
    protected $signature = 'hotels:cleanup {--days=30}';

   
    protected $description = 'Call the cleanup API to delete old hotel data';

   
    public function handle(): int
    {
        $days = (int) $this->option('days');
        $base = rtrim(config('app.url') ?? env('APP_URL'), '/');
        $url  = $base . '/api/hotels/cleanup';

        $this->info("Calling $url (days=$days)…");

        $resp = Http::withHeaders([
            'X-CRON-KEY' => env('CRON_CLEANUP_KEY')
        ])->delete($url, ['days' => $days]);

        if ($resp->successful()) {
            $json = $resp->json();
            $this->info('Cleanup OK: deleted=' . ($json['deleted'] ?? 'n/a'));
            return self::SUCCESS;
        }

        $this->error('Cleanup failed: ' . $resp->status() . ' ' . $resp->body());
        return self::FAILURE;
    }
}
