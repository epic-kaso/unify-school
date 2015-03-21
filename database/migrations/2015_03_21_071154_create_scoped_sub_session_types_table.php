<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Repositories\School\ScopedSessionTypeRepository;

class CreateScopedSubSessionTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('scoped_sub_session_types', function(Blueprint $table)
//		{
//			$table->increments('id');
//			$table->integer('school_id');
//			$table->integer('scoped_session_type_id');
//			$table->string('name');
//			$table->string('display_name');
//			$table->boolean('current')->default(false);
//			$table->timestamps();
//
//			$table->unique(['school_id','scoped_session_type_id','name']);
//		});
//
//		$sessionTypeRepository = App::make(ScopedSessionTypeRepository::class);
//
//		foreach(ScopedSessionType::all() as $model){
//			$data = $model->toArray();
//			$model->delete();
//			$sessionTypeRepository->create($data);
//		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_sub_session_types');
	}

}
