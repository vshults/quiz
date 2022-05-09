<?php

namespace App\Models;

use App\Models\Eloquent\Tickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Eloquent\Questions;
use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Hosts;
use App\Models\Eloquent\Settings;
use Illuminate\Support\Facades\Storage;

class ShowData extends Model
{
    public $questions;
    public $answers;

    public function __construct()
    {
        $this->questions     = new Questions();
        $this->answers       = new Answer();
        $this->hosts         = new Hosts();
        $this->settings      = new Settings();
        $this->tickets       = new Tickets();
    }

    public function hostAccessStatus($host){

        $results =  $this->hosts->where([['domen',$host],['status',1]])->get()->map(function (Hosts $host) {
            return [
                'id'     => $host->id,
                'host'   => $host->domen,
                'status' => $host->status,
            ];})->toArray();

        $hostID = null;

        if(!empty($results)){
            foreach ($results as $result){
                $hostID = $result['id'];
            }
        }

        return $hostID;
    }

    public function hostQuestionsStatus($hostID){

        $result = false;

        if(!empty($hostID)){
            $result  = $this->questions->where('host_id',$hostID)->get()
                ->map(function (Questions $questions) {
                    return true;
                })->toArray();

        }

        return $result;
    }

    public function getSetting($hostID){

        $results = [];

        $this->hostID     = $hostID;

        $results          = $this->settings->where('host_id',$hostID)->pluck('properties')->toArray();
        $results          = !empty($results) ? json_decode($results[0],true) : [];
        $results['count'] = $this->getCountQuestions($this->hostID);

        return (object)$results;

    }

    public function getQuestion($questionID,$hostID,$index,$sortOrder,$flag)
    {

        $data = [];

        $this->index = $index + 1;
        $question = [];

        if (is_null($questionID)) {

                $question  = $this->questions->where([['host_id',$hostID],['branch',0]])->orderBy('index')->limit(1)->get()
                ->map(function (Questions $questions) {
                    return [
                            'index'              => $this->index,
                            'id'                 => $questions->id,
                            'title'              => $questions->title,
                            'img'                => !empty($questions->img) ? Storage::disk('s3')->url($questions->img)  : '' ,
                            'stage'              => $questions->stage,
                            'type'               => $questions->type,
                            'required'           => $questions->required,
                            'sort_order'         => $questions->index,
                            'questionBranchID'   => $questions->branch_id,
                    ];
                })->collapse()->toArray();
        } else {

            if(!is_null($sortOrder) || !empty($flag)){
                $question = $this->questions->where([['index', '>', (int)$sortOrder],['host_id', $hostID],['branch',0]])->orderBy('index')->limit(1)->get()
                    ->map(function (Questions $questions) {
                        return [
                            'index'              => $this->index,
                            'id'                 => $questions->id,
                            'title'              => $questions->title,
                            'img'                => !empty($questions->img) ? Storage::disk('s3')->url($questions->img)  : '' ,
                            'stage'              => $questions->stage,
                            'type'               => $questions->type,
                            'required'           => $questions->required,
                            'sort_order'         => $questions->index,
                            'questionBranchID'   => $questions->branch_id,
                        ];
                    })->collapse()->toArray();
            }
        }

        $data['question'] = !empty($question) ? $question : [];

        if(empty($question)){
            $data['question']['index'] = $this->index;
        }

        $answers = !empty($question['id']) ? $this->getAnswers($question['id'],$question['type']) : [];

        $data['question']['answers'] = !empty($answers) ? $answers : [];

        return  $data;
    }

