@extends('layouts.layout')

@section('content')
<h3>Criar cliente - {{ $client_type == App\Models\Client::TYPE_INDIVIDUAL ? 'Pessoa Física' : 'Pessoa Jurídica'}}</h3>
<a href="{{ route('clients.create', ['client_type' => App\Models\Client::TYPE_INDIVIDUAL]) }}">Pessoa Física</a> | 
<a href="{{ route('clients.create', ['client_type' => App\Models\Client::TYPE_LEGAL]) }}">Pessoa Jurídica</a>
@include('forms._error_form')
<form action="{{ route('clients.store') }}" method="POST">
    @include('admin.clients._form')
    <div class="pull-right">
        <a href="/admin/clients" class="btn btn-default"><i class="glyphicon glyphicon-list"></i> Voltar</a>    
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-share-alt"></i> Criar</button>
    </div>
</form>
@endsection