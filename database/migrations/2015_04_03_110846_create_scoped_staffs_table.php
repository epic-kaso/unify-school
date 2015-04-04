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
			$table->date('birth_date')->nullable();
			$table->string('religion')->nullable();
			$table->string('country')->nullable();
			$table->string('state')->nullable();
			$table->string('lga')->nullable();
			$table->string('marital_status')->nullable();
			$table->text('picture')->nullable();

			$table->string('contact_phone')->nullable();
			$table->text('contact_address')->nullable();
			$table->string('contact_email')->nullable();

			$table->string('blood_group')->nullable();
			$table->string('genotype')->nullable();
			$table->text('disabilities')->nullable();

			$table->enum('sex',['male','female'])->nullable();
			$table->date('employment_date')->nullable();
			$table->text('qualifications')->nullable();
			$table->enum('status',['active','inactive','on-leave','suspended','sacked','deceased'])->nullable();


			$table->text('assigned_courses')->nullable();
			$table->text('assigned_classes')->nullable();

			$table->timestamps();

			$table->unique(['hashcode','school_id']);

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
