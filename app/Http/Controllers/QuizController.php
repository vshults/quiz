<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\ShowData;
use App\Models\Ticket;
use Dotenv\Exception;

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
        $host      = !empty($request['host']) ? $request['host'] : null;
        $hostID    = $this->model->hostAccessStatus($host);
        $branchID  = !empty($request['branchID']) ? $request['branchID'] : null;
        $index     = !empty($request['index']) ? $request['index'] : 0;
        $sortOrder = isset($request['sort_order']) ? $request['sort_order'] : null;
        //проверяем есть ли у нас готовые вопросы к этому домену

        if ($this->model->hostQuestionsStatus($hostID)) {

            $questionID = !empty($request['questionID']) ? $request['questionID'] : null;

            $count = !empty($request['count']) ? $request['count'] : null;
            $flag  = isset($request['flag'])   ? $request['flag'] : null;

            //сохраняем выбранные ответы в тикет
            if (!empty($request['answerID']) && $request['required'] || !empty($request['name']) || !empty($request['phone'])) {
                $ticketID = $this->ticket->saveTicket($request, $hostID, $count, $flag);
            }
            //если вопрос не обязательный, то пропускаем
            if(isset($request['required']) && !$request['required']){
                $ticketID = $this->ticket->saveTicket($request, $hostID, $count, $flag);
            }

            $this->ticketID = !empty($ticketID) ? $ticketID : null;

            //если провалились в branch, то фиксируем вопрос куда нужно вернуться после окончания веток

            if (isset($flag)) {
                $sortOrder = $flag;
            }

            //получаем вопросы
            $data = $this->model->getQuestion($questionID, $hostID, $index,$sortOrder,$flag);
            //получаем вопросы, если попался ответ с веткой
            if (!empty($branchID)) {
                $data = $this->model->getBranch($questionID, $branchID, $hostID, $index, $this->ticketID,$sortOrder);
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
