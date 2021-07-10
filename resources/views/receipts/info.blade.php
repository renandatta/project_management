@extends('layouts.index')

@section('title')
    Receipts -
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Receipts</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('receipts') }}" class="btn btn-light">
                Kembali
            </a>
        </div>
    </div>
    <div id="receipt_info"></div>
    <div class="card">
        <div class="card-body">
            <x-alert type="error" id="alert_receipt" />
            <form id="receipt_form">
                @csrf
                <x-input type="hidden" name="invoice_id" :value="$invoice->id ?? ''" />
                @if(!empty($receipt))
                    <x-input type="hidden" name="id" :value="$receipt->id" />
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <x-form-group id="date" caption="Date">
                            <x-input name="date" :value="format_date($receipt->date ?? '')" class="datepicker" />
                        </x-form-group>
                        <x-form-group id="total" caption="Total">
                            <x-input name="total" :value="$receipt->total ?? ''" class="autonumeric" />
                        </x-form-group>
                        <button class="btn btn-primary" type="submit">Save</button>
                        @if(!empty($receipt))
                            <button class="btn btn-danger float-right" type="button" onclick="delete_receipt({{ $receipt->id }})">Delete</button>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-2"><small>Project</small><br>{{ $invoice->project->name }}</h5>
                                <h5 class="mb-2"><small>Client</small><br>{{ $invoice->project->client->name }}</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5 class="mb-2"><small>No.Invoice</small><br>{{ $invoice->no_invoice }}</h5>
                                <h5 class="mb-2"><small>Date</small><br>{{ format_date($invoice->date) }}</h5>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th width="5%" class="text-right">Qty</th>
                                <th width="8%">Unit</th>
                                <th width="15%" class="text-right">Price</th>
                                <th width="15%" class="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->details as $detail)
                                <tr>
                                    <td>{{ $detail->item }}</td>
                                    <td class="text-right">{{ format_number($detail->qty) }}</td>
                                    <td>{{ $detail->unit }}</td>
                                    <td class="text-right">{{ format_number($detail->price) }}</td>
                                    <td class="text-right">{{ format_number($detail->total) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><b>Total</b></td>
                                <td class="text-right"><b>{{ format_number($invoice->details->sum('total')) }}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        init_form_element();

        $receipt_form = $('#receipt_form');
        $receipt_form.submit((e) => {
            e.preventDefault();
            let data = new FormData($receipt_form.get(0));
            $.ajax({
                url: "{{ route('receipts.save') }}",
                type: 'post',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function() {
                    window.location.href = "{{ route('receipts') }}";
                },
            }).fail((xhr) => {
                let error = JSON.parse(xhr.responseText);
                if (error.errors) {
                    display_error('alert_receipt', error.errors);
                } else {
                    console.log(xhr.responseText);
                }
            });
        });

        delete_receipt = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value === true) {
                    let data = {_token: '{{ csrf_token() }}', id};
                    $.post("{{ route('receipts.delete') }}", data, () => {

                        window.location.href = "{{ route('receipts') }}";
                    }).fail((xhr) => {
                        let error = JSON.parse(xhr.responseText);
                        if (error.errors) {
                            display_error('alert_receipt', error.errors);
                        } else {
                            console.log(xhr.responseText);
                        }
                    });
                }
            })
        }
    </script>
@endpush
