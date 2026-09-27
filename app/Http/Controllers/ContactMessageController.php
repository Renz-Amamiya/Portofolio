<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class ContactMessageController extends Controller
{
    public function store(ContactMessageRequest $request): RedirectResponse
    {
        Contact::create($request->validated());
        Cache::forget('unread-messages');

        return back()->with('success', 'Thanks for your message. I will get back to you soon.');
    }
}