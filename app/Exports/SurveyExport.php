<?php

namespace App\Exports;

use App\Models\Picture;
use Maatwebsite\Excel\Concerns\FromCollection;

class SurveyExport implements FromCollection
{
    public function __construct($survey)
    {
        $for_csv = collect([]);
        $contents = collect($survey->contents);
        // push all labels in the first row of the csv
        $for_csv->push($contents->pluck('label'));
        // foreach answer, push all values in the same row
        foreach ($survey->answers as $answer) {
            $row = collect([]);
            $a_contents = collect($answer->contents);
            foreach ($contents as $key => $content) {
                $content = collect($content);
                // if the content does not have answer, push empty string
                if (! $a_contents->has($content->get('name'))) {
                    $row->push('');

                    continue;
                }
                if (collect(['text', 'description', 'date_picker', 'slider'])->contains($content['type'])) {
                    $value = $a_contents->get($content->get('name'));
                } elseif (collect(['select', 'radio', 'likert', 'image_singleselect'])->contains($content['type'])) {
                    $name = $a_contents->get($content->get('name'));
                    if ($content['type'] != 'image_singleselect') {
                        $get_options = collect($content->get('options'));
                        $find_value = $get_options->firstWhere('value', $name);
                        $value = collect($find_value)['option'];
                    } else {
                        $value = Picture::find($name)->name;
                    }
                } elseif (collect(['checkbox', 'drag_and_drop_ranking', 'image_multiselect'])->contains($content['type'])) {
                    $names = $a_contents->get($content->get('name'));
                    $get_options = collect($content->get('options'));
                    $this_row = collect([]);

                    foreach ($names as $name) {
                        if ($content['type'] == 'image_multiselect') {
                            $value = Picture::find($name)->name;
                        } else {
                            $find_value = $get_options->firstWhere('value', $name);
                            $value = collect($find_value)['option'];
                        }
                        $this_row->push($value);
                    }

                    $value = $this_row->join('; ');
                } elseif ($content['type'] == 'textbox_list' || $content['type'] == 'continuous_sum') {
                    $this_row = collect([]);
                    foreach (collect($content['questions']) as $question) {
                        $question = collect($question);
                        $ans = collect($a_contents->get($content->get('name')));
                        $value = collect($ans)->get($question['name']);
                        $this_row->push($question->get('label').': '.$value);
                    }
                    $value = $this_row->join('; ');
                } elseif ($content['type'] == 'likert_grid' || $content['type'] == 'radio_grid') {
                    $this_row = collect([]);
                    $options = collect($content['options']);
                    foreach (collect($content['questions']) as $question) {
                        $question = collect($question);
                        $ans = collect($a_contents->get($content->get('name')));
                        $value = collect($ans)->get($question['name']);
                        $find_value = $options->firstWhere('value', $value);
                        // get ['option'] if exists
                        if (collect($find_value)->has('option')) {
                            $value = collect($find_value)['option'];
                        } else {
                            $value = '';
                        }

                        $this_row->push($question->get('label').': '.$value);
                    }
                    $value = $this_row->join('; ');
                } elseif ($content['type'] == 'checkbox_grid') {
                    $this_row = collect([]);
                    $options = collect($content['options']);
                    $ans = collect($a_contents->get($content->get('name')));
                    foreach (collect($content['questions']) as $question) {
                        $question = collect($question);
                        $ans_row = collect([]);
                        $this_ans = collect($ans)->get($question['name']);
                        // dd($ans, $options);
                        foreach ($this_ans as $a) {
                            // get $a's label from $options
                            $find_value = $options->firstWhere('value', $a);
                            if (collect($find_value)->has('option')) {
                                $a_label = collect($find_value)['option'];
                            } else {
                                $a_label = '';
                            }
                            $ans_row->push($a_label);
                        }
                        $ans_row = $ans_row->join(', ');
                        $this_row->push($question->get('label').': '.$ans_row);
                    }
                    $value = $this_row->join('; ');
                }
                $row->push($value);
            }
            $for_csv->push($row);
        }
        $this->for_csv = $for_csv;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->for_csv;
    }
}