    public function getPrev($index,$ticketID,$hostID){

        $results = $this->tickets->where('id' , $ticketID)->get()
            ->map(function (Tickets $tickets) {
                return [
                    'data'   => $tickets->data,
                ];
            })->toArray();

        $prevIndex = (int)$index - 1;
        //парсим данные о предыдущем вопросе из тикета
        foreach ($results as $result){

            $regular = preg_split('/\{|\}(, *)?/',$result['data'],-1,PREG_SPLIT_NO_EMPTY);

            foreach ($regular as $items){
                if(preg_match('/(, *)(I:' . $prevIndex . ')+/i',$items)){
                    $explodes = explode(',',$items);
                    foreach ($explodes as $item){
                        $explode = explode(':',$item);
                        if($explode[0] === 'QID') {
                            $prevQuestion = (int)$explode[1];
                        }
                        if($explode[0] === 'I') {
                            $this->index = (int)$explode[1];
                        }
                        if($explode[0] === 'C') {
                            $this->count = (int)$explode[1];
                        }
                        if($explode[0] === 'F') {
                            $this->flag = empty($explode[1]) ? null : (int)$explode[1];
                        }
                        if($explode[0] === 'R') {
                            $this->required = (int)$explode[1];
                        }
                        if($explode[0] === 'S') {
                            $this->sort_order = empty($explode[1]) ? null : (int)$explode[1];
                        }
                    }
                }
            }
        }

        $matches = [];

        preg_match('/(.*)(,QID:' . $prevQuestion . '.*[}])/', $result['data'], $matches);
        $this->data = $matches[1] . '}';

        $questions  = $this->questions->where([['host_id',$hostID],['id',$prevQuestion]])->get()
            ->map(function (Questions $questions) {
                return [
                    'index'                   => $this->index,
                    'flag'                    => $this->flag,
                    'id'                      => $questions->id,
                    'title'                   => $questions->title,
                    'required'                => $this->required,
                    'stage'                   => $questions->stage,
                    'type'                    => $questions->type,
                    'branch'                  => $questions->branch,
                    'sort_order'              => $this->sort_order,
                    'img'                     => !empty($questions->img) ? Storage::disk('s3')->url($questions->img)  : '' ,
                    'questionBranchID'        => $this->branch_id,
                ];
            })->toArray();

        if(!empty($questions)){
            foreach ($questions  as $question){
                $data['question'] = $question;
            }
        }

        $this->refreshCountQuestions($hostID, $data['question']['id'],$ticketID);

        if($question['branch']){
            $answers = !empty($question['id']) ? $this->getBranchAnswers($question['id'],$question['type']) : [];
        }else{
            $answers = !empty($question['id']) ? $this->getAnswers($question['id'],$question['type']) : [];
        }

        $data['question']['answers'] = [];

        if(!empty($answers)){
            $data['question']['answers'] = $answers;
        }

        $data['count']     = $this->count;
        $data['ticketID']  = $ticketID;
        $data['data']      = $prevIndex === 1 ? $prevIndex : $this->data;

        return $data;
    }

    public function getImage($id){

       $image =  $this->questions->where('id',$id)->pluck('img')->toArray();
       $image =  !empty($image[0]) ? ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . '/storage/' . $image[0]) : '';

