<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if (!Schema::hasTable('employees')) {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->timestamps();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->integer('user_id')->nullable();
        });
        // }

        // Schema::table('employees', function (Blueprint $table) {
        //     $table->foreignId('department_id')->nullable()
        //         ->constrained('units');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
