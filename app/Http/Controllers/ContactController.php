<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequestForm;
use App\Mail\ContactAutoReply;
use App\Mail\ContactNotification;
use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequestForm $request): JsonResponse
    {
        $data = $request->safe()->except('website');
        $contact = ContactRequest::query()->create($data);
        Mail::to(config('contact.notification_email'))->send(new ContactNotification($contact));
        Mail::to($contact->email)->send(new ContactAutoReply($contact));
        return response()->json(['message' => 'Thank you for contacting Mare Ventus Logistics. Our team will get back to you shortly.'], 201);
    }
}
