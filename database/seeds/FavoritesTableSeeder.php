<?php

use Illuminate\Database\Seeder;
// use DB;
use App\User;
use App\Question;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->delete();

        $users = User::pluck('id')->all();
        $numberOfUsers = count($users);

        foreach(Question::all() as $question){
            for($i = 0; $i < rand(0, $numberOfUsers); $i++){
                // get user random
                $user = $users[$i];
                // Insert user into a quetion
                $question->favorites()->attach($user);
            }
        }
    }
}
