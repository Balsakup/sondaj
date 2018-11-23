<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\QuestionActions\StoreRequest;
use App\QuestionAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionActionsController extends Controller
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
     * @param  \App\Http\Requests\Admin\QuestionActions\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($questionAction = QuestionAction::create($request->only('question_id', 'action_id', 'conditions'))) {
            return redirect()->route('admin::questions.show', [ 'question_id' => $questionAction->question_id, 'page' => 'actions' ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (QuestionAction::destroy($id)) {
            return back()->with('success', 'L\'action a bien été supprimée');
        }

        return back()->with('danger', 'Une erreur est survenue');
    }
}
