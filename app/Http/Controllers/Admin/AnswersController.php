<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answers\StoreRequest;
use App\Http\Requests\Admin\Answers\UpdateRequest;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Answers\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if (Answer::create($request->only('name', 'value', 'question_id'))) {
            return back();
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($answer = Answer::find($id)) {
            return view('admin::answers.edit', compact('answer'));
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Answers\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if ($answer = Answer::find($id)) {
            $answer->name  = $request->get('name');
            $answer->value = $request->get('value');

            if ($answer->save()) {
                return redirect()->route('admin::questions.show', $answer->question_id)->with('success', 'La réponse a bien été modifiée');
            }
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Answer::destroy($id)) {
            return back()->with('success', 'La réponse a bien été supprimée');
        }

        return back()->with('danger', 'Une erreur est survenue');
    }
}
