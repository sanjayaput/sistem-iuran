<?php

use App\User;
use Illuminate\Database\Seeder;

class AddUsernameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $key => $user) {
            $user->username = explode('@', $user->email)[0];
            $user->save();
        }
    }
}
