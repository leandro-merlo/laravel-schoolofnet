<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Language" content="pt-br">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel: Validação e Formulários</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Laravel: Validação e Formulários</h1>
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="glyphicon glyphicon-ok-sign"></i> {{ \Session::get('message')}}
            </div>
            @endif
            @yield('content')
        </div> 
    </div>    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>