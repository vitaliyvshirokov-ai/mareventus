<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('services', function (Blueprint $table): void { $table->id(); $table->string('title'); $table->text('description'); $table->string('icon', 50)->default('route'); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('fleet_images', function (Blueprint $table): void { $table->id(); $table->string('path'); $table->string('caption'); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('partners', function (Blueprint $table): void { $table->id(); $table->string('name'); $table->string('logo_path')->nullable(); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('contact_requests', function (Blueprint $table): void { $table->id(); $table->string('name'); $table->string('email'); $table->string('phone')->nullable(); $table->string('company')->nullable(); $table->text('message'); $table->boolean('is_processed')->default(false); $table->timestamps(); });
        Schema::create('settings', function (Blueprint $table): void { $table->id(); $table->string('key')->unique(); $table->longText('value')->nullable(); $table->timestamps(); });
        Schema::create('cache', function (Blueprint $table): void { $table->string('key')->primary(); $table->mediumText('value'); $table->integer('expiration'); });
        Schema::create('cache_locks', function (Blueprint $table): void { $table->string('key')->primary(); $table->string('owner'); $table->integer('expiration'); });
        Schema::create('jobs', function (Blueprint $table): void { $table->id(); $table->string('queue')->index(); $table->longText('payload'); $table->unsignedTinyInteger('attempts'); $table->unsignedInteger('reserved_at')->nullable(); $table->unsignedInteger('available_at'); $table->unsignedInteger('created_at'); });
        Schema::create('job_batches', function (Blueprint $table): void { $table->string('id')->primary(); $table->string('name'); $table->integer('total_jobs'); $table->integer('pending_jobs'); $table->integer('failed_jobs'); $table->longText('failed_job_ids'); $table->mediumText('options')->nullable(); $table->integer('cancelled_at')->nullable(); $table->integer('created_at'); $table->integer('finished_at')->nullable(); });
        Schema::create('failed_jobs', function (Blueprint $table): void { $table->id(); $table->string('uuid')->unique(); $table->text('connection'); $table->text('queue'); $table->longText('payload'); $table->longText('exception'); $table->timestamp('failed_at')->useCurrent(); });
    }
    public function down(): void { foreach (['failed_jobs','job_batches','jobs','cache_locks','cache','settings','contact_requests','partners','fleet_images','services'] as $table) Schema::dropIfExists($table); }
};
