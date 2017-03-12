<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableRemoveNameAddFirstNameAndLastName extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function ($table) {
			$table->dropColumn('name');
			$table->string('first_name', 50)->after('id')->nullable();
			$table->string('last_name', 50)->after('first_name')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function ($table) {
			$table->dropColumn('last_name');
			$table->dropColumn('first_name');
			$table->string('name')->after('id');
		});
	}
}
