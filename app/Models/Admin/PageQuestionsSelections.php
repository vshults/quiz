<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\QuestionsSelections;
use App\Models\Eloquent\Questions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageQuestionsSelections extends Model
{

    public function __construct()
    {
        $this->questionsSelections = new QuestionsSelections();
        $this->questions = new Questions();
        $this->answers = new Answer();
    }

    public function show()
    {

        $result = [];

        if (!Auth::user()->super_admin) {
            $result = $this->questionsSelections->where('user_id', Auth::user()->id)->get()->toArray();
        } else {
            $result = $this->questionsSelections->get()->toArray();
        }

        return $result;

    }

    public function getSelection($id)
    {

        $result = [];

        $result = $this->questionsSelections->where('id', $id)->get()->toArray();

        return $result[0] ?? [];

    }

    public function getQuestioins($section_id)
    {

        $questions = $this->questions->where([['host_id', null], ['selection_id', $section_id], ['branch', 0]])->orderBy('index')->get()->toArray();

        $data = [];

        if (!empty($questions)) {

            foreach ($questions as $question) {
                if ($question['branch']) {
                    if(trim($question['type']) === 'radio' || trim($question['type']) === 'checkbox' || trim($question['type']) === 'select') {
                        $answers = $this->answers->where('branch_id', $question['id'])->get()->map(function (Answer $answer) {
                            return [
                                'id'            => $answer->id,
                                'question_id'   => $answer->question_id,
                                'branch_id'     => $answer->branch_id,
                                'host_id'       => $answer->host_id,
                                'answer'        => $answer->answer,
                                'selection'     => $answer->selection,
                                'img'           => !empty($answer->image_answer) ? Storage::disk('s3')->url($answer->image_answer) : '',
                                'min'           => $answer->min,
                                'max'           => $answer->max,
                                'step'          => $answer->step,
                                'initial_value' => $answer->initial_value,
                            ];
                        })->toArray();
                    }else{
                        $answers = array_first($this->answers->where('branch_id', $question['id'])->get()->toArray());
                    }
                } else {
                    if(trim($question['type']) === 'radio' || trim($question['type']) === 'checkbox' || trim($question['type']) === 'select'){
                        $answers = $this->answers->where('question_id', $question['id'])->get()->map(function (Answer $answer) {
                            return [
                                'id'             => $answer->id,
                                'question_id'    => $answer->question_id,
                                'branch_id'      => $answer->branch_id,
                                'host_id'        => $answer->host_id,
                                'answer'         => $answer->answer,
                                'selection'      => $answer->selection,
                                'img'            => !empty($answer->image_answer) ? Storage::disk('s3')->url($answer->image_answer)  : '',
                                'min'            => $answer->min,
                                'max'            => $answer->max,
                                'step'           => $answer->step,
                                'initial_value'  => $answer->initial_value,
                            ];
                        })->toArray();
                    }else{
                        $answers = array_first($this->answers->where('question_id', $question['id'])->get()->toArray());
                    }
                }
                $question['answers'] = $answers;
                $data[] = $question;

            }
        }

        return $data;

    }

    public function addSelection($user_id)
    {
        $this->questionsSelections->insert(['user_id' => $user_id, 'name' => 'Подборка' . ' ' . date("Y-m-d H:i:s")]);
    }

    public function deleteSelection($id)
    {
        $questions = $this->questions->where([['selection_id', $id], ['host_id', null]])->get()->toArray();

        foreach ($questions as $question) {
            $this->answers->where('question_id', $question['id'])->delete();
        }
        $this->questions->where([['selection_id', $id], ['host_id', null]])->delete();

        $this->questionsSelections->where('id', $id)->delete();
    }

    public function addQuestionSelection($selection_id)
    {
        $index = $this->questions->where([['selection_id', $selection_id], ['branch', 0]])->pluck('index')->toArray();
        $index = !empty($index) ? max($index) + 1 : 1;

        $this->questions->insert(['selection_id' => $selection_id, 'index' => $index]);
    }

    public function deleteQuestionSelection($id)
    {

        $this->questions->where('id', $id)->delete();

        $results = $this->answers->where([['question_id', $id], ['branch_id', '!=', null]])->pluck('branch_id')->toArray();

        if (!empty($results)) {
            foreach ($results as $branch) {
                $this->answers->where('question_id', $branch)->delete();
                $this->questions->where('id', $branch)->delete();
            }
        }

        $this->answers->where('question_id', $id)->delete();

        deleteAll();
    }


    public function showOne($selectionID, $id)
    {
        $question = $this->questions->where([['selection_id', $selectionID], ['id', $id]])->get()->map(function (Questions $question) {
            return [
                'id' => $question->id,
                'question_id' => $question->question_id,
                'branch' => $question->branch,
                'host_id' => $question->host_id,
                'index' => $question->index,
                'title' => $question->title,
                'img' => !empty($question->img) ? Storage::disk('s3')->url($question->img) : '',
                'stage' => $question->stage,
                'type' => $question->type,
                'selection_id' => $question->selection_id,
                'required' => $question->required,
            ];
        })->collapse()->toArray();

        $data = !empty($question) ? $question : [];

        return $data;
    }

    public function addAnswerSelection($id)
    {

        $this->answers->insert(['question_id' => $id, 'selection' => 1]);
    }

    public function addBranchSelection($id, $selectionID, $type)
    {

        switch ($type) {

            case 'question':

                $this->questions->insert([['branch' => 1,'selection_id' => $selectionID]]);

                $result =  $this->questions->where([['selection_id',$selectionID],['branch',1]])->orderBy('id','DESC')->limit(1)->get()->toArray();

                $branchID = (int)$result[0]['id'];

                $this->questions->where('id', $id)->update(
                    [
                        'branch_id'     => $branchID,
                        'selection_id'  => $selectionID,
                    ]
                );
                break;

            case 'answer':

                $this->questions->insert([['branch' => 1, 'selection_id' => $selectionID]]);

                $result = $this->questions->where([['selection_id', $selectionID], ['branch', 1]])->orderBy('id', 'DESC')->limit(1)->get()->toArray();

                $branchID = (int)$result[0]['id'];

                $this->answers->where('id', $id)->update(
                    [
                        'branch_id' => $branchID,
                        'selection' => 1,
                    ]
                );
                break;
        }

    }

    public function showBranchSelection($id)
    {
        //получаем вопрос
        $question = $this->questions->where('id', $id)->get()
            ->map(function (Questions $questions) {
                return [
                    'index'        => $questions->index,
                    'host_id'      => $questions->host_id,
                    'branch'       => $questions->branch,
                    'id'           => $questions->id,
                    'title'        => $questions->title,
                    'img'          => !empty($question->img) ? Storage::disk('s3')->url($question->img) : '',
                    'stage'        => $questions->stage,
                    'type'         => $questions->type,
                    'branch_id'    => $questions->branch_id,
                    'required'     => $questions->required,
                    'selection_id' => $questions->selection_id,
                ];
            })->collapse()->toArray();

        //получаем prev
        $prev = $this->answers->where('branch_id', $question['id'])->pluck('question_id')->toArray() ?: $this->questions->where('branch_id', $question['id'])->pluck('id')->toArray();
        $branch = $this->questions->where('id', $prev[0])->pluck('branch')->toArray();
        $question['prev'] = !empty($prev) && $branch[0] ? $prev[0] : SITE . '/admin/selection/editSelection/' . $question['selection_id'];
        //получаем ответы
        $answers = $this->answers->where('question_id', $question['id'])->get()->map(function (Answer $answer) {
            return [
                'id' => $answer->id,
                'question_id' => $answer->question_id,
                'branch_id' => $answer->branch_id,
                'host_id' => $answer->host_id,
                'answer' => $answer->answer,
                'selection' => $answer->selection,
                'img' => !empty($answer->image_answer) ? Storage::disk('s3')->url($answer->image_answer) : '',
            ];
        })->toArray();
        $question['answers'] = $answers;

        $data = $question;


        return $data;
    }

}
