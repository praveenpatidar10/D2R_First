<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default(NULL);
            $table->text('link')->default(NULL);
            $table->text('youtube_link')->default(NULL);
            $table->dateTime('eventDate')->default(NULL); 
            $table->longText('description')->default(NULL);
            $table->string('image')->default(NULL);
            $table->enum('status',['New', 'Inactive','Past','Live'])->default('New');
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
        Schema::dropIfExists('events');
    }
}
