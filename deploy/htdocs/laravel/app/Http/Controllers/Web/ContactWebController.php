<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactWebController extends Controller
{
    public function store(StoreContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return back()->with('success', 'Your message has been sent! I\'ll get back to you soon.');
    }
}
