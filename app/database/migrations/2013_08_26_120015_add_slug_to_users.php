<?php

use Illuminate\Database\Migrations\Migration;

class AddSlugToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->string('slug')->unique();

			$table->index('slug');
		});

		// Generate slugs for existing users
		foreach(User::all() as $user)
		{
			// Will trigger a regeneration of slug
			$user->first_name = $user->first_name;
			
			$user->save();
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->dropColumn('slug');
		});
	}

}