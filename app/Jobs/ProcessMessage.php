<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class ProcessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;


    /**
     * Create a new job instance.
     */
    public function __construct(
        public $message,
        public $clan
    )
    {}

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [(new WithoutOverlapping($this->message->generateHash()))->dontRelease()];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $added = Cache::add($this->message->generateHash(), $this->clan->id, 15);

        if(!$added) {
            return;
        }

        $webhook = $this->clan->settings()->where('key', 'discord_webhook')->get()->pluck('value')->first();

        $settings = $this->clan->settings()->get()->mapWithKeys(function($setting, $key) {
            return [$setting->key => $setting->value];
        });

        // send message to clan chat webhook
        $response = Http::post($webhook, [
            'content' => $this->message->generateDiscordMessage($settings)
        ]);
    }
}
