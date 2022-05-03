<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PageHost;
use App\Models\Admin\PageQuestions;
use App\Models\Admin\PageSetting;
use App\Models\Admin\SaveChanges;
use Illuminate\Support\Facades\Storage;

class HostController extends Controller
{
    public function __construct()
    {
        $this->pageHosts = new PageHost();
        $this->pageSetting = new PageSetting();
        $this->pageQuestions = new PageQuestions();
        $this->save = new SaveChanges();
    }

    /**
     * Host
     */

    public function index()
    {
        $data = $this->pageHosts->show();

        return view('admin.host.host', $data);
    }

    public function addHostForm()
    {
        return view('admin.host.addHost');
    }

    public function addHost(Request $request)
    {
        $request->validate([
            'domen'  => 'required|unique:hosts,domen',
        ]);

        $request = $request->all();

        $this->pageHosts->addHost($request);
    }

    public function deleteHost(Request $request)
    {
        $request = $request->all();
        $id = $request['id'];

        $this->pageHosts->deleteHost($id);
    }

    public function editHost(Request $request)
    {
        $data = $request->all();

        if (!empty($data)) {
            $this->save->saveChanges($data, 'host');
        } else {
            $id = (int)$request->route('id');
            $data = $this->pageHosts->show($id);

            return view('admin.host.editHost', $data);
        }
    }

    /**
     * Setting
     */

    public function editSetting(Request $request)
    {
        $data = $request->all();

        if (!empty($data)) {
            $this->save->saveChanges($data, 'setting');
        } else {
            $id = (int)$request->route('id');

            $data = $this->pageSetting->show($id);

            return view('admin.setting.editSetting', $data);
        }
    }

    /**
     * Question
     */

    public function editQuestions(Request $request)
    {
        $req = $request->all();
        $filenametostore = '';

        if (!empty($req['select'])) {
            $this->saveSelection($req['hostID'], $req['selectionID']);
        }

        if (!empty($req && empty($req['select']))) {

            if (!empty($req['answer'])) {

                if ($request->hasFile('image_answer')) {

                    //получаю имя файла с разшерением
                    $filenamewithextension = $request->file('image_answer')->getClientOriginalName();

                    //получаю имя файла без разширения
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //получаю разширенеи файла
                    $extension = $request->file('image_answer')->getClientOriginalExtension();

                    //имя файла для хранения
                    $filenametostore = $filename . '_' . time() . '.' . $extension;

                    //загружаю файл на s3
                    Storage::disk('s3')->put($filenametostore, fopen($request->file('image_answer'), 'r+'), 'public');
                }

                $this->save->saveChanges($req, 'answer', $filenametostore);
            } else {

                if ($request->hasFile('image_question')) {

                    //получаю имя файла с разшерением
                    $filenamewithextension = $request->file('image_question')->getClientOriginalName();

                    //получаю имя файла без разширения
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //получаю разширенеи файла
                    $extension = $request->file('image_question')->getClientOriginalExtension();

                    //имя файла для хранения
                    $filenametostore = $filename . '_' . time() . '.' . $extension;

                    //загружаю файл на s3
                    Storage::disk('s3')->put($filenametostore, fopen($request->file('image_question'), 'r+'), 'public');
                }

                $this->save->saveChanges($req, 'question_title', $filenametostore);
            }

        } else {
            $hostID = (int)$request->route('id');
            $data['questions'] = $this->pageQuestions->show($hostID);
            $data['selections'] = $this->pageQuestions->getSelections();
            $data['host'] = $this->pageHosts->getHost($hostID);
            $data['edit'] = SITE . '/admin/host/' . $hostID . '/question/';

            $data['hostID'] = $hostID;

            return view('admin.question.editQuestions', $data);
        }
    }

    public function addQuestion(Request $request)
    {
        $hostID = (int)$request['hostID'] ?? null;
        $selectionID = (int)$request['selectionID'] ?? null;

        $this->pageQuestions->addQuestion($hostID, $selectionID);
    }

    public function addAnswer(Request $request)
    {
        $id = (int)$request['id'];

        $this->pageQuestions->addAnswer($id);
    }

    public function addBranch(Request $request)
    {
        $request = $request->all();
        $hostID = (int)$request['hostID'];
        $id = (int)$request['id'];

        if (!empty($id)) {
            $this->pageQuestions->addBranch($id, $hostID);
        }

    }

    public function deleteQuestion(Request $request)
    {
        $id = (int)$request['id'];

        $this->pageQuestions->deleteQuestion($id);
    }

    public function deleteAnswer(Request $request)
    {

        $id = (int)$request['id'];

        $this->pageQuestions->deleteAnswer($id);
    }

    public function deleteBranch(Request $request)
    {
        $id = (int)$request['id'];

        $this->pageQuestions->deleteBranch($id);
    }

    public function editQuestion(Request $request)
    {
        $hostID = (int)$request->route('hostID');
        $id = (int)$request->route('id');

        $data = $this->pageQuestions->showOne($hostID, $id);

        $data['prev'] = $data['branch'] ? SITE . '/admin/host/' . $hostID . '/question/' . $data['id'] : SITE . '/admin/host/edit/questions/' . $hostID;
        $data['hostID'] = $hostID;

        return view('admin.question.editQuestion', $data);
    }

    public function deleteQuestionImage(Request $request)
    {
        $id = (int)$request['id'];
        $this->pageQuestions->deleteQuestionImage($id);
    }

    public function deleteAnswerImage(Request $request)
    {
        $id = (int)$request['id'];
        $this->pageQuestions->deleteAnswerImage($id);
    }

    public function editBranch(Request $request)
    {
        $id = (int)$request->route('id');
        $hostID = (int)$request->route('hostID');
        $data['question'] = $this->pageQuestions->showBranch($id);

        $data['addBranch'] = SITE . '/admin/host/question/' . $hostID . '/add/branch/';
        $data['edit'] = SITE . '/admin/host/' . $hostID . '/question/';
        $data['hostID'] = $hostID;

        return view('admin.question.showBranch', $data);
    }

    public function sortQuestions(Request $request)
    {
        $request = $request->all();

        $this->pageQuestions->sortQuestions($request);
    }

    public function saveSelection($hostID, $selectionID)
    {
        $this->pageHosts->saveSelection($hostID, $selectionID);
    }

}
