<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $client = $this->route('client');
        $marital_status = implode(',', array_keys(Client::MARITAL_STATUS));
        $client_type = $this->has('client_type') ? $this->client_type : Client::getClientType($client);
        $client_id = $client->id ?? null;
        $doc_type = $client_type == Client::TYPE_INDIVIDUAL ? 'cpf' : 'cnpj';
        $rules = [
            'name' => 'required|max:255',
            'document_number' => "required|unique:clients,document_number,$client_id|document_number:$doc_type",
            'email' => 'required|email',
            'phone' => 'required',
        ];
        if ($client_type == Client::TYPE_INDIVIDUAL) {
            $rules = array_merge($rules, [
                'date_birth' => 'required|date',
                'sex' => "required|in:m,f",
                'marital_status' => "required|in:$marital_status",
                'physical_disability' => 'max:255'                
            ]);
        } else {
            $rules = array_merge($rules, [
                'company_name' => "required|unique:clients,company_name,$client_id|max:255"
            ]);
        }
        return $rules;
    }
}
