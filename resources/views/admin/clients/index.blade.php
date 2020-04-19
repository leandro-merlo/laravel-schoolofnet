@extends('layouts.layout')

@section('content')
    
    <h3>Listar clientes</h3>
    <a href="/admin/clients/create" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> <strong>Novo</></a>    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Sexo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $c)
                <tr>
                    <th>{{ $c->id }}</th>
                    <th>{{ $c->name }}</th>
                    <th>{{ $c->document_number }}</th>
                    <th>{{ $c->email }}</th>
                    <th>{{ $c->phone }}</th>
                    <th>{{ $c->date_birth }}</th>
                    <th>{{ $c->sex }}</th>
                    <th>
                        <div>
                            <a href="{{ route('clients.show', ['client' => $c]) }}" class="btn btn-default" alt="Detalhes" title="Detalhes">
                                <i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('clients.edit', ['client' => $c]) }}" class="btn btn-primary" alt="Editar" title="Editar">
                                <i class="glyphicon glyphicon-pencil"></i></a>
                            <form action="{{ route('clients.destroy', ['client' => $c]) }}" method="POST" class="delete-button">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" alt="Excluir" title="Excluir"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
                        </div>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection