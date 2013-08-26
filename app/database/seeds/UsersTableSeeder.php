<?php

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        DB::table('users')->truncate();

        User::create(array(
            'first_name' => 'Taylor',
            'last_name' => 'Otwell',
            'slug' => 'taylor-otwell',
        ));

        User::create(array(
            'first_name' => 'Dayle',
            'last_name' => 'Rees',
            'slug' => 'dayle-rees',
        ));
    }

}