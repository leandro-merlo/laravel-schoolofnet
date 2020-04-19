<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $data = compact('clients');
        return view('admin.clients.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'marital_statuses' => Client::MARITAL_STATUS,
            'client_type' => Client::getClientType($request->client_type),
            'client' => new Client()
        ];
        return view('admin.clients.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $client = $this->validateData($request);
        $client['client_type'] = Client::getClientType($request->client_type);        
        if (!array_key_exists('defaulter', $client)) {
            $client['defaulter'] = false;                        
        }
        Client::create($client);
        return redirect()->to(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $data = [
            'marital_statuses' => Client::MARITAL_STATUS,
            'client_type' => $client->client_type,
            'client' => $client
        ];
        return view('admin.clients.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $this->validateData($request);
        if (!array_key_exists('defaulter', $data)) {
            $data['defaulter'] = false;                        
        }
        $client->fill($data);
        $client->save();
        return redirect()->to(route('clients.index'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->to(route('clients.index'));    
    }

    protected function validateData(Request $request) {
        $client = $request->route('client');
        $marital_status = implode(',', array_keys(Client::MARITAL_STATUS));
        $client_type = $request->has('client_type') ? $request->client_type : Client::getClientType($client);
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

        return $this->validate($request, $rules);        
    }
}
