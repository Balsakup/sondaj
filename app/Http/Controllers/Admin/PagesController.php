<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Pages\StoreRequest;
use App\Http\Requests\Admin\Pages\UpdateRequest;
use App\Page;
use App\Http\Controllers\Controller;
use App\QuestionType;
use App\Survey;

class PagesController extends Controller
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
     * @param  \App\Http\Requests\Admin\Pages\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($page = Page::create($request->only('name', 'survey_id'))) {
            return redirect()->route('admin::pages.show', $page);
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
        if ($page = Page::find($id)) {
            $questionTypes = QuestionType::pluck('label', 'id');
            return view('admin::pages.show', compact('page', 'questionTypes'));
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
        if ($page = Page::find($id)) {
            return view('admin::pages.edit', compact('page'));
        }

        return back()->with('danger', 'Une erreur est survenue');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Pages\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if ($page = Page::find($id)) {
            $page->name = $request->get('name');
            $page->save();

            return redirect()->route('admin::surveys.show', $page->survey_id)->with('success', 'La page a bien été mis à jour');
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
        Page::destroy($id);
        return back()->with('success', 'La page a bien été supprimée');
    }
}
