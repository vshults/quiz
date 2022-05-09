<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\ShowData;
use App\Models\Ticket;
use Dotenv\Exception;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model  = new ShowData();
        $this->ticket = new Ticket();
    }

    public function getInitSetting(Request $request)
    {
        $request = $request->all();

        $host    = !empty($request['host']) ? $request['host'] : null;

        if ($this->model->hostAccessStatus($host)) {

            $id     = !empty($request['id']) ? $request['id'] : null;

            $hostID = $this->model->hostAccessStatus($host);

            $data   = $this->model->getSetting($hostID);

            if (!empty($data)) {
                $response = [
                    'status' => 'success',
                    'data'   => $data
                ];

                return response($response);

            } else {
                $response = [
                    'status' => 'error',
                    'text'   => 'no customization for this domain',
                ];

                return response($response,404);
            }

        } else {

            $response = [
                'status' => 'error',
                'text'   => 'This host does not have access'
            ];

            return response($response,404);
        }
    }

    public function handler(Request $request)
    {
        $request   = $request->all();

        //проверяем есть ли у нас такой домен
        $host              = !empty($request['host']) ? $request['host'] : null;
        $hostID            = $this->model->hostAccessStatus($host);
        $branchID          = !empty($request['branchID']) ? $request['branchID'] : null;
        $questionBranchID  = !empty($request['questionBranchID']) ? $request['questionBranchID'] : null;
        $index             = !empty($request['index']) ? $request['index'] : 0;
        $sortOrder         = isset($request['sort_order']) ? $request['sort_order'] : null;
        $filenametostore   = '';

        if ($request->hasFile('image')) {
            $filenametostore = uploadFile($request,'image');
        }

        if ($request->hasFile('file')) {
            $filenametostore = uploadFile($request,'file');
        }

        //проверяем есть ли у нас готовые вопросы к этому домену

        if ($this->model->hostQuestionsStatus($hostID)) {

            $questionID = !empty($request['questionID']) ? $request['questionID'] : null;

            $count = !empty($request['count']) ? $request['count'] : null;
            $flag  = isset($request['flag'])   ? $request['flag'] : null;

            //сохраняем выбранные ответы в тикет
            if (!empty($request['answerID']) && $request['required'] || !empty($request['name']) || !empty($request['phone'])) {
                $ticketID = $this->ticket->saveTicket($request, $hostID, $count, $flag,$filenametostore);
            }
            //если вопрос не обязательный, то пропускаем
            if(isset($request['required']) && !$request['required']){
                $ticketID = $this->ticket->saveTicket($request, $hostID, $count, $flag,$filenametostore);
            }

            $this->ticketID = !empty($ticketID) ? $ticketID : null;

            //если провалились в branch, то фиксируем вопрос куда нужно вернуться после окончания веток

            if (isset($flag)) {
                $sortOrder = $flag;
            }

            //получаем вопросы, если попался ответ с веткой
            if (!empty($branchID)) {
                $data = $this->model->getBranch($questionID, $branchID, $hostID, $index, $this->ticketID,$sortOrder);
            }else if (!empty($questionBranchID)){
                //если нет бранчей от ответа, но есть бранч на вопросе, то получаем его
                $data = $this->model->getBranch($questionID, $questionBranchID, $hostID, $index, $this->ticketID,$sortOrder);
            }else{
                //получаем вопросы
                $data = $this->model->getQuestion($questionID, $hostID, $index,$sortOrder,$flag);
            }
            //получаем актуальное количество вопросов
            if (is_null($this->ticketID)) {
                $count = $this->model->getCountQuestions($hostID);
            } else {

                if (empty($request['name']) || empty($request['phone'])) {
                    $count = $this->model->getActualQuantity($this->ticketID);
                }
            }
            //возвращение на вопрос назад
            if (!empty($request['prev'])) {
                $data = $this->model->getPrev($request['prev'], $request['ticketID'], $hostID);
            }

            if (!empty($data['count'])) {
                $count = $data['count'];
                unset($data['count']);
            }

            if (!empty($data['ticketID'])) {
                $this->ticketID = (int)$data['ticketID'];
                unset($data['ticketID']);
            }

            if (!empty($data['data'])) {
                $this->ticket->updateTicket($data['data'], $request['ticketID']);
                unset($data['data']);
            }

            $response = [
                'status'   => 'success',
                'count'    => $count,
                'ticketID' => $this->ticketID,
                'data'     => $data
            ];

            if (!empty($request['name']) || !empty($request['phone'])) {

                $response = [
                    'status' => 'success',
                    'text'   => $this->ticketID,
                ];

                return response($response);
            }

        } else {

            $response = [
                'status' => 'error',
                'text'   => 'No questions prepared for this host'
            ];
            return response($response,404);
        }

        return response($response);
    }

}
