<?php
/** Dashboard **/
Breadcrumbs::for('admin::dashboard.home', function ($trail) {
    $trail->push('<span class="fa fa-home"></span>', route('admin::dashboard.home'));
});

/** Surveys **/
Breadcrumbs::for('admin::surveys.index', function ($trail) {
    $trail->parent('admin::dashboard.home');
    $trail->push('Questionnaires', route('admin::surveys.index'));
});

Breadcrumbs::for('admin::surveys.show', function ($trail, $id) {
    $survey = \App\Survey::find($id);

    $trail->parent('admin::surveys.index');
    $trail->push($survey->name, route('admin::surveys.show', $survey));
});

Breadcrumbs::for('admin::surveys.edit', function ($trail, $id) {
    $survey = \App\Survey::find($id);

    $trail->parent('admin::surveys.index');
    $trail->push($survey->name, route('admin::surveys.edit', $survey));
});

/** Pages **/
Breadcrumbs::for('admin::pages.show', function ($trail, $id) {
    $page = \App\Page::find($id);

    $trail->parent('admin::surveys.show', $page->survey_id);
    $trail->push($page->name, route('admin::pages.show', $page));
});

Breadcrumbs::for('admin::pages.edit', function ($trail, $id) {
    $page = \App\Page::find($id);

    $trail->parent('admin::surveys.show', $page->survey_id);
    $trail->push($page->name, route('admin::pages.edit', $page));
});

/** Questions **/
Breadcrumbs::for('admin::questions.show', function ($trail, $id) {
    $question = \App\Question::find($id);

    $trail->parent('admin::pages.show', $question->page_id);
    $trail->push($question->name, route('admin::questions.show', $question));
});

Breadcrumbs::for('admin::questions.edit', function ($trail, $id) {
    $question = \App\Question::find($id);

    $trail->parent('admin::pages.show', $question->page_id);
    $trail->push($question->name, route('admin::questions.edit', $question));
});

/** Answers **/
Breadcrumbs::for('admin::answers.edit', function ($trail, $id) {
    $answer = \App\Answer::find($id);

    $trail->parent('admin::questions.show', $answer->question_id);
    $trail->push($answer->name, route('admin::questions.edit', $answer));
});
