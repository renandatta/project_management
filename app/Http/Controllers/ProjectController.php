<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectSaveRequest;
use App\Http\Requests\DeleteRequest;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $project;
    public function __construct(ProjectRepository $project, ClientRepository $client)
    {
        $this->project = $project;
        view()->share(['list_clients' => $client->dropdown()]);
    }

    public function index()
    {
        session(['menu_active' => 'projects']);
        return view('projects.index');
    }

    public function search(Request $request)
    {
        $projects = $this->project->search($request);
        return view('projects._table', compact('projects'));
    }

    public function info(Request $request)
    {
        $project = $this->project->find($request->input('id'));
        return view('projects._info', compact('project'));
    }

    public function save(ProjectSaveRequest $request)
    {
        return $this->project->save($request);
    }

    public function delete(DeleteRequest $request)
    {
        return $this->project->delete($request->input('id'));
    }
}
