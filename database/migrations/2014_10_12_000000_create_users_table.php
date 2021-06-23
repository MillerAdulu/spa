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
            $table->string('uuid')->index()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_phone_number')->unique();
            $table->string('email')->unique();
            $table->string('verification_code')->unique()->nullable();
            $table->boolean('has_active_subscription')->default(false);
            $table->boolean('has_active_savings_plan')->default(false);
            $table->boolean('is_logged_in')->default(false);
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('terms_accepted_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('profile_updated_at')->nullable();
            $table->timestamp('initial_subscription_paid_at')->nullable();
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
