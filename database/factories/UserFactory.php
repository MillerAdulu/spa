<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() //complete definition 
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'mobile_phone_number' => $this->faker->phone,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'terms_accepted_at' => now(),
            'profile_updated_at' => now(),
            'subscription_paid_at' => now(),
            'user_two_fa_authenticated_at' => now(),
            'deleted_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverifiedemail()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's phone number should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverifiedphonenumber()
    {
        return $this->state(function (array $attributes) {
            return [
                'phone_number_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's profile should be unupdated.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unupdatedprofile()
    {
        return $this->state(function (array $attributes) {
            return [
                'profile_updated_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's subscription should be unpaid.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unpaidsubscription()
    {
        return $this->state(function (array $attributes) {
            return [
                'subscription_paid_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's two-fa status should be unactivated.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unactivatedtwofa()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_two_fa_authenticated_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's user should be undeleted.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function undeleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => null,
            ];
        });
    }
}
