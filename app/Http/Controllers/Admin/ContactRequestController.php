<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactRequestController extends Controller
{
    public function index(): View { return view('admin.contacts.index',['items'=>ContactRequest::latest()->paginate(25)]); }
    public function show(ContactRequest $contact): View { return view('admin.contacts.show',compact('contact')); }
    public function update(ContactRequest $contact): RedirectResponse { $contact->update(['is_processed'=>!$contact->is_processed]); return back()->with('status','Request status updated.'); }
}
