<table class="table">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @php($no = (($clients->currentPage()-1) * $clients->perPage()) + 1)
        @foreach($clients as $client)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-nowrap">{{ $client->name }}</td>
                <td>{!! $client->address !!}</td>
                <td class="text-nowrap">{{ $client->phone }}</td>
                <td class="py-1 vertical-middle text-center">
                    <button class="btn btn-info py-1 px-2" type="button" onclick="client_info({{ $client->id }})">
                        <i class="mdi mdi-arrow-right text-white"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $clients->links('vendor.pagination.custom', ['function' => 'search_siswa']) }}
