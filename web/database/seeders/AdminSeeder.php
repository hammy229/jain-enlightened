<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [];
        $input['user_type'] = "system";
        $input['user_name'] = "Admin";
        $input['email'] = env('SEED_ADMIN_EMAIL', 'admin@example.com');
        $input['password'] = Hash::make(env('SEED_ADMIN_PASSWORD', 'change-me'));
        $input['role_id'] = 1;

        DB::table('master_admins')->insert($input);
    }
}
