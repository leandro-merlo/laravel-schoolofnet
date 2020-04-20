@extends('layouts.layout')

@section('content')
<h3>Editar cliente</h3>
@include('forms._error_form')
{!! Form::model($client, ['route' => ['clients.update', $client->id] , 'method' => 'PUT']) !!}
    @include('admin.clients._form')
    <div class="pull-right">
        <a href="/admin/clients" class="btn btn-default"><i class="glyphicon glyphicon-list"></i> Voltar</a>    
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-share-alt"></i> Alterar</button>
    </div>
{!! Form::close() !!}
@endsection