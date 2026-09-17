<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {email?}';
    protected $description = 'Create or update the single administration user';

    public function handle(): int
    {
        $email = $this->argument('email') ?: $this->ask('Administrator email');
        $name = $this->ask('Administrator name', 'Mare Ventus Administrator');
        $password = $this->secret('Password');
        if (!$password || strlen($password) < 12) { $this->error('Use a password with at least 12 characters.'); return self::FAILURE; }
        User::query()->updateOrCreate(['email' => $email], ['name' => $name, 'password' => $password]);
        $this->info('Administrator account is ready.');
        return self::SUCCESS;
    }
}
