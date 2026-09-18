<?php

namespace Database\Seeders;

use App\Models\FleetImage;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Service::query()->upsert([
            ['title' => 'Logistics Planning', 'description' => 'Route optimization, market intelligence and tailored transport schemes for complex bulk cargo movements.', 'icon' => 'route', 'sort_order' => 1],
            ['title' => 'Chartering', 'description' => 'Flexible chartering solutions matched to your cargo requirements, schedule and trade corridor.', 'icon' => 'ship', 'sort_order' => 2],
            ['title' => 'Vegetable Oil Transportation', 'description' => 'Safe, efficient and compliant transportation of bulk vegetable oil cargo across key markets.', 'icon' => 'drop', 'sort_order' => 3],
            ['title' => 'Shipping Operations Financing', 'description' => 'Structured financing support designed to keep essential shipping operations moving.', 'icon' => 'chart', 'sort_order' => 4],
        ], ['title'], ['description', 'icon', 'sort_order']);

        FleetImage::query()->upsert([
            ['path' => 'assets/images/vessel-01.webp', 'caption' => 'Our vessel navigating international waters', 'sort_order' => 1],
            ['path' => 'assets/images/vessel-02.webp', 'caption' => 'Built for safe and efficient operations', 'sort_order' => 2],
            ['path' => 'assets/images/vessel-03.webp', 'caption' => 'Supporting dependable cargo movement', 'sort_order' => 3],
        ], ['path'], ['caption', 'sort_order']);

        Partner::query()->upsert([
            ['name' => 'Vitol', 'logo_path' => null, 'sort_order' => 1],
            ['name' => 'Cargill', 'logo_path' => null, 'sort_order' => 2],
        ], ['name'], ['sort_order']);

        $settings = [
            'hero_title' => 'Reliable Ocean & River Cargo Transportation',
            'hero_text' => 'Specialist logistics, chartering and shipping solutions for bulk vegetable oil cargo across Europe, Africa, the Red Sea, the Persian Gulf and the Caspian Sea.',
            'about_title' => 'Built for dependable movement',
            'about_text' => 'Mare Ventus Logistics FZCO is an independent, privately held maritime logistics and chartering company based in Dubai, founded in 2022. We operate a modern fleet and develop tailored transport schemes for bulk vegetable oil cargo.',
            'address' => 'Dubai Silicon Oasis, DDP (Dubai Digital Park), Building A3, Office 201A, Dubai, United Arab Emirates',
            'email' => 'management@mareventuslog.com',
            'phone' => '+971 4 228 52 85',
            'map_link' => 'https://www.google.com/maps?q=Dubai+Silicon+Oasis+Dubai+Digital+Park&hl=en&output=embed',
            'linkedin_url' => '#',
        ];
        foreach ($settings as $key => $value) Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
