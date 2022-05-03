<?php

Route::get('/','MainController@index')->name('front.index');

Route::match(['get', 'post'], '/getInitSetting', 'QuizController@getInitSetting');

Route::match(['get', 'post'], '/handler', 'QuizController@handler');

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'admin'] , function (){

    /**
        MainController
     */

    Route::get('/','MainController@index')->name('admin.index');

    /**
        HostController
     */

    Route::match(['get', 'post'], '/sortQuestions', 'HostController@sortQuestions');

    Route::get('/hosts','HostController@index')->name('admin.hosts');

    /**
        HostController Edit
     */


    Route::get('/host/edit/host/{id}','HostController@editHost');

    Route::match(['get', 'post'], '/host/addSettingItem', 'HostController@addSettingItem');

    Route::get('/host/edit/setting/{id}','HostController@editSetting');

    Route::get('/host/edit/questions/{id}','HostController@editQuestions');

    /**
        HostController SaveChanges
     */

    Route::match(['get', 'post'], '/host/edit/host', 'HostController@editHost');

    Route::match(['get', 'post'], '/host/{hostID}/question/{id}/edit', 'HostController@editQuestion');

    Route::match(['get', 'post'], '/host/saveSelection', 'HostController@editQuestions');

    Route::match(['get', 'post'], '/host/{hostID}/question/{id}', 'HostController@editBranch');

    Route::match(['get', 'post'], '/host/edit/setting', 'HostController@editSetting');

    Route::match(['get', 'post'], '/host/edit/questions', 'HostController@editQuestions')->name('admin.hosts.questions');

    Route::match(['get', 'post'], '/host/edit/question/uploadImage', 'HostController@uploadImage');

    /**
        HostController Add
     */

    Route::match(['get', 'post'], '/host/addHostForm', 'HostController@addHostForm')->name('hostAddForm');

    Route::match(['get', 'post'], '/host/addHost', 'HostController@addHost');

    Route::match(['get', 'post'], '/host/question/add', 'HostController@addQuestion');

    Route::match(['get', 'post'], '/host/answer/add', 'HostController@addAnswer');

    Route::match(['get', 'post'], '/host/question/add/branch', 'HostController@addBranch');

    Route::match(['get', 'post'], '/host/question/add/branchQuestion', 'HostController@addBranchQuestion');

    /**
        HostController Delete
     */

    Route::match(['get', 'post'], '/host/deleteHost', 'HostController@deleteHost');

    Route::match(['get', 'post'], '/host/question/delete', 'HostController@deleteQuestion');

    Route::match(['get', 'post'], '/host/answer/delete', 'HostController@deleteAnswer');

    Route::match(['get', 'post'], '/host/branch/delete', 'HostController@deleteBranch');

    Route::match(['get', 'post'], '/host/branchQuestion/delete', 'HostController@deleteBranchQuestion');

    Route::match(['get', 'post'], '/host/answer/deleteAnswerImage', 'HostController@deleteAnswerImage');

    Route::match(['get', 'post'], '/host/question/deleteQuestionImage', 'HostController@deleteQuestionImage');
    /**
        UsersController
     */

    Route::match(['get', 'post'], '/users', 'UsersController@index')->name('admin.users');

    Route::match(['get', 'post'], '/users/add', 'UsersController@addUserForm');

    Route::match(['get', 'post'], '/user/add', 'UsersController@addUser');

    Route::match(['get', 'post'], '/users/edit/{user_id}', 'UsersController@editUserForm');

    Route::match(['get', 'post'], '/user/edit', 'UsersController@editUser');

    Route::match(['get', 'post'], '/user/delete', 'UsersController@deleteUser');

    /**
         TicketController
     */

    Route::match(['get', 'post'], '/tickets', 'TicketController@index')->name('admin.tickets');

    Route::match(['get', 'post'], '/ticket/{id}', 'TicketController@showTicket');

    /**
    QuestionsSelectionsController
     */

    Route::get('/selections', 'QuestionsSelectionsController@index')->name('admin.questionsSelections');

    Route::match(['get', 'post'], 'selection/addSelection', 'QuestionsSelectionsController@addSelection');

    Route::match(['get', 'post'], 'selection/deleteSelection', 'QuestionsSelectionsController@deleteSelection');

    Route::match(['get', 'post'], 'selection/editSelection/{id}', 'QuestionsSelectionsController@editSelection')->name('admin.editQuestionsSelections');

    Route::match(['get', 'post'], 'selection/edit', 'QuestionsSelectionsController@selectionEdit');

    Route::match(['get', 'post'], 'selection/addQuestionSelection', 'QuestionsSelectionsController@addQuestionSelection');

    Route::match(['get', 'post'], 'selection/deleteQuestionSelection', 'QuestionsSelectionsController@deleteQuestionSelection');

    Route::match(['get', 'post'], 'selection/{selection_id}/question/{question_id}/edit', 'QuestionsSelectionsController@editQuestionSelection');

    Route::match(['get', 'post'], 'selection/answer/add', 'QuestionsSelectionsController@addAnswerSelection');

    Route::match(['get', 'post'], 'selection/answer/delete', 'QuestionsSelectionsController@deleteAnswerSelection');

    Route::match(['get', 'post'], 'selection/add/branch', 'QuestionsSelectionsController@addBranchSelection');

    Route::match(['get', 'post'], '/selection/{selectionID}/question/{id}', 'QuestionsSelectionsController@editBranchSelection');



    /**
       GraphsController
     */

    Route::match(['get', 'post'], '/graphs', 'GraphsController@index')->name('admin.graphs');

});

Route::group(['middleware' => 'guest'],function (){

    Route::get('/login', 'UserController@loginForm')->name('login.create');

    Route::post('/login', 'UserController@login')->name('login');

});

Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth')->middleware('auth');

Route::get('/sendTicket', 'MailController@sendTicket');

Route::get('/', function () {
    return redirect('/login');
});
