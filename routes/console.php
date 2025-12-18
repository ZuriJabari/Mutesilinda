<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('user:promote-editor {email}', function (string $email) {
    if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
        $this->error('The users.role column is missing. Run migrations first.');

        return 1;
    }

    $user = User::query()->where('email', $email)->first();

    if (! $user) {
        $this->error("No user found with email: {$email}");

        return 1;
    }

    $user->forceFill(['role' => User::ROLE_EDITOR])->save();

    $this->info("Promoted {$user->email} to editor.");

    return 0;
})->purpose('Promote a user to the editor role');

Artisan::command('user:set-role {email} {role}', function (string $email, string $role) {
    if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
        $this->error('The users.role column is missing. Run migrations first.');

        return 1;
    }

    $role = strtolower(trim($role));
    $allowed = [User::ROLE_USER, User::ROLE_EDITOR, User::ROLE_SUPER_USER];

    if (! in_array($role, $allowed, true)) {
        $this->error('Invalid role. Allowed: user, editor, super');

        return 1;
    }

    $user = User::query()->where('email', $email)->first();

    if (! $user) {
        $this->error("No user found with email: {$email}");

        return 1;
    }

    $user->forceFill(['role' => $role])->save();

    $this->info("Set {$user->email} role to {$role}.");

    return 0;
})->purpose('Set a user role (user/editor/super)');
