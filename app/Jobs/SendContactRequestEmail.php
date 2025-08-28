<?php

namespace App\Jobs;

use App\Mail\ContactRequestNotification;
use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContactRequestEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 15;

    public function __construct(public ContactRequest $contact) {}

    public function handle(): void
    {
        $to = env('CONTACT_MANAGER_EMAIL');
        if (!$to) {
            Log::warning('CONTACT_MANAGER_EMAIL is not set; skipping email for contact_id=' . $this->contact->id);
            return;
        }
        try {
            Mail::to($to)->send(new ContactRequestNotification($this->contact));
        } catch (\Throwable $e) {
            Log::error('SendContactRequestEmail failed: ' . $e->getMessage());
        }
    }
}
