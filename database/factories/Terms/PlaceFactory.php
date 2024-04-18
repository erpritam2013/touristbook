<?php

namespace Database\Factories\Terms;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Terms\Place;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Place::class;
    public function definition()
    {
        
     
      $name = $this->faker->words(1, true);
        return [
            'name' => $name,
            'slug' => SlugService::createSlug(Place::class, 'slug', $name),
            'description' => $this->faker->text,
            'place_type' => "Location",
            'icon' => 'fas fa-cog',
            //'parent_id' => rand(1,10)
            
        ];
    }
}
