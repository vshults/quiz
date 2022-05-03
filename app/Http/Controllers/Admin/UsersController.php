<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SaveChanges;
use App\Models\Admin\UploadImage;
use App\Models\Admin\PageUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->pageUsers = new PageUsers();
        $this->save      = new SaveChanges();
    }

    public function index(Request $request){

        $data['users'] = $this->pageUsers->show();

        return view('admin.user.users', $data);
    }

    public function editUserForm(Request $request){

        $user_id = (int)$request->route('user_id');
        $data    = $this->pageUsers->showOne($user_id);

        return view('admin.user.editUser', $data);
    }

    public function editUser(Request $request){

        $data = $request->all();
        $filenametostore = '';

        if ($request->hasFile('image_user')) {

            //получаю имя файла с разшерением
            $filenamewithextension = $request->file('image_user')->getClientOriginalName();

            //получаю имя файла без разширения
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //получаю разширенеи файла
            $extension = $request->file('image_user')->getClientOriginalExtension();

            //имя файла для хранения
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //загружаю файл на s3
            Storage::disk('s3')->put($filenametostore, fopen($request->file('image_user'), 'r+'), 'public');
        }

        $this->save->saveChanges($data, 'user',$filenametostore);

    }

    public function deleteUser(Request $request){

        $request = $request->all();
        $user_id = $request['id'];

        $this->pageUsers->deleteUser($user_id);

    }

    public function addUserForm(Request $request){

        return view('admin.user.addUser');
    }

    public function addUser(Request $request){

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $request = $request->all();

        $this->pageUsers->addUser($request);
    }

}
