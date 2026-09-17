<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\FleetImage;
use App\Models\Partner;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View { return view('admin.dashboard', ['counts' => ['services' => Service::count(), 'fleet' => FleetImage::count(), 'partners' => Partner::count(), 'open_requests' => ContactRequest::where('is_processed', false)->count()], 'recent' => ContactRequest::latest()->limit(5)->get()]); }
}
