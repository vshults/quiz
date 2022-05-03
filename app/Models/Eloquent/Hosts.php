<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Hosts extends Model
{
    protected $table     = 'hosts';
    public $timestamps   = false;

    public function user($id){
       $results =  User::where('id',$id)->get()->map(function (User $user) {
           return [
               'email'   => $user->email,
           ];
       })->toArray();

       foreach ($results as $result){
           $userEmail = $result['email'];
       }

        return $userEmail;
    }

}
