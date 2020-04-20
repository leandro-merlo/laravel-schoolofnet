{!! Form::hidden('id', null) !!}
{!! Form::hidden('client_type', $client_type) !!}
@component('forms._form_group_component', ['field' => 'name'])
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
@endcomponent
@component('forms._form_group_component', ['field' => 'document_number'])
    {!! Form::label('document_number', 'Documento', ['class' => 'control-label']) !!}
    {!! Form::text('document_number', null, ['class' => 'form-control', 'title' => 'Documento']) !!}
@endcomponent
@component('forms._form_group_component', ['field' => 'email'])
    {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
@endcomponent
@component('forms._form_group_component', ['field' => 'phone'])
    {!! Form::label('phone', 'Telefone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
@endcomponent
@if ($client_type == App\Models\Client::TYPE_INDIVIDUAL)
@component('forms._form_group_component', ['field' => 'marital_status'])
    {!! Form::label('marital_status', 'Estado Civil', ['class' => 'control-label']) !!}
    {!! Form::select('marital_status', $marital_statuses, null, ['class' => 'form-control']) !!}
@endcomponent
@component('forms._form_group_component', ['field' => 'date_birth'])
    {!! Form::label('date_birth', 'Data de Nascimento', ['class' => 'control-label']) !!}
    {!! Form::date('date_birth', null, ['class' => 'form-control']) !!}
@endcomponent
<div {{ $errors->has('sex') ? 'class=has-error ': ''}}>
    <label class="control-label">Sexo</label>
    <div class="radio">
        <label>
            {!! Form::radio('sex', 'm') !!} Masculino
        </label>
    </div>
    <div class="radio">
        <label>
            {!! Form::radio('sex', 'f') !!} Feminino
        </label>
    </div>
    @include('forms._helpblock', ['field' => 'sex'])
</div>
<div class="form-group">
    {!! Form::label('physical_disability', 'Deficiência Física', ['class' => 'control-label']) !!}
    {!! Form::text('physical_disability', null, ['class' => 'form-control']) !!}
</div>
@else
@component('forms._form_group_component', ['field' => 'company_name'])
    {!! Form::label('company_name', 'Nome Fantasia', ['class' => 'control-label']) !!}
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
@endcomponent
@endif    
<div {{ $errors->has('defaulter') ? 'class=has-error ': ''}}>
    <div class="checkbox">
        <label>
            {!! Form::checkbox('defaulter', 1) !!} Inadimplente?
        </label>
        @include('forms._helpblock', ['field' => 'defaulter'])
    </div>
</div>