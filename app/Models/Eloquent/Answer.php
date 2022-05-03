<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id',
        'branch_id',
        'answer',
        'image_answer'
    ];

    protected $table     = 'answers';
    public $timestamps   = false;
}
