<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientSaveRequest;
use App\Http\Requests\DeleteRequest;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    protected $client;
    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        Session::put('menu_active', 'clients');
        return view('clients.index');
    }

    public function search(Request $request)
    {
        $clients = $this->client->search($request);
        return view('clients._table', compact('clients'));
    }

    public function info(Request $request)
    {
        $client = $this->client->find($request->input('id'));
        return view('clients._info', compact('client'));
    }

    public function save(ClientSaveRequest $request)
    {
        return $this->client->save($request);
    }

    public function delete(DeleteRequest $request)
    {
        return $this->client->delete($request->input('id'));
    }

}
