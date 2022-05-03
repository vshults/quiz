<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Hosts;
use App\Models\Eloquent\Questions;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\Tickets;
use Illuminate\Support\Facades\Auth;

class PageTickets extends Model
{

    public function __construct()
    {
        $this->hosts         = new Hosts();
        $this->tickets       = new Tickets();
        $this->questions     = new Questions();
        $this->answers       = new Answer();
    }

    public function show($user_id,$sort)
    {
        $result = [];
        $superAdmin = Auth::user()->super_admin;
        $data['host']    = (int)$sort->host;
        $data['sort']    = $sort->sort;

        if($superAdmin){

            $result =  Tickets::when($data['sort'] === 'completed', function ($query) {
                $query->where('name','!=',null)->orderBy('id','DESC');
            })->when($data['sort'] === 'unfinished', function ($query) {
                $query->where('name',null)->orderBy('id','DESC');
            })->when($data['sort'] === 'all', function ($query) {
                $query->orderBy('id','DESC');
            })->when($data['host'], function ($query, $data) {
                $query->where('host_id',$data)->orderBy('id','DESC');
            })->orderBy('id','DESC')->Simplepaginate(15);

        }else{

            $result =  Tickets::when($data['sort'] === 'completed', function ($query) {
                $query->where('name','!=',null)->orderBy('id','DESC');
            })->when($data['sort'] === 'unfinished', function ($query) {
                $query->where('name',null)->orderBy('id','DESC');
            })->when($data['sort'] === 'all', function ($query) {
                $query->orderBy('id','DESC');
            })->when($data['host'], function ($query, $data) {
                $query->where('host_id',$data)->orderBy('id','DESC');
            })->where('user_id',$user_id)->orderBy('id','DESC')->Simplepaginate(15);

        }

        return $result;
    }

    public function showTicket($id){

      $ticket =  $this->tickets->where('id',$id)->get()->toArray();

      foreach ($ticket as $item){
          $data = [
              'id'    => $item['id'],
              'name'  => !empty($item['name']) ? $item['name'] : 'Без имени',
              'phone' => !empty($item['phone']) ? $item['phone'] : 'Телефон отсутсвует',
              'date'  => !empty($item['updatet_at']) ? date("Y-m-d H:i:s",strtotime($item['updatet_at']))  :  date("Y-m-d H:i:s",strtotime($item['created_at'])),
              'data'  => $this->getData($item['data']),
          ];
      }
        return $data;
    }

    public function getData($data){
        $regular = preg_split('/\{|\}(, *)?/',$data,-1,PREG_SPLIT_NO_EMPTY);
        $values  = [];
        $keys    = [];
        foreach ($regular as $result){
            $explodes = explode(',',$result);
                foreach ($explodes as $explode){
                    $item = explode(':',$explode);
                        if($item[0] === 'Q' && !empty($item[1])){
                            $keys[] = $item[1];
                        }
                        if($item[0] === 'A'  && !empty($item[1])){
                            $values[] = $item[1];
                        }
                }
        }
        $values  = str_replace(' | ',PHP_EOL,$values);

        $results = array_combine($keys,$values);

        return $results;

    }

    public function countTickets()
    {
        $user_id    = Auth::user()->user_id;
        $superAdmin = Auth::user()->super_admin;

        if($superAdmin){
           $tickets = $this->tickets->get()->toArray();
        }else{
           $tickets = $this->tickets->where('user_id',$user_id)->get()->toArray();
        }

        $count = 0;

        if(!empty($tickets)){
            $count = count($tickets);
        }

        return $count;
    }

    public function countTicketsHost($user_id){

        $superAdmin = Auth::user()->super_admin;

        $counts = [];

        if($superAdmin){
            $hosts = $this->hosts->get()->map(function (Hosts $host) {
                return [
                    'id'      => $host->id,
                    'host_id' => $host->host_id,
                    'domen'   => $host->domen,
                ];
            })->toArray();
        }else{
            $hosts = $this->hosts->where('user_id',$user_id)->get()->map(function (Hosts $host) {
                return [
                    'id'      => $host->id,
                    'host_id' => $host->host_id,
                    'domen'   => $host->domen,
                ];
            })->toArray();
        }

        foreach ($hosts as $host){
            $tickets = $this->tickets->where('host_id',$host['id'])->get()->toArray();
            $counts[$host['domen']] = count($tickets);
        }

        return $counts;

    }

}
