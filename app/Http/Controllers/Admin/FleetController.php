<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FleetImageRequest;
use App\Models\FleetImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FleetController extends Controller
{
    public function index(): View { return view('admin.fleet.index', ['items' => FleetImage::orderBy('sort_order')->get()]); }
    public function create(): View { return view('admin.fleet.form', ['fleet' => new FleetImage]); }
    public function store(FleetImageRequest $request): RedirectResponse { $data=$request->safe()->except('image'); $data['path']=$request->file('image')->storeAs('fleet', 'vessel-'.str()->uuid().'.'.$request->file('image')->extension(), 'public'); FleetImage::create($data); return redirect()->route('admin.fleet.index')->with('status','Fleet image uploaded.'); }
    public function edit(FleetImage $fleet): View { return view('admin.fleet.form', compact('fleet')); }
    public function update(FleetImageRequest $request, FleetImage $fleet): RedirectResponse { $data=$request->safe()->except('image'); if($request->hasFile('image')) { if(!str_starts_with($fleet->path,'assets/')) Storage::disk('public')->delete($fleet->path); $data['path']=$request->file('image')->storeAs('fleet', 'vessel-'.str()->uuid().'.'.$request->file('image')->extension(), 'public'); } $fleet->update($data); return redirect()->route('admin.fleet.index')->with('status','Fleet image updated.'); }
    public function destroy(FleetImage $fleet): RedirectResponse { if(!str_starts_with($fleet->path,'assets/')) Storage::disk('public')->delete($fleet->path); $fleet->delete(); return back()->with('status','Fleet image deleted.'); }
}
