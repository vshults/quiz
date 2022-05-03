<?php

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Questions;

function deleteAll()
{
    $answers = Answer::where('question_id', null)->get()->toArray();

    if (!empty($answers)) {
        foreach ($answers as $answer) {
            if (!empty($answer['branch_id'])) {
                Questions::where('id', (int)$answer['branch_id'])->delete();
                Answer::where('id', (int)$answer['id'])->delete();
            }
            Answer::where('id', $answer['id'])->delete();
        }
        $answers = Answer::where('question_id', null)->get()->toArray();

        if (!empty($answers)) {
            deleteAll();
        }
    }
}
