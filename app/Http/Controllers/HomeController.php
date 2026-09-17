<?php

namespace App\Http\Controllers;

use App\Models\FleetImage;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'settings' => Setting::values(),
            'services' => Service::query()->orderBy('sort_order')->get(),
            'fleet' => FleetImage::query()->orderBy('sort_order')->get(),
            'partners' => Partner::query()->orderBy('sort_order')->get(),
        ]);
    }
}
