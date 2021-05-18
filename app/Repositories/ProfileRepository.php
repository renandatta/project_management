<?php

namespace App\Repositories;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileRepository {

    protected $profile;
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function search(Request $request)
    {
        $profile = $this->profile;

        $paginate = $request->input('paginate') ?? null;
        if ($paginate != null) return $profile->paginate(10);
        return $profile->get();
    }

    public function find($value, $column = 'id')
    {
        return $this->profile->where($column, $value)->first();
    }

    public function save(Request $request)
    {
        $id = $request->input('id') ?? '';
        if ($id == '')
            $profile = $this->profile->create($request->all());
        else {
            $profile = $this->profile->find($id);
            if (empty($profile)) return $profile;
            $profile->update($request->all());
        }
        return $profile;
    }

    public function delete($id)
    {
        $profile = $this->profile->find($id);
        if (empty($profile)) return $profile;
        $profile->delete();
        return $profile;
    }

    public function dropdown()
    {
        $result = array();
        $profiles = $this->profile->latest()->get();
        foreach ($profiles as $profile) $result[$profile->id] = $profile->name;
        return $result;
    }

}
