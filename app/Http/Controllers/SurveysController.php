<?php

namespace App\Http\Controllers;

use App\Survey;
use App\SurveyReply;

class SurveysController extends Controller
{

    public function index()
    {
        $surveys = Survey::get();
        return view('surveys.index', compact('surveys'));
    }

    public function show($id)
    {
        if ($survey = Survey::find($id)) {
            if ($reply_id = request()->cookie('reply-id')) {
                $reply = SurveyReply::find($reply_id);
                return redirect()->route('surveyreplies@show', $reply);
            }

            $reply = SurveyReply::create([ 'survey_id' => $survey->id ]);
            return redirect()->route('surveyreplies@show', $reply)->withCookie(cookie('reply-id', $reply->id, 60, '/', '', false, true));
        }

        return back()->with('danger', 'Le questionnaire n\'existe pas');
    }
}
