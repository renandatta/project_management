<table class="table">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>No.Receipt</th>
        <th>Invoice</th>
        <th>Client</th>
        <th>Date</th>
        <th>Total</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
        @php($no = (($receipts->currentPage()-1) * $receipts->perPage()) + 1)
        @foreach($receipts as $receipt)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-nowrap">{{ $receipt->no_receipt }}</td>
                <td class="text-nowrap">{{ $receipt->invoice->project->name }}</td>
                <td class="text-nowrap">{{ $receipt->invoice->project->client->name }}</td>
                <td class="text-nowrap">{{ format_date($receipt->date) }}</td>
                <td class="text-nowrap">{{ format_number($receipt->total) }}</td>
                <td class="py-1 vertical-middle text-center">
                    <a class="btn btn-info py-1 px-2" href="{{ route('receipts.info', $receipt->id) }}">
                        <i class="mdi mdi-arrow-right text-white"></i>
                    </a>
                    <a target="_blank" class="btn btn-success py-1 px-2" href="{{ route('receipts.print', $receipt->id) }}">
                        <i class="mdi mdi-printer text-white"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $receipts->links('vendor.pagination.custom', ['function' => 'search_receipts']) }}
