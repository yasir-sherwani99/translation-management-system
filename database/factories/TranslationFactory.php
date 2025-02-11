<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tag;
use App\Models\Locale;
use App\Models\Translation;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'word' => $this->faker->word, // Generate a random word for key
            'translation' => $this->faker->sentence, // Generate a random sentence for translation
            'locale_id' => Locale::inRandomOrder()->first()->id, // Randomly select an existing locale
            'tag_id' => Tag::inRandomOrder()->first()->id, // Randomly select an existing tag
        ];
    }
}
