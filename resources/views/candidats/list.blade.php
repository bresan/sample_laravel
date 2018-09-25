@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if(Auth::user()->id == 2)
                <div class="card-header">
                    Candidatos
                    <a href="{{ url('candidats/new') }}">Novo candidato</a>
                    </div>
                @endif

                <div class="card-body">
                    @if(Session::has('message_success'))
                        <div class='alert alert-success'>{{ Session::get('message_success') }}</div>
                    @endif

                    <table class="table">
                        <th>Nome</th>
                        <th>Votos</th>
                        <th>Acoes</th>
                        <tbody>
                            @foreach($candidats as $candidat)
                            <tr>
                                <td>{{ $candidat->name }}</td>
                                <td>{{ $candidat->vote }}</td>
                                <td>
                                    {!! Form::open(['method' => 'PATCH', 'url' => 'candidats/'.$candidat->id, 'style' => 'display: inline']) !!}
                                    <button type="submit" class="btn btn-default btn-sm">Votar</button>
                                    {!! Form::close() !!}

                                    @if(Auth::user()->id == 2)
                                        <a href="candidats/{{ $candidat->id }}/edit" class="btn btn-default btn-sm">Editar</a>
                                        {!! Form::open(['method' => 'DELETE', 'url' => 'candidats/'.$candidat->id, 'style' => 'display: inline']) !!}
                                        <button type="submit" class="btn btn-default btn-sm">Excluir</button>
                                        {!! Form::close() !!}
                                    @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
