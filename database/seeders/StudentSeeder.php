<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        dd(Faker::name);
        // for ($i=0; $i < 125; $i++) {
        //     $user = User::create([
        //         'name'     => ,
        //         'email'    => ,
        //         'password' => md5(time()),
        //     ])
        // }
    }
}
