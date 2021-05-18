<table class="table">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Logo</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @php($no = (($profiles->currentPage()-1) * $profiles->perPage()) + 1)
        @foreach($profiles as $profile)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-nowrap">{{ $profile->name }}</td>
                <td>{!! $profile->address !!}</td>
                <td class="text-nowrap">{{ $profile->phone }}</td>
                <td class="py-0 vertical-middle">
                    <img src="{{ asset("assets/$profile->file") }}" alt="" style="height: 40px;width: auto;">
                </td>
                <td class="py-1 vertical-middle text-center">
                    <button class="btn btn-info py-1 px-2" type="button" onclick="profile_info({{ $profile->id }})">
                        <i class="mdi mdi-arrow-right text-white"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $profiles->links('vendor.pagination.custom', ['function' => 'search_siswa']) }}
