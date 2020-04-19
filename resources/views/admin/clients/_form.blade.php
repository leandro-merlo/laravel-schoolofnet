{{ csrf_field() }}
<input type="hidden" name="id" value="{{ old('name', $client->id) }}">
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}">
</div>
<div class="form-group">
    <label for="document_number">Documento</label>
    <input type="text" name="document_number" id="document_number" class="form-control" value="{{ old('document_number', $client->document_number) }}">
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email) }}">
</div>
<div class="form-group">
    <label for="phone">Telefone</label>
    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $client->phone) }}">
</div>
@if ($client_type == App\Models\Client::TYPE_INDIVIDUAL)
<div class="form-group">
    <label for="marital_status">Estado Civil</label>
    <select name="marital_status" id="marital_status" class="form-control" >
        <option value="">Selecione</option>
        @foreach ($marital_statuses as $key => $value)
        <option value="{{ $key }}" {{ old('marital_status', $client->marital_status) == $value ? 'selected' : '' }}>{{ $value }}</option>                
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="date_birth">Data de Nascimento</label>
    <input type="date" name="date_birth" id="date_birth" class="form-control" value="{{ old('date_birth', $client->date_birth) }}">
</div>
<div>
    <label>Sexo</label>
    <div class="radio">
        <label><input type="radio" name="sex" id="sex_m" value='m' {{ old('sex', $client->sex) == 'm' ? 'checked="checked"' : '' }}>Masculino</label>
    </div>
    <div class="radio">
        <label><input type="radio" name="sex" id="sex_f" value='f' {{ old('sex', $client->sex) == 'f' ? 'checked="checked"' : '' }}>Feminino</label>
    </div>
</div>
<div class="form-group">
    <label for="physical_disability">Deficiência Física</label>
    <input type="text" name="physical_disability" id="physical_disability" class="form-control" value="{{ old('physical_disability', $client->physical_disability) }}">
</div>
@else
<div class="form-group">
    <label for="company_name">Nome Fantasia</label>
    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $client->company_name) }}">
</div>
@endif    
<div>
    <div class="checkbox">
        <label><input type="checkbox" name="defaulter" id="defaulter" {{ old('defaulter', $client->defaulter) ? 'checked="checked"' : '' }}>Inadimplente?</label>
    </div>
</div>