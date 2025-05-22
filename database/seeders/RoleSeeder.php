<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert(['name' => 'admin', 'display_name' => 'ادمین']);
        DB::table('roles')->insert(['name' => 'agent', 'display_name' => 'مشاور']);
        DB::table('roles')->insert(['name' => 'user', 'display_name' => 'کاربر']);

        $users = [
            ['name' => 'admin', 'role_id' => 1, 'email' => 'admin', 'password' => bcrypt('12345678'), 'email_verified_at' => Carbon::now()]
        ];
        User::upsert($users, ['email'], ['name', 'password', 'email_verified_at']);
    }
}
