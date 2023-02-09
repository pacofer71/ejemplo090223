<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //[1,2,3,4,5]
        $posts=Post::factory(60)->create();
        foreach($posts as $post){
            $cant=random_int(1,3);  //1, 2, 3 //3
            $start=random_int(1,2);  //2 //3
            $var=range($start, $start+$cant);  //2,3, 4
            $post->tags()->attach($var);

          //  $post->tags()->attach([1, 2,3, 5]);
        }
    }
}
