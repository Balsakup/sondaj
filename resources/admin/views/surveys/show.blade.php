@extends('admin::layouts.default')

@section('title', 'Visualisation du questionnaire')

@section('content')
    <div class="jumbotron bg-light">
        <h1>{{ $survey->name }}</h1>
        <p class="lead">{{ $survey->description }}</p>
    </div>

    <div class="card">
        <div class="card-header">Gestion des pages</div>
        <div class="card-body">
            {!! Form::open([ 'route' => 'admin::pages.store' ]) !!}

                {!! Form::hidden('survey_id', $survey->id) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nom de la page<span class="text-danger">*</span>', null, false) !!}
                    {!! Form::text('name', null, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
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
                        <th>Nom</th>
                        <th>Nombre de questions</th>
                        <th class="text-right">
                            <span class="fa fa-toolbox"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($survey->pages as $page)
                        <tr>
                            <td>{{ $page->name }}</td>
                            <td>N/A</td>
                            <td class="text-right">
                                <a href="{{ route('admin::pages.show', $page) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Voir et ajouter des questions">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <a href="{{ route('admin::pages.edit', $page) }}" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Editer la page">
                                    <span class="fa fa-edit"></span>
                                </a>

                                <a href="{{ route('admin::pages.destroy', $page) }}" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la page" onclick="confirm('Voulez-vous vraiment supprimer cette page ?\nToutes les informations associées seront perdues.') ? document.getElementById('pages-destroy-{{ $page->id }}').submit() : false; return false;">
                                    <span class="fa fa-trash"></span>
                                </a>

                                {!! Form::open([ 'route' => [ 'admin::pages.destroy', $page ], 'class' => 'd-none', 'id' => 'pages-destroy-' . $page->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
