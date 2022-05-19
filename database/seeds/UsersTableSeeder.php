<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $user = User::create([
            'id'         => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name'       => 'Developer Tora',
            'email'      => 'developer@tora.co.id',
            'password'   => bcrypt('123secret456'),
            'api_token'  => Str::random(32),
            'active'     => true
        ]);

        $user->assignRole('admin');

    }
}
