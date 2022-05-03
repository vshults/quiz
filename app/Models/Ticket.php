<?php

namespace App\Models;

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Hosts;
use App\Models\Eloquent\Questions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Eloquent\Tickets;
use App\Models\ShowData;
use App\Http\Controllers\MailController;

class Ticket extends Model
{
    public function __construct()
    {
        $this->tickets       = new Tickets();
        $this->model         = new ShowData();
        $this->hosts         = new Hosts();
        $this->questions     = new Questions();
        $this->answers       = new Answer();
        $this->mail          = new MailController();
    }

    public function saveTicket($request,$hostID,$count,$flag)
    {

        $ticketID   = !empty($request['ticketID'])     ? $request['ticketID']     : null;
        $QuestionID = !empty($request['questionID'])   ? $request['questionID']   : null;
        $AnswerID   = !empty($request['answerID'])     ? $request['answerID']     : null;
        $name       = !empty($request['name'])         ? $request['name']         : null;
        $phone      = !empty($request['phone'])        ? $request['phone']        : null;
        $index      = !empty($request['index'])        ? $request['index']        : null;
        $required   = !empty($request['required'])     ? $request['required']     : null;
        $sort_order = isset($request['sort_order'])    ? $request['sort_order']   : null;

        if(is_null($sort_order)){
            $sort_order = $this->questions->where('host_id' , $hostID)->pluck('index')->toArray();
            $sort_order = !empty($sort_order) ? min($sort_order) : 1;
        }

        $hosts =  $this->hosts->where('id',$hostID)->get()
            ->map(function (Hosts $host) {
                return [
                    'user_id' => $host->user_id,
                ];
            })->toArray();

        $user_id = null;

        foreach ($hosts as $host){
            $user_id = $host['user_id'];
        }

        $questionTitle = $this->questions->where('id',$QuestionID)->pluck('title')->toArray();

        $questionTitle = !empty($questionTitle) ? $questionTitle[0] : ' ';

        $answerTitle = ' ';

        if(!is_array($AnswerID)){
            if(!is_null($AnswerID)){
                $answerTitle = $this->answers->where('id',$AnswerID)->pluck('answer')->toArray();
                $answerTitle = !empty($answerTitle[0]) ? $answerTitle[0] : ' ';
            }
        }else{
            $answerTitles = [];
            foreach ($AnswerID as $item_id){
                $answerTitle    = $this->answers->where('id',$item_id)->pluck('answer')->toArray();
                if(!empty($answerTitle)){
                    $answerTitles[] = $answerTitle[0];
                }
            }
            $answerTitle = implode(' | ',$answerTitles);
        }

        if (!is_null($ticketID)) {
            $ticket = $this->tickets->where('id', $ticketID)->get()
                ->map(function (Tickets $tickets) {
                    return [
                        'data' => $tickets->data,
                    ];
                })->toArray();

            if(!empty($name)){
                $data = $ticket[0]['data'];
            }else{
                $data = $ticket[0]['data'] . '{Q:' . $questionTitle . ',A:' . $answerTitle . ',I:' . $index . ',C:' . $count . ',S:' . $sort_order . ',F:' . $flag . ',QID:' . $QuestionID . ',R:' . $required . '}';
            }

            $this->tickets->where('id', $ticketID)->update(
                [
                    'data'    => $data,
                    'name'    => $name,
                    'phone'   => $phone,
                    'host_id' => $hostID,
                    'user_id' => $user_id,
                    'count'   => $count,
                ]
            );
        } else {

            $count = $this->model->getCountQuestions($hostID);
            $data = '{Q:' . $questionTitle . ',A:' . $answerTitle . ',I:' . $index . ',C:' . $count . ',S:' . $sort_order . ',F:' . $flag . ',QID:' . $QuestionID . ',R:' . $required . '}';
            $date = date('Y-m-d H:i:s');
            $this->tickets->insert(['data' => $data,'count' => $count,'host_id' => $hostID , 'user_id' => $user_id,'created_at' => $date]);

            $ticket = $this->tickets->orderBy('id', 'DESC')->limit(1)->get()
                ->map(function (Tickets $tickets) {
                    return [
                        'id' => $tickets->id,
                    ];
                })->toArray();

            $ticketID = $ticket[0]['id'];
        }

        if(!empty($name) || !empty($phone)){

            //$this->mail->sendTicket($ticketID,$hostID);

            $response = 'All data added successfully';
        }

        return !empty($response) ? $response : $ticketID;
    }

    public function getActualQuantity($ticketID){

      $results = $this->tickets->where('id' , $ticketID)->get()
          ->map(function (Tickets $tickets) {
              return [
                  'count'   => $tickets->count,
              ];
          })->toArray();

      return $results[0]['count'];

    }

    public function updateTicket($data,$ticketID){

        $data = $data === 1 ? '' : $data;

        $data === 1 ?? $this->tickets->where('id', $ticketID)->update(['count',3]);

        $this->tickets->where('id', $ticketID)->update(
            [
                'data'  => $data,
            ]
        );
    }


}
