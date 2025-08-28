<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendContactRequestEmail;
use App\Jobs\SendContactRequestTelegram;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactRequestController extends Controller
{
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['required', 'string', 'max:64'],
            'email'       => ['nullable', 'email', 'max:255'],
            'message'     => ['nullable', 'string', 'max:2000'],
            'source_page' => ['nullable', 'string', 'max:255'],
            'website'     => ['nullable', 'size:0'], // honeypot
            'meta'        => ['sometimes', 'array'],
        ], [
            'website.size' => 'Bots are not allowed.',
        ]);

        if ($v->fails()) {
            return response()->json([
                'ok'     => false,
                'errors' => $v->errors(),
            ], 422);
        }

        $data = $v->validated();

        // собрать meta из дополнительных ключей
        $meta = $data['meta'] ?? [];
        foreach (['source', 'source_url', 'utm', 'product_id', 'product_title'] as $key) {
            if ($request->has($key)) {
                $meta[$key] = $request->input($key);
            }
        }

        $contact = new ContactRequest();
        $contact->name        = $data['name'];
        $contact->phone       = $data['phone'];
        $contact->email       = $data['email'] ?? null;
        $contact->message     = $data['message'] ?? null;
        $contact->source_page = $data['source_page'] ?? null;
        $contact->status      = 'new';
        $contact->meta        = !empty($meta) ? $meta : null;
        $contact->save();

        try {
            // выполнятся синхронно при QUEUE_CONNECTION=sync
            dispatch(new SendContactRequestEmail($contact));
            dispatch(new SendContactRequestTelegram($contact));
        } catch (\Throwable $e) {
            Log::error('Dispatch failed for contact_id=' . $contact->id . ': ' . $e->getMessage());
        }

        return response()->json([
            'ok' => true,
            'id' => $contact->id,
        ]);
    }
}
