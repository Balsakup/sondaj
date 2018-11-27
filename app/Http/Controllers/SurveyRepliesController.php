<?php

namespace App\Http\Controllers;

use App\SurveyReply;

class SurveyRepliesController extends Controller
{

    public function show($id)
    {
        /*dd(SurveyReply::find($id)->survey->with([ 'pages' => function ($q1) {
            $q1->with([ 'questions' => function ($q2) {
                $q2->with('answers');
            } ]);
        } ])->get()->toJson(JSON_PRETTY_PRINT));*/

        $reply = SurveyReply::find($id)
            ->where('id', $id)
            ->with([ 'survey' => function ($q1) {
                $q1->with([ 'pages' => function ($q2) {
                    $q2->with([ 'questions' => function ($q3) {
                        $q3->with('answers');
                    } ]);
                } ]);
            } ])
            ->first();

        if ($reply) {
            return view('surveyreplies.show', compact('reply'));
        }

        return redirect()->route('surveys.index')->with('danger', 'Le questionnaire n\'existe pas');
    }
}
