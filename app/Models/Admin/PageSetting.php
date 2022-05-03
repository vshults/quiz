<?php

namespace App\Models\Admin;

use App\Models\Eloquent\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PageSetting extends Model
{

    public function __construct()
    {
        $this->settings = new Settings();
    }

    public function show($id)
    {
        $data['settings'] = $this->settings->where('id',$id)->get()->toArray();
        $data['settings'] =  $data['settings'][0] ?? [];

        $data['id']       = $id;

        return $data;
    }

}
