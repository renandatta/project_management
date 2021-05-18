@extends('layouts.index')

@section('title')
    Invoices -
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Invoices</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('invoices.info') }}" class="btn btn-primary">
                Add New
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="invoices_table"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}',
            paginate = 10;
        let $invoices_table = $('#invoices_table');

        search_invoices = () => {
            $.post("{{ route('invoices.search') }}", {_token, paginate}, (result) => {
                $invoices_table.html(result);
            }).fail((xhr) => {
                $invoices_table.html(xhr.responseText);
            });
        }

        init_invoice = () => {
            search_invoices();
        }

        init_invoice();
    </script>
@endpush
