<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientsRequest;
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
        $clients = Client::paginate();
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
        $marital_statuses = ['' => 'Selecione'];
        foreach(Client::MARITAL_STATUS as $key => $value) {
            $marital_statuses[$key] = $value;
        }
        $data = [
            'marital_statuses' => $marital_statuses,
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
    public function store(ClientsRequest $request)
    {   
        $client = $request->only(array_keys($request->rules()));
        $client['client_type'] = Client::getClientType($request->client_type);        
        if (!array_key_exists('defaulter', $client)) {
            $client['defaulter'] = false;                        
        }
        Client::create($client);
        return redirect()->to(route('clients.index'))
            ->with('message', 'Cliente cadastrado com sucesso!');
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
        $marital_statuses = ['' => 'Selecione'];
        foreach(Client::MARITAL_STATUS as $key => $value) {
            $marital_statuses[$key] = $value;
        }        $data = [
            'marital_statuses' => $marital_statuses,
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
    public function update(ClientsRequest $request, Client $client)
    {
        $data = $request->only(array_keys($request->rules()));
        if (!array_key_exists('defaulter', $data)) {
            $data['defaulter'] = false;                        
        }
        $client->fill($data);
        $client->save();
        return redirect()->to(route('clients.index'))    
            ->with('message', 'Cliente atualizado com sucesso!');
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
        return redirect()->to(route('clients.index'))
            ->with('message', 'Cliente removido com sucesso!');
    }

}
