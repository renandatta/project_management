<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientRepository {

    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(Request $request)
    {
        $client = $this->client;

        $paginate = $request->input('paginate') ?? null;
        if ($paginate != null) return $client->paginate(10);
        return $client->get();
    }

    public function find($value, $column = 'id')
    {
        return $this->client->where($column, $value)->first();
    }

    public function save(Request $request)
    {
        $id = $request->input('id') ?? '';
        if ($id == '')
            $client = $this->client->create($request->all());
        else {
            $client = $this->client->find($id);
            if (empty($client)) return $client;
            $client->update($request->all());
        }
        return $client;
    }

    public function delete($id)
    {
        $client = $this->client->find($id);
        if (empty($client)) return $client;
        $client->delete();
        return $client;
    }

    public function dropdown()
    {
        $result = array();
        $clients = $this->client->latest()->get();
        foreach ($clients as $client) $result[$client->id] = $client->name;
        return $result;
    }

}
