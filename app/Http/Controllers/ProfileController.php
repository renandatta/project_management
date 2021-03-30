<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileSaveRequest;
use App\Http\Requests\DeleteRequest;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    protected $profile;
    public function __construct(ProfileRepository $profile)
    {
        $this->profile = $profile;
    }

    public function index()
    {
        Session::put('menu_active', 'profiles');
        return view('profiles.index');
    }

    public function search(Request $request)
    {
        $profiles = $this->profile->search($request);
        return view('profiles._table', compact('profiles'));
    }

    public function info(Request $request)
    {
        $profile = $this->profile->find($request->input('id'));
        return view('profiles._info', compact('profile'));
    }

    public function save(ProfileSaveRequest $request)
    {
        $filename = $this->save_file($request, 'logo');
        if ($filename != '') $request->merge(['file' => $filename]);
        return $this->profile->save($request);
    }

    public function delete(DeleteRequest $request)
    {
        $profile = $this->profile->delete($request->input('id'));
        if (!empty($profile)) $this->delete_file($profile->file);
        return $profile;
    }
}
