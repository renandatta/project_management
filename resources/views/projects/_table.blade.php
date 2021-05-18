<table class="table">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Client</th>
        <th>Name</th>
        <th>Date Start</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @php($no = (($projects->currentPage()-1) * $projects->perPage()) + 1)
        @foreach($projects as $project)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-nowrap">{{ $project->client->name }}</td>
                <td class="text-nowrap">{{ $project->name }}</td>
                <td class="text-nowrap">{{ format_date($project->date_start) }}</td>
                <td class="py-1 vertical-middle text-center">
                    <button class="btn btn-info py-1 px-2" type="button" onclick="project_info({{ $project->id }})">
                        <i class="mdi mdi-arrow-right text-white"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $projects->links('vendor.pagination.custom', ['function' => 'search_siswa']) }}
