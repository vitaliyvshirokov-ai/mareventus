<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View { return view('admin.partners.index', ['items'=>Partner::orderBy('sort_order')->get()]); }
    public function create(): View { return view('admin.partners.form',['partner'=>new Partner]); }
    public function store(Request $request): RedirectResponse { Partner::create($this->data($request)); return redirect()->route('admin.partners.index')->with('status','Partner created.'); }
    public function edit(Partner $partner): View { return view('admin.partners.form',compact('partner')); }
    public function update(Request $request, Partner $partner): RedirectResponse { $partner->update($this->data($request,$partner)); return redirect()->route('admin.partners.index')->with('status','Partner updated.'); }
    public function destroy(Partner $partner): RedirectResponse { if($partner->logo_path) Storage::disk('public')->delete($partner->logo_path); $partner->delete(); return back()->with('status','Partner deleted.'); }
    private function data(Request $request, ?Partner $partner=null): array { $data=$request->validate(['name'=>['required','string','max:120','regex:/^[\x00-\x7F]+$/'],'logo'=>['nullable','image','max:4096'],'sort_order'=>['required','integer','min:0','max:999']]); unset($data['logo']); if($request->hasFile('logo')) { if($partner?->logo_path) Storage::disk('public')->delete($partner->logo_path); $data['logo_path']=$request->file('logo')->storeAs('partners','partner-'.str()->uuid().'.'.$request->file('logo')->extension(),'public'); } return $data; }
}
