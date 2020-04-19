@extends('layouts.layout')

@section('content')
<h3>Editar cliente</h3>
@include('forms._error_form')
<form action="{{ route('clients.update', ['id' => $client->id ]) }}" method="POST"  >
    {{ method_field('PUT') }}
    @include('admin.clients._form')

    <div class="pull-right">
        <a href="/admin/clients" class="btn btn-default"><i class="glyphicon glyphicon-list"></i> Voltar</a>    
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-share-alt"></i> Alterar</button>
    </div>
</form>
@endsection