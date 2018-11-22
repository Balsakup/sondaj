<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Questions\StoreRequest;
use App\Http\Requests\Admin\Questions\UpdateRequest;
use App\Question;
use App\QuestionRule;
use App\QuestionType;
use App\Http\Controllers\Controller;
use App\Rule;

class QuestionsController extends Controller
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
     * @param  \App\Http\Requests\Admin\Questions\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($question = Question::create($request->only('name', 'question_type_id', 'page_id'))) {
            return redirect()->route('admin::questions.show', compact('question'));
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
        if ($question = Question::find($id)) {
            $rules     = Rule::get();
            $questions = $question->page->questions;
            return view('admin::questions.show', compact('question', 'rules', 'questions'));
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($question = Question::find($id)) {
            $questionTypes = QuestionType::pluck('label', 'id');
            return view('admin::questions.edit', compact('question', 'questionTypes'));
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Questions\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if ($question = Question::find($id)) {
            $question->name             = $request->get('name');
            $question->question_type_id = $request->get('question_type_id');

            if ($question->save()) {
                return redirect()->route('admin::pages.show', $question->page_id)->with('success', 'La question a bien été modifiée');
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
        if (Question::destroy($id)) {
            return back()->with('success', 'La question a bien été supprimée');
        }

        return back()->with('danger', 'Une erreur est survenue');
    }
}
