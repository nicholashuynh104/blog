<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'header_logo' => 'HVN',
            'footer_logo' => 'HVN',
            'footer_desc' => $this->faker->paragraph(),
            'email' => $this->faker->email(),
            'phone' => '0961860822',
            'address' => 'VN',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube',
            'about_title' => $this->faker->sentence(),
            'about_desc' => $this->faker->paragraph()
        ];
    }
}
