<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View { return view('admin.settings.edit',['settings'=>Setting::values()]); }
    public function update(Request $request): RedirectResponse { $ascii='regex:/^[\x00-\x7F]+$/'; $data=$request->validate(['hero_title'=>['required','string','max:160',$ascii],'hero_text'=>['required','string','max:3000',$ascii],'about_title'=>['required','string','max:160',$ascii],'about_text'=>['required','string','max:6000',$ascii],'address'=>['required','string','max:500',$ascii],'email'=>['required','email'],'phone'=>['required','string','max:50',$ascii],'map_link'=>['required','url'],'linkedin_url'=>['nullable','string','max:500']]); foreach(['hero_text','about_text'] as $key) $data[$key]=strip_tags($data[$key],'<p><br><strong><em><ul><ol><li><a>'); foreach($data as $key=>$value) Setting::updateOrCreate(['key'=>$key],['value'=>$value]); return back()->with('status','Settings saved.'); }
}
