<table class="table">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>No.Invoice</th>
        <th>Date</th>
        <th>Client</th>
        <th>Project</th>
        <th class="text-right">Total</th>
        <th class="text-right">Paid</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
        @php($no = (($invoices->currentPage()-1) * $invoices->perPage()) + 1)
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-nowrap">{{ $invoice->no_invoice }}</td>
                <td class="text-nowrap">{{ format_date($invoice->date) }}</td>
                <td>{{ $invoice->project->client->name }}</td>
                <td>{{ $invoice->project->name }}</td>
                <td class="text-right">{{ format_number($invoice->details->sum('total')) }}</td>
                <td class="text-right">{{ format_number($invoice->receipts->sum('total')) }}</td>
                <td class="py-1 vertical-middle text-center text-nowrap">
                    <a class="btn btn-info py-1 px-2" href="{{ route('invoices.info', $invoice->id) }}">
                        <i class="mdi mdi-arrow-right text-white"></i>
                    </a>
                    <a target="_blank" class="btn btn-success py-1 px-2" href="{{ route('invoices.print', $invoice->id) }}">
                        <i class="mdi mdi-printer text-white"></i>
                    </a>
                    <a class="btn btn-primary py-1 px-2" href="{{ route('receipts.info', ['invoice_id' => $invoice->id]) }}">
                        <i class="mdi mdi-share text-white"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $invoices->links('vendor.pagination.custom', ['function' => 'search_siswa']) }}
