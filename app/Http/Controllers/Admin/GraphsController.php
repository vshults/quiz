<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PageGraphs;
use Illuminate\Http\Request;

class GraphsController extends Controller
{

    public function __construct()
    {
        $this->pageGraphs = new PageGraphs();
    }

    public function index(Request $request)
    {

        $request = $request->all();
        $data = [];
        $MostPopularAnswers = $this->pageGraphs->MostPopularAnswers();
        $QuestionsOftenLeft = $this->pageGraphs->QuestionsOftenLeft();

        if (!empty($MostPopularAnswers)) {

            foreach ($MostPopularAnswers as $k => $v) {
                $data['MostPopularAnswersLabels'][] = $k;
                $data['MostPopularAnswersValues'][] = $v;
            }

            $data['MostPopularAnswersColorsData'] = $this->pageGraphs->MostPopularAnswersColorsData(count($data['MostPopularAnswersLabels']));

            $data['MostPopularAnswersLabels']     = json_encode($data['MostPopularAnswersLabels']);
            $data['MostPopularAnswersValues']     = json_encode($data['MostPopularAnswersValues']);
            $data['MostPopularAnswersColorsData'] = json_encode($data['MostPopularAnswersColorsData']);
        }

        if (!empty($QuestionsOftenLeft)) {

            foreach ($QuestionsOftenLeft as $k => $v) {
                $data['QuestionsOftenLeftLabels'][] = $k;
                $data['QuestionsOftenLeftValues'][] = $v;
            }

            $data['QuestionsOftenLeftLabels'] = json_encode($data['QuestionsOftenLeftLabels']);
            $data['QuestionsOftenLeftValues'] = json_encode($data['QuestionsOftenLeftValues']);
        }

        return view('admin.graphs.graphs', $data);
    }

}
