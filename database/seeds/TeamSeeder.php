<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert(

            [
                'name' => 'IT',
                'team_leader' => 1
            ]
        );
        DB::table('teams')->insert(

            [
                'name' => 'HR',
                'team_leader' => 1
            ]
        );

        DB::table('teams')->insert(

            [
                'name' => 'SPORT',
                'team_leader' => 1
            ]
        );

        DB::table('teams')->insert(

            [
                'name' => 'CR',
                'team_leader' => 1
            ]
        );

        DB::table('teams')->insert(

            [
                'name' => 'PR',
                'team_leader' => 1
            ]
        );

        DB::table('teams')->insert(

            [
                'name' => 'Finansije',
                'team_leader' => 1
            ]
        );
    }
}
