<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PageQuestionsSelections;
use App\Models\Admin\SaveChanges;
use App\Models\Admin\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionsSelectionsController extends Controller
{

    public function __construct()
    {
        $this->pageQuestionsSelections = new PageQuestionsSelections();
        $this->save                    = new SaveChanges();
    }

    public function index()
    {
        $data['questions_selections'] = $this->pageQuestionsSelections->show();

        return view('admin.selection.questionsSelections', $data);
    }

    public function editSelection(Request $request)
    {
        $req = $request->all();
        $filenametostore = '';

        if (!empty($req)) {

            if (!empty($req['answer'])) {

                if ($request->hasFile('image_answer')) {

                    //получаю имя файла с разшерением
                    $filenamewithextension = $request->file('image_answer')->getClientOriginalName();

                    //получаю имя файла без разширения
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //получаю разширение файла
                    $extension = $request->file('image_answer')->getClientOriginalExtension();

                    //имя файла для хранения
                    $filenametostore = $filename . '_' . time() . '.' . $extension;

                    //загружаю файл на s3
                    Storage::disk('s3')->put($filenametostore, fopen($request->file('image_answer'), 'r+'), 'public');
                }

                $this->save->saveChanges($req, 'answer',$filenametostore);

            } else {

                if ($request->hasFile('image_question')) {

                    //получаю имя файла с разшерением
                    $filenamewithextension = $request->file('image_question')->getClientOriginalName();

                    //получаю имя файла без разширения
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //получаю разширение файла
                    $extension = $request->file('image_question')->getClientOriginalExtension();

                    //имя файла для хранения
                    $filenametostore = $filename . '_' . time() . '.' . $extension;

                    //загружаю файл на s3
                    Storage::disk('s3')->put($filenametostore, fopen($request->file('image_question'), 'r+'), 'public');
                }

                $this->save->saveChanges($req, 'question_title',$filenametostore);
            }

        } else {
            $id = (int)$request->route('id');
            $data['questions']        = $this->pageQuestionsSelections->getQuestioins($id);
            $data['selection']        = $this->pageQuestionsSelections->getSelection($id);
            $data['showBranch']       = SITE . '/admin/selection/';
            $data['edit']             = SITE . '/admin/selection/' . $id . '/question/';

            $data['selectionID']      = $id;

            return view('admin.selection.editQuestionSelection', $data);
        }
    }

    public function selectionEdit(Request $request)
    {
        $data = $request->all();

        if (!empty($data)) {
            $this->save->saveChanges($data, 'selection');
        }
    }



    public function addSelection(Request $request){

        $user_id = (int)$request['id'];

        $this->pageQuestionsSelections->addSelection($user_id);
    }

    public function deleteSelection(Request $request){

        $id = (int)$request['id'];

        $this->pageQuestionsSelections->deleteSelection($id);
    }


    public function addQuestionSelection(Request $request)
    {
        $selectionID = (int)$request['selectionID'];

        $this->pageQuestionsSelections->addQuestionSelection($selectionID);
    }

    public function deleteQuestionSelection(Request $request)
    {
        $id = (int)$request['id'];

        $this->pageQuestionsSelections->deleteQuestionSelection($id);
    }

    public function editQuestionSelection(Request $request)
    {
        $question_id  = (int)$request->route('question_id');
        $selection_id = (int)$request->route('selection_id');

        $data = $this->pageQuestionsSelections->showOne($selection_id,  $question_id);
        $data['selectionID'] = $selection_id;
        $data['prev']     = $data['branch'] ? SITE . '/admin/selection/' . $selection_id . '/question/' . $data['id'] : SITE . '/admin/selection/editSelection/' . $selection_id;

        return view('admin.selection.questionSelectionEdit', $data);
    }

    public function addAnswerSelection(Request $request)
    {
        $id = (int)$request['id'];

        $this->pageQuestionsSelections->addAnswerSelection($id);
    }

    public function deleteAnswer(Request $request)
    {

        $id = (int)$request['id'];

        $this->pageQuestionsSelections->deleteAnswerSelection($id);
    }

    public function addBranchSelection(Request $request)
    {
        $request             = $request->all();
        $selectionID         = (int)$request['selectionID'];
        $id                  = (int)$request['id'];
        $type                = $request['type'];

        $this->pageQuestionsSelections->addBranchSelection($id, $selectionID,$type);

    }

    public function editBranchSelection(Request $request)
    {
        $id                  = (int)$request->route('id');
        $selectionID         = (int)$request->route('selectionID');
        $data['question']    = $this->pageQuestionsSelections->showBranchSelection($id);

        $data['addBranch']   = SITE . 'admin/selection/add/branch';
        $data['edit']        = SITE . '/admin/selection/' . $selectionID . '/question/'  ;
        $data['selectionID'] = $selectionID;

        return view('admin.selection.showBranchSelection', $data);
    }

}
