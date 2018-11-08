@extends('admin::layouts.default')

@section('title', 'Liste des questionnaires')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Nombre de pages</th>
                        <th>Créé le</th>
                        <th>Mis à jour le</th>
                        <th class="text-right">
                            <span class="fa fa-toolbox"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                        <tr>
                            <td>{{ $survey->name }}</td>
                            <td>{{ $survey->page_count }}</td>
                            <td>{{ $survey->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $survey->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin::surveys.show', $survey) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Voir et ajouter des pages">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <a href="{{ route('admin::surveys.edit', $survey) }}" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Editer le questionnaire">
                                    <span class="fa fa-edit"></span>
                                </a>

                                <a href="{{ route('admin::surveys.destroy', $survey) }}" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer le questionnaire" onclick="confirm('Voulez-vous vraiment supprimer ce questionnaire ?\nToutes les informations associées seront perdues.') ? document.getElementById('surveys-destroy-{{ $survey->id }}').submit() : false; return false;">
                                    <span class="fa fa-trash"></span>
                                </a>

                                {!! Form::open([ 'route' => [ 'admin::surveys.destroy', $survey ], 'class' => 'd-none', 'id' => 'surveys-destroy-' . $survey->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
