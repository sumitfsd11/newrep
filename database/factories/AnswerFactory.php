<?php

namespace Database\Factories;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = Survey::all()->random()->id;

        return [
            'survey_id' => $id,
            'contents' => $this->get_contents($id),
        ];
    }

    public function _for(int $id)
    {
        return $this->state(function (array $attributes) use ($id) {
            return [
                'survey_id' => $id,
                'contents' => $this->get_contents($id),
            ];
        });
    }

    private function get_contents(int $id)
    {
        $survey = Survey::find($id);
        $contents = [];
        foreach ($survey->contents as $content) {
            if ($content->type == 'text') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->realTextBetween(8, 32);
                } else {
                    $contents[$content->name] = '';
                }
            } elseif ($content->type == 'description') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->realTextBetween(32, 256);
                } else {
                    $contents[$content->name] = '';
                }
            } elseif (
                $content->type == 'select' ||
                $content->type == 'radio' ||
                $content->type == 'likert' ||
                $content->type == 'image_singleselect'
            ) {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->randomElement(array_column($content->options, 'value'));
                } else {
                    $contents[$content->name] = '';
                }
            } elseif ($content->type == 'checkbox' || $content->type == 'image_multiselect') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->randomElements(array_column($content->options, 'value'), rand(1, count($content->options)));
                } else {
                    $contents[$content->name] = [];
                }
            } elseif ($content->type == 'likert_grid' || $content->type == 'radio_grid') {
                foreach ($content->questions as $question) {
                    if ($content->required || rand(0, 1)) {
                        $contents[$content->name][$question->name] = $this->faker->randomElement(array_column($content->options, 'value'));
                    } else {
                        $contents[$content->name][$question->name] = '';
                    }
                }
            } elseif ($content->type == 'date') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->date();
                } else {
                    $contents[$content->name] = '';
                }
            } elseif ($content->type == 'date_picker') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->dateTimeBetween($content->min, $content->max)->format('Y-m-d');
                } else {
                    $contents[$content->name] = '';
                }
            } elseif ($content->type === 'drag_and_drop_ranking') {
                if ($content->required || rand(0, 1)) {
                    $contents[$content->name] = $this->faker->shuffle(array_column($content->options, 'value'));
                } else {
                    $contents[$content->name] = [];
                }
            } elseif ($content->type === 'slider') {
                if ($content->required || rand(0, 1)) {
                    $randomNumber = mt_rand($content->min, $content->max - $content->step);
                    $randomNumber = $randomNumber - ($randomNumber % $content->step) + $content->step;
                    $contents[$content->name] = $randomNumber;
                } else {
                    $contents[$content->name] = $content->default;
                }
            }
        }

        return json_encode($contents);
    }
}
