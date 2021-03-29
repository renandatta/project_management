@extends('layouts.index')

@section('title')
    Clients -
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Clients</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-primary" onclick="client_info()">
                Add New
            </button>
        </div>
    </div>
    <div id="client_info"></div>
    <div class="card">
        <div class="card-body">
            <div id="clients_table"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}',
            paginate = 10;
        let $client_info = $('#client_info'),
            $clients_table = $('#clients_table');

        search_clients = () => {
            $.post("{{ route('clients.search') }}", {_token, paginate}, (result) => {
                $clients_table.html(result);
            }).fail((xhr) => {
                $clients_table.html(xhr.responseText);
            });
        }

        init_client = () => {
            $client_info.html('');
            search_clients();
        }

        client_info = (id = '') => {
            $.post("{{ route('clients.info') }}", {_token, id}, (result) => {
                $client_info.html(result);
            }).fail((xhr) => {
                $client_info.html(xhr.responseText);
            });
        }

        init_client();
    </script>
@endpush
