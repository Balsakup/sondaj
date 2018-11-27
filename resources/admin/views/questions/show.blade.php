@extends('admin::layouts.default')

@section('title', 'Visualisation de la question')

@section('content')
    <div class="jumbotron bg-light">
        <h1>{{ $question->name }}</h1>

        @switch(request('page'))
            @case('rules')
                <p class="lead">Gestion des règles</p>
                @break
            @case('actions')
                <p class="lead">Gestion des actions</p>
                @break
            @default
                <p class="lead">Gestions des réponses</p>
        @endswitch
    </div>

    <nav class="nav nav-pills nav-justified mb-3">
        <a href="{{ route('admin::questions.show', [ $question, 'page' => 'answers' ]) }}" class="nav-item nav-link{{ request('page') === 'answers' || !request('page') ? ' active' : '' }}">Réponses</a>
        <a href="{{ route('admin::questions.show', [ $question, 'page' => 'rules' ]) }}" class="nav-item nav-link{{ request('page') === 'rules' ? ' active' : '' }}">Règles</a>
        <a href="{{ route('admin::questions.show', [ $question, 'page' => 'actions' ]) }}" class="nav-item nav-link{{ request('page') === 'actions' ? ' active' : '' }}">Actions</a>
    </nav>

    @if (request('page') === 'rules')
        <div class="card">
            <div class="card-body">
                {!! Form::open([ 'route' => 'admin::questionrules.store' ]) !!}

                    {!! Form::hidden('question_id', $question->id) !!}

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('rule_id', 'Règle à utiliser<span class="text-danger">*</span>', null, false) !!}
                                <select name="rule_id" id="rule_id" class="form-control{{ $errors->has('rule_id') ? ' is-invalid' : '' }}">
                                    <option selected disabled>Choisissez une règle</option>
                                    @foreach ($rules as $rule)
                                        <option value="{{ $rule->id }}" data-name="{{ $rule->name }}">{{ $rule->label }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('rule_id'))
                                    <span class="invalid-feedback">{{ $errors->first('rule_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('src_question_id', 'Si la question<span class="text-danger">*</span>', null, false) !!}
                            <select name="src_question_id" id="src_question_id" class="form-control{{ $errors->has('src_question_id') ? ' is-invalid': '' }}">
                                <option selected disabled>Choisissez une question</option>
                                @foreach ($question->page->questions as $q)
                                    <option value="{{ $q->id }}" data-is-multiple="{{ $q->type->is_multiple ? 'true' : 'false' }}" data-answers="{{ $q->answers()->select([ 'id', 'name' ])->get() }}">{{ $q->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('src_question_id'))
                                <span class="invalid-feedback">{{ $errors->first('src_question_id') }}</span>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <label for="src_question_sign">&nbsp;</label>
                            <select name="src_question_sign" id="src_question_sign" class="form-control">
                                <option selected disabled>---</option>
                                <option value="==">Egale</option>
                                <option value=">">Supérieur</option>
                                <option value="<">Inférieur</option>
                                <option value=">=">Supérieur ou égale</option>
                                <option value="<=">Inférieur ou égale</option>
                                <option value="!=">Différent</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('src_question_value', 'Valeur<span class="text-danger">*</span>', null, false) !!}

                            @if ($errors->has('src_question_value'))
                                <span class="invalid-feedback">{{ $errors->first('src_question_value') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('conditions', 'Conditions<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::textarea('conditions', null, [ 'class' => 'form-control' . ($errors->has('conditions') ? ' is-invalid' : ''), 'rows' => 3, 'readonly' ]) !!}

                        @if ($errors->has('conditions'))
                            <span class="invalid-feedback">{{ $errors->first('conditions') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-0">
                        <hr>
                        {!! Form::button('Ajouter', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                    </div>

                {!! Form::close() !!}
            </div>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Règle</th>
                            <th class="text-right">
                                <span class="fa fa-toolbox"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($question->rules as $rule)
                            <tr style="border-left: 5px solid #{{ substr(md5($rule->rule->name), -6) }};">
                                <td>{{ $rule->rule->label }}</td>
                                <td>{{ $rule->conditions }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin::questionrules.destroy', $rule) }}" class="btn btn-sm btn-outline-danger" onclick="confirm('Voulez-vous vraiment supprimer cette règle ?') ? document.getElementById('questionrules-destroy-{{ $rule->id }}').submit() : false; return false;">
                                        <span class="fa fa-trash"></span>
                                    </a>

                                    {!! Form::open([ 'route' => [ 'admin::questionrules.destroy', $rule ], 'id' => 'questionrules-destroy-' . $rule->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif (request('page') === 'actions')
        <div class="card">
            <div class="card-body">
                {!! Form::open([ 'route' => 'admin::questionactions.store' ]) !!}

                    {!! Form::hidden('question_id', $question->id) !!}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('action_id', 'Règle à utiliser<span class="text-danger">*</span>', null, false) !!}
                                <select name="action_id" id="action_id" class="form-control{{ $errors->has('action_id') ? ' is-invalid' : '' }}">
                                    <option selected disabled>Choisissez une action</option>
                                    @foreach ($actions as $action)
                                        <option value="{{ $action->id }}" data-name="{{ $action->name }}">{{ $action->label }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('action_id'))
                                    <span class="invalid-feedback">{{ $errors->first('action_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="src_sign">&nbsp;</label>
                                <select name="src_sign" id="src_sign" class="form-control">
                                    <option selected disabled>---</option>
                                    <option value="==">Egale</option>
                                    <option value=">">Supérieur</option>
                                    <option value="<">Inférieur</option>
                                    <option value=">=">Supérieur ou égale</option>
                                    <option value="<=">Inférieur ou égale</option>
                                    <option value="!=">Différent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('src_value', 'Valeur<span class="text-danger">*</span>', null, false) !!}
                                @if ($question->type->is_multiple)
                                    <select name="src_value" id="src_value" class="form-control{{ $errors->has('src_value') ? ' is-invalid' : '' }}">
                                        <option selected disabled>---</option>
                                        @foreach ($question->answers as $answer)
                                            <option value="{{ $answer->id }}">{{ $answer->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    {!! Form::text('src_value', null, [ 'class' => 'form-control' . ($errors->has('src_value') ? ' is-invalid' : '') ]) !!}
                                @endif

                                @if ($errors->has('src_value'))
                                    <span class="invalid-feedback">{{ $errors->has('src_value') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('conditions', 'Conditions<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::textarea('conditions', null, [ 'class' => 'form-control' . ($errors->has('conditions') ? ' is-invalid' : ''), 'rows' => 3, 'readonly' ]) !!}

                        @if ($errors->has('conditions'))
                            <span class="invalid-feedback">{{ $errors->first('conditions') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-0">
                        <hr>
                        {!! Form::button('Ajouter', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                    </div>

                {!! Form::close() !!}
            </div>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Action</th>
                            <th class="text-right">
                                <span class="fa fa-toolbox"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody data-sortable>
                        @foreach ($question->actions as $action)
                            <tr style="border-left: 5px solid #{{ substr(md5($action->action->name), -6) }};">
                                <td>{{ $action->action->label }}</td>
                                <td>{{ $action->conditions }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin::questionactions.destroy', $action) }}" class="btn btn-sm btn-outline-danger" onclick="confirm('Voulez-vous vraiment supprimer cette action ?') ? document.getElementById('questionactions-destroy-{{ $action->id }}').submit() : false; return false;">
                                        <span class="fa fa-trash"></span>
                                    </a>

                                    {!! Form::open([ 'route' => [ 'admin::questionactions.destroy', $action ], 'id' => 'questionactions-destroy-' . $action->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        @if ($question->type->is_multiple)
            <div class="card">
                <div class="card-body">
                    {!! Form::open([ 'route' => 'admin::answers.store' ]) !!}

                        {!! Form::hidden('question_id', $question->id) !!}

                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('name', 'Nom de la réponse<span class="text-danger">*</span>', null, false) !!}
                                {!! Form::text('name', null, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('value', 'Valeur de la réponse') !!}
                                {!! Form::text('value', null, [ 'class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : '') ]) !!}

                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">{{ $errors->first('value') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <hr>
                            {!! Form::button('Ajouter', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                        </div>

                    {!! Form::close() !!}
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Valeur</th>
                                <th class="text-right">
                                    <span class="fa fa-toolbox"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody data-sortable="\App\Answer">
                            @foreach ($question->answers as $answer)
                                <tr class="table-align-middle" data-id="{{ $answer->id }}">
                                    <td>
                                        <span class="fa fa-bars" style="cursor: move;"></span>
                                        <span class="ml-3">{{ $answer->name }}</span>
                                    </td>
                                    <td>{{ $answer->value }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin::answers.edit', $answer) }}" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Editer la réponse">
                                            <span class="fa fa-edit"></span>
                                        </a>

                                        <a href="{{ route('admin::answers.destroy', $answer) }}" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la réponse" onclick="confirm('Voulez-vous vraiment supprimer cette réponse ?\nToutes les informations associées seront perdues.') ? document.getElementById('answers-destroy-{{ $answer->id }}').submit() : false; return false;">
                                            <span class="fa fa-trash"></span>
                                        </a>

                                        {!! Form::open([ 'route' => [ 'admin::answers.destroy', $answer ], 'class' => 'd-none', 'id' => 'answers-destroy-' . $answer->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-danger">Le type de question <span class="font-italic font-weight-bold">{{ $question->type->label }}</span> ne prend pas en charge les réponses</div>
        @endif
    @endif
@endsection
