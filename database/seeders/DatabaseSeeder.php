<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        for( $i = 0; $i < 11; $i++ ) {
            DB::table('categories')->insert([
                'description' => fake()->realText(200),
                'name' => fake()->name(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        for( $i = 0; $i < 11; $i++ ) {
            DB::table('users')->insert([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => Hash::make('password'),
                'country' => 'Canada',
                'is_admin' => rand(0,1),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for( $i = 0; $i < 11; $i++ ) {
            $user = DB::table('users')->select('id')->inRandomOrder()->first();
            $category = DB::table('categories')->select('id')->inRandomOrder()->first();
            DB::table('posts')->insert([
                'title' => fake()->realText(50),
                'body' => fake()->realText(500),
                'category_id' => $category->id,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        for( $i = 0; $i < 11; $i++ ) {
            $user = DB::table('users')->select('id')->inRandomOrder()->first();
            $post = DB::table('posts')->select('id')->inRandomOrder()->first();
            DB::table('comments')->insert([
                'subject' => fake()->realText(50),
                'body' => fake()->realText(300),
                'user_id' => $user->id,
                'post_id' => $post->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
            
    }
}
