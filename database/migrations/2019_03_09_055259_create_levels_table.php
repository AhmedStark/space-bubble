<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('building_id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $appJSFile = fopen(base_path("resources/js/")."app.js","w");
        fwrite($appJSFile,file_get_contents(base_path("resources/js/")."rest_app.js"));
        fclose($appJSFile);
        shell_exec('rm '.base_path('resources/js/components/maps/')."*.vue");
        Schema::dropIfExists('levels');
    }
}
