<?php

use Illuminate\Database\Seeder;
use App\Models\Base\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            // 'user_nit' => 1023878024,
            'user_name' => 'DANIEL',
            'user_lastname' => 'TELLEZ RODRIGUEZ',
            'user_email' => 'dropecamargo@gmail.com',
            'user_telephone' => '12345678',
            'user_address' => 'CLL 137B #105-32',
            'username' => 'admin',
            'password' => md5('admin')
        ]);
    }
}
