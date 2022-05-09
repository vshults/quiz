<?php

use App\Models\Eloquent\Answer;
use App\Models\Eloquent\Questions;
use Illuminate\Support\Facades\Storage;

function deleteAll()
{
    $answers = Answer::where('question_id', null)->get()->toArray();

    if (!empty($answers)) {
        foreach ($answers as $answer) {
            if (!empty($answer['branch_id'])) {
                Questions::where('id', (int)$answer['branch_id'])->delete();
                Answer::where('id', (int)$answer['id'])->delete();
            }
            Answer::where('id', $answer['id'])->delete();
        }
        $answers = Answer::where('question_id', null)->get()->toArray();

        if (!empty($answers)) {
            deleteAll();
        }
    }
}

function uploadFile($request,$name){

        //получаю имя файла с разшерением
        $filenamewithextension = $request->file($name)->getClientOriginalName();

        //получаю имя файла без разширения
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //получаю разширенеи файла
        $extension = $request->file($name)->getClientOriginalExtension();

        //имя файла для хранения
        $filenametostore = $filename . '_' . time() . '.' . $extension;

        //загружаю файл на s3
        Storage::disk('s3')->put($filenametostore, fopen($request->file($name), 'r+'), 'public');

        return $filenametostore;

}
