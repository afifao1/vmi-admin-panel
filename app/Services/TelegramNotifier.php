<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotifier
{
    public function sendText(string $text): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        if (!$token || !$chatId) {
            Log::warning('Telegram not configured: missing TELEGRAM_BOT_TOKEN or TELEGRAM_CHAT_ID');
            return;
        }

        try {
            Http::asForm()->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $text,
                'disable_web_page_preview' => true,
            ])->throw();
        } catch (\Throwable $e) {
            Log::error('Telegram send failed: ' . $e->getMessage());
        }
    }
}
