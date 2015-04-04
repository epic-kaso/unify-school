<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopedStaffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_staffs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('hashcode');

			$table->integer('school_id');
			$table->string('last_name');
			$table->string('first_name');
			$table->string('middle_name');
			$table->date('birth_date');
			$table->string('religion');
			$table->string('country');
			$table->string('state');
			$table->string('lga');
			$table->string('marital_status');
			$table->text('picture');

			$table->string('contact_phone');
			$table->text('contact_address');
			$table->string('contact_email');

			$table->string('blood_group');
			$table->string('genotype');
			$table->text('disabilities');


			$table->enum('sex',['male','female']);
			$table->date('employment_date');
			$table->text('qualifications');
			$table->enum('status',['active','inactive','on-leave','suspended','sacked','deceased']);
			$table->timestamps();

			$table->unique(['hashcode','school_id']);

			$table->text('assigned_courses');
			$table->text('assigned_classes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_staffs');
	}

}
