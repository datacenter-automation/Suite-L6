<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('admin.admin_name')) {
            User::firstOrCreate([
                'email'    => config('datacenter-automation-suite.admin_email'),
                'name'     => config('datacenter-automation-suite.admin_name'),
                'password' => bcrypt(config('datacenter-automation-suite.admin_password')),
            ]);
        }
    }
}
