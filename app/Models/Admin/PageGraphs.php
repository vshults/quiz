<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Tickets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PageGraphs extends Model
{

    public function __construct()
    {
        $this->tickets  = new Tickets();
    }

    public function MostPopularAnswers(){

        $data = [];

        $results = $this->tickets->where('user_id',(int)Auth::user()->id)->get()->map(function (Tickets $ticket) {
            return [
                'data'  => $ticket->data,
            ];
        })->toArray();

        if(!empty($results)){
            $data = $this->getData($results,1);
        }

        return $data;

    }

    public function QuestionsOftenLeft(){

        $data = [];

        $results = $this->tickets->where([['name','=',null],['user_id',(int)Auth::user()->id]])->get()->map(function (Tickets $ticket) {
            return [
                'data'  => $ticket->data,
            ];
        })->toArray();

        if(!empty($results)){
            $data = $this->getData($results,2);
        }

        return $data;

    }

    public function MostPopularAnswersColorsData($count){

        for ($i = 1;$i < $count;$i++){
            $colors[] = 'rgba(' . rand(10,200) . ',' . rand(0,200) . ',' . rand(0,200) . ',' . rand(2,10) . ')';
        }

        return array_slice($colors,-$count);
    }

    public function getData($data,$key){

        switch ($key) {
            case 1:
                foreach ($data as $arr){

                    $regular = preg_split('/\{|\}(, *)?/',$arr['data'],-1,PREG_SPLIT_NO_EMPTY);

                    foreach ($regular as $result){

                        $explodes = explode(',',$result);
                        foreach ($explodes as $explode){
                            $item = explode(':',$explode);
                            if($item[0] === 'A'  && !empty($item[1])){
                                $answers[] = $item[1];
                            }
                        }
                    }
                }
                $results = array_count_values($answers);
                break;
            case 2:
                foreach ($data as $arr){

                    $regular = preg_split('/\{|\}(, *)?/',$arr['data'],-1,PREG_SPLIT_NO_EMPTY);

                    foreach ($regular as $result){

                        $explodes = explode(',',$result);
                        foreach ($explodes as $explode){
                            $item = explode(':',$explode);
                            if($item[0] === 'Q'  && !empty($item[1])){
                                $questions[] = $item[1];
                            }
                        }
                    }
                }

                $results = array_count_values($questions);
                break;
        }
        return $results;

    }

}
