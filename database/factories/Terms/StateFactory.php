<?php

namespace Database\Factories\Terms;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Terms\State;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\State>
 */
class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = State::class;
    public function definition()
    {
         $name = $this->faker->words(1, true);
        return [
            'name' => $name,
            'slug' => SlugService::createSlug(State::class, 'slug', $name),
            'description' => $this->faker->text,
            'icon' => 'fas fa-cog',
            'country'=> 106,
            //'parent_id' => rand(1,10)
            
        ];
    }
}
