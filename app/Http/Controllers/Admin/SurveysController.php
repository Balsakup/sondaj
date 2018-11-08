<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Surveys\StoreRequest;
use App\Http\Requests\Admin\Surveys\UpdateRequest;
use App\Survey;
use App\Http\Controllers\Controller;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin::surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Surveys\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($survey = Survey::create($request->only('name', 'description'))) {
            return redirect()->route('admin::surveys.show', $survey);
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
        if ($survey = Survey::find($id)) {
            return view('admin::surveys.show', compact('survey'));
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
        if ($survey = Survey::find($id)) {
            return view('admin::surveys.edit', compact('survey'));
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Surveys\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        Survey::where('id', $id)->update($request->only('name', 'description'));
        return redirect()->route('admin::surveys.index')->with('success', 'Le questionnaire a bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Survey::destroy($id);
        return back()->with('success', 'Le questionnaire a bien été supprimé');
    }
}
