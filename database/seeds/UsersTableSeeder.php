<?php

use Illuminate\Database\Seeder;
use CodeShopping\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,1)->create([
            'email'=>'admin@user.com'
        ])->each(function($user){
            $user->profile->phone_number = '+166505551234';
            $user->profile->save();
        });

        factory(User::class,50)->create();
    }
}
