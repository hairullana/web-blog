<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // FACTORY
        User::factory(5)->create();
        Post::factory(20)->create();



        // SEED

        User::create([
            'name' => 'Hairul Lana',
            'email' => 'hairullana@gmail.com',
            'username' => 'hairullana',
            'password' => bcrypt('123')
        ]);

        Category::create([
            'name' => 'Web Progamming',
            'slug' => 'web-programnming'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Machine Learning',
            'slug' => 'machine-learning'
        ]);

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, similique vitae. Ex, nostrum. Iste nobis eaque ratione aut repellat itaque.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga maxime quis laudantium, atque autem expedita quos neque nulla voluptates, impedit, incidunt ex omnis architecto possimus ad excepturi. Iste voluptatibus eaque minus facilis qui soluta consequatur blanditiis architecto ipsa vel, numquam sint mollitia eius perspiciatis. Eius accusamus nihil dolorem quidem tempore placeat unde nemo perferendis atque temporibus nam, ipsa ipsum qui provident quo minus fugit iure sapiente, porro eveniet maiores sit vero? Voluptatum adipisci officia consectetur qui quas iusto dicta deserunt nihil odit aut. Voluptate aperiam deleniti omnis recusandae dolorem corrupti facilis. Culpa hic quidem vitae esse ratione veniam non molestiae?',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, similique vitae. Ex, nostrum. Iste nobis eaque ratione aut repellat itaque.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga maxime quis laudantium, atque autem expedita quos neque nulla voluptates, impedit, incidunt ex omnis architecto possimus ad excepturi. Iste voluptatibus eaque minus facilis qui soluta consequatur blanditiis architecto ipsa vel, numquam sint mollitia eius perspiciatis. Eius accusamus nihil dolorem quidem tempore placeat unde nemo perferendis atque temporibus nam, ipsa ipsum qui provident quo minus fugit iure sapiente, porro eveniet maiores sit vero? Voluptatum adipisci officia consectetur qui quas iusto dicta deserunt nihil odit aut. Voluptate aperiam deleniti omnis recusandae dolorem corrupti facilis. Culpa hic quidem vitae esse ratione veniam non molestiae?',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, similique vitae. Ex, nostrum. Iste nobis eaque ratione aut repellat itaque.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga maxime quis laudantium, atque autem expedita quos neque nulla voluptates, impedit, incidunt ex omnis architecto possimus ad excepturi. Iste voluptatibus eaque minus facilis qui soluta consequatur blanditiis architecto ipsa vel, numquam sint mollitia eius perspiciatis. Eius accusamus nihil dolorem quidem tempore placeat unde nemo perferendis atque temporibus nam, ipsa ipsum qui provident quo minus fugit iure sapiente, porro eveniet maiores sit vero? Voluptatum adipisci officia consectetur qui quas iusto dicta deserunt nihil odit aut. Voluptate aperiam deleniti omnis recusandae dolorem corrupti facilis. Culpa hic quidem vitae esse ratione veniam non molestiae?',
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);


    }
}
