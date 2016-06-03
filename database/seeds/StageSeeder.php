<?php

use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 2)->create()->each(function($u) {
            $posts = factory(App\Models\Post::class, 2)->make();
            $u->posts()->saveMany($posts);
            $posts->each(function ($p) use($u){
                $p->comments()->saveMany(factory(App\Models\Comment::class, rand(2, 40))->make(['user_id' => $u->id]));
            });
        });
    }
}
