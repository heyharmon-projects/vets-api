<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->boolean('favorite')->default(false);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_owner')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('screenshot_file_id')->nullable();
            $table->foreignId('favicon_file_id')->nullable();
            $table->text('description')->nullable();
            $table->string('primary_image_url')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('employees')->nullable();
            $table->string('yelp_url')->nullable();
            $table->string('linkedin_url')->nullable();
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
        Schema::dropIfExists('locations');
    }
};
