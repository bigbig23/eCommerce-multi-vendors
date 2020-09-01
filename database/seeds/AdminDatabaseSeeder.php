<?php

use Illuminate\Database\Seeder;
use  App\Models\Admin;
class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Admin::create([
            'name' => 'Manage',
            'email' => 'admin2@example.com',
            'password' => bcrypt(11111111),
        ]);
    }
}
