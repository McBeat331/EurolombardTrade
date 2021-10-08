<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'A.D.M.I.N.I.S.T.R.A.T.O.R',
            'lastname' => '',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin123'),
            'is_admin' => User::IS_ADMIN,
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