       return  $image;
    }

    public function getAnswers($id,$type)
    {
        $results = [];

        switch ($type) {
            case 'range':
                $results = $this->answers->where('question_id' , $id)->get()
                    ->map(function (Answer $answers) {
                        return ['options' => [
                            'id'             => (int)$answers->id,
                            'min'            => (int)$answers->min,
                            'max'            => (int)$answers->max,
                            'step'           => (int)$answers->step,
                            'initial_value'  => (int)$answers->initial_value,
                            'pips'           => [
                                'mode'   => $answers->mode,
                                'values' => !empty($answers->division) ? explode(',' , $answers->division) : [],
                                ],
                            ]
                            ];
                    })->toArray();
                break;
            case 'select':
                $results = $this->answers->where('question_id' , $id)->get()
                    ->map(function (Answer $answers) {
                        return [
                            'id'             => $answers->id,
                            'name'           => $answers->answer,
                        ];
                    })->toArray();
                break;
            default:
                $results = $this->answers->where('question_id' , $id)->get()
                    ->map(function (Answer $answers) {
                        return [
                            'id'             => $answers->id,
                            'name'           => $answers->answer,
                            'branch_id'      => $answers->branch_id,
                            'img'            => !empty($answers->image_answer) ? Storage::disk('s3')->url($answers->image_answer)  : '' ,
                        ];
                    })->toArray();
                break;
        }

        return $results;
    }

    public function getBranch($questionID,$branchID,$hostID,$index,$ticketID,$sortOrder){

        $this->questionID       = $questionID;
        $this->index            = $index + 1;
        $this->sort_order       = $sortOrder;

        $results =  $this->questions->where([['id',(int)$branchID],['host_id',$hostID]])->get()->map(function (Questions $branch) {
            return [
                'index'                  => $this->index,
                'flag'                   => (int)$this->sort_order,
                'required'               => $branch->required,
                'id'                     => $branch->id,
                'title'                  => $branch->title,
                'stage'                  => $branch->stage,
                'img'                    => !empty($branch->img) ? Storage::disk('s3')->url($branch->img)  : '' ,
                'type'                   => $branch->type,
                'questionBranchID'       => $branch->branch_id,
            ];})->toArray();

        if(!empty($results)){
            foreach ($results as $question){
                $data['question'] = $question;
            }
        }

        $this->refreshCountQuestions($hostID, $data['question']['id'],$ticketID);
        $answers = !empty($question['id']) ? $this->getBranchAnswers($question['id'],$question['type']) : [];

        $data['question']['answers'] = [];

        if(!empty($answers)){
            $data['question']['answers'] = $answers;
        }

        return $data;
    }

    public function getBranchAnswers($id,$type){

        switch ($type) {
            case 'range':
                $results = $this->answers->where('question_id' , $id)->get()
                    ->map(function (Answer $branchAnswers) {
                        return ['options' => [
                            'id'             => (int)$branchAnswers->id,
                            'min'            => (int)$branchAnswers->min,
                            'max'            => (int)$branchAnswers->max,
                            'step'           => (int)$branchAnswers->step,
                            'initial_value'  => (int)$branchAnswers->initial_value,
                            'pips'           => [
                                'mode'   => $branchAnswers->mode,
                                'values' => !empty($branchAnswers->division) ? explode(',' , $branchAnswers->division) : [],
                            ],
                        ]
                        ];
                    })->toArray();
                break;
            case 'select':
                $results = $this->answers->where('question_id' , $id)->get()
                    ->map(function (Answer $branchAnswers) {
                        return [
                            'id'             => $branchAnswers->id,
                            'name'           => $branchAnswers->answer,
                        ];
                    })->toArray();
                break;
            default:
                $results = $this->answers->where('question_id' , $id)->get()
                    ->map(function (Answer $branchAnswers) {
                        return [
                            'id'             => $branchAnswers->id,
                            'name'           => $branchAnswers->answer,
                            'branch_id'      => $branchAnswers->branch_id,
                            'img'            => !empty($branchAnswers->image_answer) ? Storage::disk('s3')->url($branchAnswers->image_answer)  : '' ,
                        ];
                    })->toArray();
                break;
        }

        return $results;
    }

    public function getCountQuestions($hostID){

        $result = $this->questions->where([['branch',0] , ['host_id', $hostID]])->get()->toArray();
        return count($result);
    }

    public function refreshCountQuestions($hostID , $QuestionID,$ticketID){

        $questions = $this->questions->where([['branch',1] , ['host_id', $hostID]])->get()->toArray();
        $ticketID = (int)$ticketID;

        if(!empty($results)){
            foreach ($results as $question){
                $questions = $question;
            }
        }

        if(is_null($QuestionID)){
            $count = $this->getCountQuestions($hostID);
        }else{

            foreach ($questions as $question){

                $result = $this->tickets->where('id',$ticketID)->get()->toArray();
                $count = $result[0]['count'];
                $count += 1;

                if($question['id'] === $QuestionID){
                    $this->tickets->where('id', (int)$ticketID)->update(
                        [
                            'count'  => $count,
                        ]
                    );

                }else{
                    $count = $this->getCountQuestions($hostID);
                }
            }
        }

        return $count;

    }

    public function getActualQuantity($ticketID){
        $questions = $this->tickets->where('id',$ticketID)->get()->toArray();
        $count = (int)$questions[0]['count'];

        return $count;
    }

}
