@extends('layouts.layout')

@section('content')

    <h3>Detalhes do Cliente</h3>
    <br><br>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th scope="row">ID</th>
                <td>{{ $client->id }}</td>
            </tr>
            <tr>
                <th scope="row">Nome</th>
                <td>{{ $client->name }}</td>
            </tr>
            <tr>
                <th scope="row">Documento</th>
                <td>{{ $client->document_number_formatted }}</td>
            </tr>
            <tr>
                <th scope="row">E-mail</th>
                <td>{{ $client->email }}</td>
            </tr>
            <tr>
                <th scope="row">Telefone</th>
                <td>{{ $client->phone }}</td>
            </tr>
            @if ($client->client_type == App\Models\Client::TYPE_INDIVIDUAL)
            <tr>
                <th scope="row">Estado Civil</th>
                <td>{{ $client->marital_status_formatted }}</td>
            </tr>
            <tr>
                <th scope="row">Data de Nascimento</th>
                <td>{{ $client->date_birth_formatted }}</td>
            </tr>
            <tr>
                <th scope="row">Sexo</th>
                <td>{{ $client->sex_formatted }}</td>
            </tr>
            <tr>
                <th scope="row">Deficiência Física</th>
                <td>{{ $client->physical_disability }}</td>
            </tr>
            @else
            <tr>
                <th scope="row">Nome Fantasia</th>
                <td>{{ $client->company_name }}</td>
            </tr>
            @endif
            <tr>
                <th scope="row">Inadimplente</th>
                <td>{{ $client->defaulter ? 'Sim' : 'Não' }}</td>
            </tr>            
        </tbody>
        <tr>
            <td colspan="2">
                <a href="{{ route('clients.index') }}" class="btn btn-default"><i class="glyphicon glyphicon-list"></i> Lista</a>
                <a href="{{ route('clients.edit', ['client' => $client] ) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                {!! Form::open([ 'route' => ['clients.destroy', $client], 'method' => 'DELETE', 'class' => "delete-button"]) !!}
                    <button type="submit" class="btn btn-danger" alt="Excluir" title="Excluir"><i class="glyphicon glyphicon-trash"></i> Excluir</button>
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
    
@endsection