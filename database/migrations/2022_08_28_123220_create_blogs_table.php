<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_enable')->default(0)->comment('1=>enable,0 =>not enable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
