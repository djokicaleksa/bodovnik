<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(

           [
                'name' => 'Aleksa Djokic',
                'email' => 'djokicaleksa@gmail.com',
                'role_id' => 1,
                'team_id' => 1,
                'password' => Hash::make('aleksa123')
            ]
        );
    }
}
