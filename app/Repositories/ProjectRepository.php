<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectRepository extends Repository {

    protected $project;
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function search(Request $request)
    {
        $project = $this->project->with(['client']);

        $client_id = $request->input('client_id') ?? '';
        if ($client_id != '')
            $project = $project->where('client_id', $client_id);

        $paginate = $request->input('paginate') ?? null;
        if ($paginate != null) return $project->paginate(10);
        return $project->get();
    }

    public function find($value, $column = 'id')
    {
        return $this->project->where($column, $value)->first();
    }

    public function save(Request $request)
    {
        $request = $this->clean_date($request, ['date_start']);
        $id = $request->input('id') ?? '';
        if ($id == '')
            $project = $this->project->create($request->all());
        else {
            $project = $this->project->find($id);
            if (empty($project)) return $project;
            $project->update($request->all());
        }
        return $project;
    }

    public function delete($id)
    {
        $project = $this->project->find($id);
        if (empty($project)) return $project;
        $project->delete();
        return $project;
    }

}
