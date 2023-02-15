<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags=[
            'etiqueta1',
            'etiqueta2',
            'etiqueta3',
            'etiqueta4',
            'etiqueta5',
        ];
        foreach($tags as $tag){
            Tag::create([
                'nombre'=>$tag, 
            ]);
        }
    }
}
