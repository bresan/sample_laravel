@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Informe os dados do candidato
                    <a href="{{ url('candidats') }}">Lista de candidatos</a>
                    </div>

                <div class="card-body">
                    @if(Session::has('message_success'))
                        <div class='alert alert-success'>{{ Session::get('message_success') }}</div>
                    @endif

                    @if(Request::is('*/edit'))
                        {!! Form::model($candidat, ['method' => 'POST', 'url' => 'candidats/edit/'.$candidat->id]) !!}
                    @else
                        {!! Form::open(['url' => 'candidats/save']) !!}
                    @endif

                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::input('text', 'name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nome']) !!}

                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
