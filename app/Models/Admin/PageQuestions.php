<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Hosts;
use App\Models\Eloquent\Questions;
use App\Models\Eloquent\QuestionsSelections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageQuestions extends Model
{

    public $hostID;
    public $selectionID;

    public function __construct()
    {
        $this->questions           = new Questions();
        $this->answers             = new Answer();
        $this->hosts               = new Hosts();
        $this->questionsSelections = new QuestionsSelections();
    }

    public function show($id)
    {
        $this->hostID = $id;

        $host = $this->hosts->where('id', $id)->get()->map(function (Hosts $host) {
            return [
                'id'           => $host->id,
                'host_id'      => $host->host_id,
                'selection_id' => $host->selection_id,
                'domen'        => $host->domen,
                'status'       => $host->status,
            ];
        })->toArray();

        $this->selectionID = $host[0]['selection_id'] ?? null;

        //получаем вопросы
        $questions = $this->questions->where([['host_id', $id], ['branch', 0]])->orderBy('index')->get()->toArray();

        if (!empty($this->selectionID)) {
            $questions = $this->questions->where([['selection_id', $this->selectionID], ['host_id', $id], ['branch', 0]])->orderBy('index')->get()->toArray();
        }

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

    public function showOne($hostID, $id)
    {
        $question = $this->questions->where([['host_id', $hostID], ['id', $id]])->get()->map(function (Questions $question) {
            return [
                'id'             => $question->id,
                'question_id'    => $question->question_id,
                'branch'         => $question->branch ,
                'host_id'        => $question->host_id ,
                'index'          => $question->index,
                'title'          => $question->title ,
                'img'            => !empty($question->img) ? Storage::disk('s3')->url($question->img)  : '' ,
                'stage'          => $question->stage ,
                'type'           => $question->type ,
                'selection_id'   => $question->selection_id,
                'required'       => $question->required ,
            ];
        })->collapse()->toArray();

        $data = !empty($question) ? $question : [];

        return $data;
    }

    public function getSelections()
    {
        $result = [];

        if (!Auth::user()->super_admin) {
            $result = $this->questionsSelections->where('user_id', Auth::user()->id)->get()->toArray();
        } else {
            $result = $this->questionsSelections->get()->toArray();
        }

        return $result;
    }

    public function showBranch($id)
    {
        //получаем вопрос
        $question  = $this->questions->where('id',$id)->get()
            ->map(function (Questions $questions) {
                return [
                    'index'     => $questions->index,
                    'host_id'   => $questions->host_id,
                    'branch'    => $questions->branch,
                    'id'        => $questions->id,
                    'title'     => $questions->title,
                    'img'       => !empty($question->img) ? Storage::disk('s3')->url($question->img)  : '' ,
                    'stage'     => $questions->stage,
                    'type'      => $questions->type,
                    'required'  => $questions->required,
                    'branch_id'  => $questions->branch_id,
                ];
            })->collapse()->toArray();

        //получаем prev
        $prev                   = $this->answers->where('branch_id', $question['id'])->pluck('question_id')->toArray() ?: $this->questions->where('branch_id', $question['id'])->pluck('id')->toArray();

        $branch                 = $this->questions->where('id',$prev[0])->pluck('branch')->toArray();
        $question['prev']       = !empty($prev) && $branch[0] ? $prev[0] : SITE . '/admin/host/edit/questions/' . $question['host_id'];
        //получаем ответы
        $answers                = $this->answers->where('question_id', $question['id'])->get()->map(function (Answer $answer) {
            return [
                'id'             => $answer->id,
                'question_id'    => $answer->question_id,
                'branch_id'      => $answer->branch_id ,
                'host_id'        => $answer->host_id ,
                'answer'         => $answer->answer,
                'selection'      => $answer->selection ,
                'img'            => !empty($answer->image_answer) ? Storage::disk('s3')->url($answer->image_answer)  : '' ,
            ];
        })->toArray();

        $question['answers']    = $answers;

        $data                   = $question;


        return $data;
    }

    public function addQuestion($hostID, $selectionID)
    {
        if (!empty($selectionID)) {
            $index             =  $this->questions->where([['host_id' , $hostID],['selection_id' , $selectionID],['branch',0]])->pluck('index')->toArray();
            $index             = !empty($index) ? max($index) + 1 : 1;

            $this->questions->insert(['host_id' => $hostID, 'selection_id' => $selectionID , 'index' => $index]);
        } else {
            $index             =  $this->questions->where([['host_id' , $hostID],['branch',0]])->pluck('index')->toArray();
            $index             = !empty($index) ? max($index) + 1 : 1;

            $this->questions->insert(['host_id' => $hostID , 'index' => $index]);
        }
    }

    public function addAnswer($id)
    {

        $this->answers->insert(['question_id' => $id]);
    }

    public function addBranch($id, $hostID)
    {

        $this->questions->insert([['branch' => 1, 'host_id' => $hostID]]);

        $result = $this->questions->where([['host_id', $hostID], ['branch', 1]])->orderBy('id', 'DESC')->limit(1)->get()->toArray();

        $branchID = (int)$result[0]['id'];

        $this->answers->where('id', $id)->update(
            [
                'branch_id' => $branchID,
            ]
        );
    }

    public function addBranchQuestion($id, $hostID)
    {

        $this->questions->insert([['branch' => 1, 'host_id' => $hostID]]);

        $result = $this->questions->where([['host_id', $hostID], ['branch', 1]])->orderBy('id', 'DESC')->limit(1)->get()->toArray();

        $branchID = (int)$result[0]['id'];

        $this->questions->where('id', $id)->update(
            [
                'branch_id' => $branchID
            ]
        );
    }

    public function deleteQuestion($id)
    {
        $this->questions->where('id', $id)->delete();

        $results = $this->answers->where([['question_id', $id],['branch_id', '!=', null]])->pluck('branch_id')->toArray();

        if (!empty($results)) {
            foreach ($results as $branch) {
                $this->answers->where('question_id', $branch)->delete();
                $this->questions->where('id', $branch)->delete();
            }
        }

        $this->answers->where('question_id', $id)->delete();

        deleteAll();
    }

    public function deleteBranch($id)
    {

        $results = $this->answers->where([['id', $id], ['branch_id', '!=', null]])->pluck('branch_id')->toArray();

        foreach ($results as $branch) {
            $this->questions->where('id', $branch)->delete();
            $this->answers->where('question_id', $branch)->delete();
        }

        deleteAll();
    }

    public function deleteBranchQuestion($id)
    {

        $answers   = $this->answers->where([['question_id', $id], ['branch_id', '!=', null]])->pluck('branch_id')->toArray();

        $questions = $this->questions->where('branch_id', $id)->pluck('branch_id')->toArray();

        if(!empty($answers)){
            foreach ($answers as $branch) {
                $this->questions->where('id', $branch)->delete();
                $this->answers->where('question_id', $branch)->delete();
            }
        }

        $this->answers->where('question_id', $id)->delete();

        if(!empty($questions)){
            foreach ($questions as $branch) {
                $this->questions->where('id', $branch)->delete();
                $this->answers->where('question_id', $branch)->delete();
            }
        }

        $this->questions->where('id', $id)->delete();

        deleteAll();
    }


    public function deleteQuestionImage($id){

        $image = $this->questions->where('id', $id)->pluck('img')->toArray();

        Storage::disk('s3')->delete($image[0]);

        $this->questions->where('id', $id)->update(['img' => null]);

    }

    public function deleteAnswerImage($id){

        $image = $this->answers->where('id', $id)->pluck('image_answer')->toArray();

        Storage::disk('s3')->delete($image[0]);

        $this->answers->where('id', $id)->update(['image_answer' => null]);

    }

    public function deleteAnswer($id)
    {

        $results = $this->answers->where([['id', $id], ['branch_id', '!=', null]])->pluck('branch_id')->toArray();

        foreach ($results as $branch) {
            $this->questions->where('id', $branch)->delete();
        }

        $this->answers->where('id', $id)->delete();

        deleteAll();
    }

    public function sortQuestions($data)
    {
        $items = [];

        foreach ($data as $k => $v) {
            $items[$k] = (int)$v[0];
        }

        foreach ($items as $index => $id){

            $this->questions->where('id', $id)->update(
                [
                    'index' => $index,
                ]);

        }
    }

}
