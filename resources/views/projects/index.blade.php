@extends('layouts.index')

@section('title')
    Projects -
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Projects</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-primary" onclick="project_info()">
                Add New
            </button>
        </div>
    </div>
    <div id="project_info"></div>
    <div class="card">
        <div class="card-body">
            <div id="projects_table"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}',
            paginate = 10;
        let $project_info = $('#project_info'),
            $projects_table = $('#projects_table');

        search_projects = () => {
            $.post("{{ route('projects.search') }}", {_token, paginate}, (result) => {
                $projects_table.html(result);
            }).fail((xhr) => {
                $projects_table.html(xhr.responseText);
            });
        }

        init_project = () => {
            $project_info.html('');
            search_projects();
        }

        project_info = (id = '') => {
            $.post("{{ route('projects.info') }}", {_token, id}, (result) => {
                $project_info.html(result);
            }).fail((xhr) => {
                $project_info.html(xhr.responseText);
            });
        }

        init_project();
    </script>
@endpush
