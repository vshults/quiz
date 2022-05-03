<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Hosts;
use App\Models\Eloquent\Questions;
use App\Models\Eloquent\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PageHost extends Model
{

    public function __construct()
    {
        $this->hosts     = new Hosts();
        $this->setting   = new Settings();
        $this->questions = new Questions();
        $this->answers   = new Answer();
    }

    public function show($id = null)
    {
        $superAdmin = Auth::user()->super_admin;
        $user_id    = (int)Auth::user()->id;

        if(is_null($id)){

            if($superAdmin){
                $data['hosts'] = $this->hosts->get()->map(function (Hosts $host) {
                    return [
                        'id'            => $host->id,
                        'domen'         => $host->domen,
                        'email'         => $this->hosts->user($host->user_id),
                        'status'        => $host->status,
                        'setting_id'    => $host->setting_id,
                    ];
                })->toArray();
            }else{
                $data['hosts'] = $this->hosts->where('user_id',$user_id)->get()->map(function (Hosts $host) {
                    return [
                        'id'            => $host->id,
                        'domen'         => $host->domen,
                        'status'        => $host->status,
                        'setting_id'    => $host->setting_id,
                    ];
                })->toArray();
            }

        }else{
            $results = $this->hosts->where('id',$id)->get()->map(function (Hosts $host) {
                return [
                    'id'                 => $host->id,
                    'domen'              => $host->domen,
                    'control_emails'     => $host->control_emails,
                    'scripts'            => $host->scripts,
                    'status'             => $host->status,
                ];
            })->toArray();

            foreach ($results as $result){
                $data['host'] = $result;
            }

        }

        return $data;
    }

    public function showForUser($id)
    {
        $superAdmin = Auth::user()->super_admin;

        if($superAdmin){
            $results = $this->hosts->get()->map(function (Hosts $host) {
                return [
                    'id'      => $host->id,
                    'domen'   => $host->domen,
                    'host_id' => $host->host_id,
                    'status'  => $host->status,
                ];
            })->toArray();
        }else{
            $results = $this->hosts->where('user_id',$id)->get()->map(function (Hosts $host) {
                return [
                    'id'      => $host->id,
                    'host_id' => $host->host_id,
                    'domen'   => $host->domen,
                    'status'  => $host->status,
                ];
            })->toArray();
        }

        $data = [];

        if(!empty($results)){
            $data = $results;
        }

        return $data;
    }

    public function addHost($request){

        $user_id = (int)Auth::user()->id;

        $this->hosts->insert(['domen' => $request['domen'],'status' => (int)$request['status'],'user_id' => $user_id,'control_emails' => $request['emails']]);

        $lastAdded  = $this->hosts->orderBy('id','DESC')->limit(1)->get()
            ->map(function (Hosts $host) {
                return [
                    'id'    => $host->id,
                ];
            })->toArray();

        $this->host_id = $lastAdded[0]['id'];

        $this->setting->insert(
            [
                'host_id'     => $this->host_id,
                'text'        => SETTING,
                'properties'  => SETTING,
            ]
        );

        $setting_id  = $this->setting->where('host_id',$this->host_id)->get()
            ->map(function (Settings $setting) {
                return [
                    'id'    => $setting->id,
                ];
            })->toArray();

        $setting_id = !empty($setting_id) ? $setting_id[0]['id'] : '';

        $this->hosts->where('id',$this->host_id)->update([
                'setting_id'  => (int)$setting_id,
            ]);

    }

    public function deleteHost($hostID){

        $questions  = (array)$this->questions->where('host_id',$hostID)->get()
            ->map(function (Questions $question) {
                return [
                    'id'    => $question->id,
                ];
            })->toArray();

        foreach ($questions as $question){
            $this->answers->where('question_id',$question['id'])->delete();
        }

        $this->questions->where('host_id',$hostID)->delete();

        $this->setting->where('host_id',$hostID)->delete();

        $this->hosts->where('id',$hostID)->delete();

    }

    public function saveSelection($hostID,$selectionID){
        $this->hostID = $hostID;
        $selectionID  = !empty($selectionID) ? (int)$selectionID : null;

        $this->hosts->where('id',(int)$hostID)->update([
            'selection_id'  => $selectionID,
        ]);

        if(!empty($selectionID)){

            //удаляем предущие
            $questions = $this->questions->where([['host_id',$hostID], ['selection_id','!=',null]])->get()->toArray();

            if(!empty($questions)){
                foreach ($questions as $question){
                    $this->answers->where('question_id',$question['id'])->delete();
                }
            }

            $this->questions->where([['host_id',$hostID], ['selection_id','!=',null]])->delete();

            //удаляем произвольные
            $questions = $this->questions->where([['host_id',$hostID], ['selection_id',null]])->get()->toArray();

            if(!empty($questions)){
                foreach ($questions as $question){
                    $this->answers->where('question_id',$question['id'])->delete();
                }
            }

            $this->questions->where([['host_id',$hostID], ['selection_id',null]])->delete();

            //если выбрана подборка, то дублируем ее вопросы и привязывем к этому домену
            $questions_selections = $this->questions->where([['host_id',null],['selection_id',$selectionID]])->get()->map(function (Questions $question) {
                return [
                    'id'            => $question->id,
                    'host_id'       => (int)$this->hostID,
                    'selection_id'  => $question->selection_id,
                    'branch'        => $question->branch,
                    'index'         => $question->index,
                    'title'         => $question->title,
                    'stage'         => $question->stage,
                    'img'           => $question->img,
                    'type'          => $question->type,
                    'required'      => $question->required,
                ];
            })->toArray();

            $branch_keys   = [];
            //дублируем вопросы и ответы к ним
            foreach ($questions_selections as $question_selection){
                $answers = $this->answers->where('question_id', $question_selection['id'])->get()->toArray();
                $id = $question_selection['id'];
                unset($question_selection['id']);
                $this->questions->insert($question_selection);
                $question = $this->questions->where([['host_id',(int)$this->hostID], ['selection_id',$selectionID]])->orderBy('id','desc')->limit(1)->get()->toArray();
                if(!empty($question[0]) && $question[0]['branch']){
                    $branch_keys[$id]   = $question[0]['id'];
                }
                if(!empty($question && !empty($answers))){
                    foreach ($answers as $answer){
                        unset($answer['id']);
                        unset($answer['selection']);
                        $answer['host_id'] = $this->hostID;
                        $answer['question_id'] = $question[0]['id'];
                        $this->answers->insert($answer);
                    }
                }
            }
            //добавляем branch id к ответам

            foreach ($branch_keys as $k => $v){

                $this->answers->where([['branch_id',$k],['selection',0],['host_id',$this->hostID]])->update(['branch_id' => $v]);
            }
        }else{
            //удаляем дубликаты
            $questions = $this->questions->where([['host_id',$hostID], ['selection_id','!=',null]])->get()->toArray();

            if(!empty($questions)){
                foreach ($questions as $question){
                    $this->answers->where('question_id',$question['id'])->delete();
                }
            }

            $this->questions->where([['host_id',$hostID], ['selection_id','!=',null]])->delete();
        }

    }

    public function getHost($id){

        $result = $this->hosts->where('id',$id)->get()->map(function (Hosts $host) {
            return [
                'id'            => $host->id,
                'host_id'       => $host->host_id,
                'selection_id'  => $host->selection_id,
                'domen'         => $host->domen,
                'status'        => $host->status,
            ];
        })->toArray();

        return $result[0] ?? [];
    }

}
