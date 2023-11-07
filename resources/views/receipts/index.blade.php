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
            <button type="button" class="btn btn-primary" onclick="receipt_info()">
                Add New
            </button>
        </div>
    </div>
    <div id="receipt_info"></div>
    <div class="card">
        <div class="card-body">
            <div id="receipts_table"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}',
            paginate = 10;
        let $receipt_info = $('#receipt_info'),
            $receipts_table = $('#receipts_table');

        let selected_page = 1;
        search_receipts = (page = 1) => {
            if (page.toString() === '+1') selected_page++;
            else if (page.toString() === '-1') selected_page--;
            else selected_page = page;

            $.post("{{ route('receipts.search') }}?page=" + selected_page, {_token, paginate}, (result) => {
                $receipts_table.html(result);
            }).fail((xhr) => {
                $receipts_table.html(xhr.responseText);
            });
        }

        init_receipt = () => {
            $receipt_info.html('');
            search_receipts();
        }

        receipt_info = (id = '') => {
            $.post("{{ route('receipts.info') }}", {_token, id}, (result) => {
                $receipt_info.html(result);
            }).fail((xhr) => {
                $receipt_info.html(xhr.responseText);
            });
        }

        init_receipt();
    </script>
@endpush
