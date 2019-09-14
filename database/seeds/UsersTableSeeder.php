<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Thang Nguyen',
            'email' => 'vovbathang@gmail.com',
            'password' => 'nbt2305',
            //'remember_token' => str_random(10)
        ]);
        factory(User::class, 50)->create();
        /*factory(User::class, 50)->create()->each(function ($u){
            $u->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}
