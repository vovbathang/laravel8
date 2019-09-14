<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'order'=>0,
            'parent'=>0
        ]);
        factory(Category::class, 50)->create();
        /*factory(User::class, 50)->create()->each(function ($u){
            $u->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}
