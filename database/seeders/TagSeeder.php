<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Screencast\Tag;
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
        $tags = collect([
            'PHP', 'HTML', 'CSS', 'Javascript', 'Vue', 'React', 'Laravel', 'Lumen', 'Tailwind Css', 'Bootstrap'
        ]);

        $tags->each(function($tag){
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        });
    }
}
