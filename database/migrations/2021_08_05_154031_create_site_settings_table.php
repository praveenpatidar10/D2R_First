<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
             $table->id();
             $table->enum('mail_driver',['smtp', 'mail'])->default('smtp');
             $table->string('mail_host')->default(NULL);
             $table->string('mail_port')->default(NULL);
             $table->string('mail_username')->default(NULL);
             $table->string('mail_password')->default(NULL);
             $table->enum('mail_encryption',['ssl', 'tls'])->default('ssl');
             $table->string('mail_from_address')->default(NULL);
             $table->string('mail_from_name')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
