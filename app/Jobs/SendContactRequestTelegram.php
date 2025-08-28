<?php

namespace App\Jobs;

use App\Models\ContactRequest;
use App\Services\TelegramNotifier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendContactRequestTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 15;

    public function __construct(public ContactRequest $contact) {}

    public function handle(TelegramNotifier $tg): void
    {
        $c = $this->contact;

        $lines = [
            '📩 Новая заявка #' . $c->id,
            '👤 ' . $c->name,
            '📞 ' . $c->phone,
        ];
        if (!empty($c->email)) {
            $lines[] = '✉️ ' . $c->email;
        }
        if (!empty($c->message)) {
            $lines[] = '📝 ' . $c->message;
        }
        if (!empty($c->source_page)) {
            $lines[] = '🔗 ' . $c->source_page;
        }

        try {
            $dt = now('Asia/Tashkent')->format('Y-m-d H:i:s');
            $lines[] = '🕒 ' . $dt . ' (Tashkent)';
        } catch (\Throwable $e) {}

        if (is_array($c->meta) && !empty($c->meta)) {
            $lines[] = 'Meta: ' . json_encode($c->meta, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }

        $tg->sendText(implode("\n", $lines));
    }

    public function failed(\Throwable $e): void
    {
        Log::error('SendContactRequestTelegram failed', [
            'contact_id' => $this->contact->id ?? null,
            'error' => $e->getMessage(),
        ]);
    }
}
