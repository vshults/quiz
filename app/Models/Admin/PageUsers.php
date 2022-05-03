<?php

namespace App\Models\Admin;

use App\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PageUsers extends Model
{

    public function __construct()
    {
        $this->users   = new User();
    }

    public function show(){

        $data = $this->users->get()->toArray();

        return $data;

    }

    public function showOne($user_id){

        $user = $this->users->where('id',$user_id)->get()->map(function (User $user) {
            return [
                'id'             => $user->id,
                'super_admin'    => $user->super_admin,
                'name'           => $user->name,
                'password'       => $user->password,
                'email'          => $user->email,
                'role'           => $user->role ,
                'img'            => !empty($user->img) ? Storage::disk('s3')->url($user->img)  : '',
            ];
        })->collapse()->toArray();

        $data = !empty($user) ? $user : [];

        return $data;

    }

    public function addUser($data){

        $password =  Hash::make($data['password']);

        $this->users->insert(['name' => $data['name'],'email' => $data['email'],'role' => '' , 'super_admin' => (int)$data['super_admin'],'password' => $password]);

        session()->flash('success', 'You are logged');
    }

    public function deleteUser($user_id){
        $this->users->where('id',$user_id)->delete();
    }

}
