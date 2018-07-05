<?php

use Illuminate\Database\Seeder;
use App\Models\Base\UserRol;

class UserRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRol::create([
            'user_id'   => 1,
            'role_id'   => 1,
        ]);
    }
}
