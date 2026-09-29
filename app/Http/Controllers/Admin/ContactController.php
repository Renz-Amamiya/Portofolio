<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('admin.contacts.index', [
            'contacts' => Contact::latest()->paginate(15),
        ]);
    }

    public function show(Contact $contact): View
    {
        if (! $contact->read) {
            $contact->update(['read' => true, 'read_at' => now()]);
            Cache::forget('unread-messages');
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead(Contact $contact): RedirectResponse
    {
        $contact->update(['read' => true, 'read_at' => now()]);
        Cache::forget('unread-messages');

        return back()->with('success', 'Marked as read.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        Cache::forget('unread-messages');

        return back()->with('success', 'Message deleted.');
    }
}