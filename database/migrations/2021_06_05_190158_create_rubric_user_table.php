<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRubricUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rubric_id')->index()->constrained();
            $table->foreignId('user_id')->index()->constrained();
            $table->timestamps();
            $table->unique(['rubric_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubric_user');
    }
}
