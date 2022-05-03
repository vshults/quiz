<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Hosts;
use App\Models\Eloquent\Questions;
use App\Models\Eloquent\Answer;
use App\Models\Eloquent\QuestionsSelections;
use App\Models\Eloquent\Settings;
use App\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class SaveChanges extends Model
{
    public function __construct()
    {
        $this->hosts               = new Hosts();
        $this->questions           = new Questions();
        $this->answer              = new Answer();
        $this->setting             = new Settings();
        $this->users               = new User();
        $this->questionsSelections = new QuestionsSelections();
    }

    public function saveChanges($data,$type,$path = ''){

        $id    = (int)$data['id'];

        if(!empty($path)){
            $value = $path;
            $name  = $data['name'];
        }else{
            $name  = $data['name'];
            $value = $data['value'];
        }

        if($name === 'status'){
            $value = (int)$value;
        }

        if($name === 'password'){
            $value =  Hash::make($value);
        }

        switch ($type) {
            case 'host':

                if($name === 'scripts'){
                    $this->updateScripts($value);
                }

                $this->hosts->where('id',$id)->update(
                    [
                        $name  => $value,
                    ]
                );
                break;
            case 'setting':
                $this->setting->where('id',$id)->update(
                    [
                        $name   => $value,
                        'text'  => $value,
                    ]
                );
                break;
            case 'question_title':
                if(trim(mb_strtolower($value)) === 'необязательный'){
                    $value = 0;
                }
                if(trim(mb_strtolower($value)) === 'обязательный'){
                    $value = 1;
                }
                if(trim(strtolower($name)) === 'type' && $value !== 'radio'){
                    $results = $this->answer->where([['question_id', $id], ['branch_id', '!=', null]])->pluck('branch_id')->toArray();
                    foreach ($results as $branch) {
                        $this->questions->where('id', $branch)->delete();
                        $this->answer->where('question_id', $branch)->delete();
                    }
                    deleteAll();
                }

                $this->questions->where('id',$id)->update(
                    [
                        $name  => $value,
                    ]
                );
                break;
            case 'answer':
                $this->answer->where('id',$id)->update(
                    [
                        $name  => $value,
                    ]
                );
                break;
            case 'upload_image':
                $this->questions->where('id',$id)->update(
                    [
                        $name  => $value,
                    ]
                );
                break;
            case 'user':
                $this->users->where('id',$id)->update(
                    [
                        $name  => $value,
                    ]
                );
                break;
            case 'selection':
                $this->questionsSelections->where('id',$id)->update(
                    [
                        $name  => $value,
                    ]
                );
                break;
        }

    }

    public function updateScripts($text){

        $fp = fopen("scripts.js", "w");
        fwrite($fp, $text);
        fclose($fp);
    }


}
