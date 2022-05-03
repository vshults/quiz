<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/admin/host/edit/host',
        '/admin/host/addSettingItem',
        '/admin/host/edit/setting',
        '/handler',
        '/admin/selection/addSelection',
        '/admin/selection/deleteSelection',
        '/getInitSetting',
        '/admin/host/addHost',
        '/admin/host/deleteHost',
        '/admin/host/selection/add',
        '/admin/host/question/add',
        'admin/host/question/delete',
        '/admin/selection/addQuestionSelection',
        '/admin/selection/deleteQuestionSelection',
        '/admin/selection/answer/add',
        '/admin/selection/answer/delete',
        '/admin/selection/add/branch',
        '/admin/selection/edit',
        '/admin/host/saveSelection',
        '/admin/host/selection/delete',
        '/admin/host/answer/add',
        '/admin/host/answer/delete',
        '/admin/host/branch/delete',
        '/admin/host/edit/question/uploadImage',
        '/admin/host/edit/questions',
        '/admin/host/question/add/branch',
        '/admin/tickets',
        '/admin/users',
        '/admin/users/add',
        '/admin/user/add',
        '/admin/user/edit',
        '/admin/graphs',
        '/admin/user/delete',
        '/admin/sortQuestions',
        '/admin/host/answer/deleteAnswerImage',
        '/admin/host/question/deleteQuestionImage'
    ];
}
