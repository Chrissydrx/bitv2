<?php

namespace Database\Factories;

use App\Models\ProfessionalFieldDecision;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProfessionalFieldDecision>
 */
class ProfessionalFieldDecisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'professional_field_id' => random_int(1,3)
        ];
    }
}
