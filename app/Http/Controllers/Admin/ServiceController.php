<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View { return view('admin.services.index', ['items' => Service::orderBy('sort_order')->get()]); }
    public function create(): View { return view('admin.services.form', ['service' => new Service]); }
    public function store(ServiceRequest $request): RedirectResponse { Service::create($request->validated()); return redirect()->route('admin.services.index')->with('status','Service created.'); }
    public function edit(Service $service): View { return view('admin.services.form', compact('service')); }
    public function update(ServiceRequest $request, Service $service): RedirectResponse { $service->update($request->validated()); return redirect()->route('admin.services.index')->with('status','Service updated.'); }
    public function destroy(Service $service): RedirectResponse { $service->delete(); return back()->with('status','Service deleted.'); }
}
