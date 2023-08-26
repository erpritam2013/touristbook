<?php

namespace Database\Factories\Terms;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Terms\Type;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Type::class;

    public function definition()
    {
      $lebal_types = config('global.lebal_types');
      $count_l = count($lebal_types)-1;
      $name = $this->faker->words(1, true);
        return [
            'name' => $name,
            'slug' => SlugService::createSlug(Type::class, 'slug', $name),
            'description' => $this->faker->text,
            'type' => "Location",
            'lebal_type' => $lebal_types[rand(0,$count_l)],
            'parent_id' => rand(1,10)
            
        ];
    }
}
