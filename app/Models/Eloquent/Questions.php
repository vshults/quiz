<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Questions extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'host_id',
        'branch',
        'index',
        'title',
        'stage',
        'img',
        'type',
        'required',
        'selection_id',
        'branch_id'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id');
    }

}
