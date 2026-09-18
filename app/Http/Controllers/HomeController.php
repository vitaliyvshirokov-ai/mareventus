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
        $services = Service::query()->orderBy('sort_order')->get()->unique('title')->values();
        $fleet = FleetImage::query()->orderBy('sort_order')->get()->unique('path')->values();
        $partners = Partner::query()->orderBy('sort_order')->get()->unique('name')->values();

        return view('home', [
            'settings' => Setting::values(),
            'services' => $services,
            'fleet' => $fleet,
            'partners' => $partners,
        ]);
    }
}
