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
            <a href="{{ route('invoices') }}" class="btn btn-light">
                Cancel
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('invoices.save') }}">
                @csrf
                @if(!empty($invoice))
                    <x-input type="hidden" name="id" :value="$invoice->id" />
                @endif
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <x-form-group id="profile_id" caption="Profile">
                                    <x-select
                                        name="profile_id"
                                        class="select2"
                                        caption="-Select Profile-"
                                        :value="$invoice->profile_id ?? ''"
                                        :options="$list_profiles"
                                    />
                                </x-form-group>
                                <x-form-group id="project_id" caption="Project">
                                    <x-select
                                        name="project_id"
                                        class="select2"
                                        caption="-Select Project-"
                                        :value="$invoice->project_id ?? ''"
                                        :options="$list_projects"
                                    />
                                </x-form-group>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <x-form-group id="no_invoice" caption="No.Invoice">
                            <x-input name="no_invoice" :value="$no_invoice" class="text-right" />
                        </x-form-group>
                        <x-form-group id="date" caption="Date">
                            <x-input
                                name="date"
                                class="datepicker text-right"
                                :value="format_date($invoice->date ?? date('Y-m-d'))"
                            />
                        </x-form-group>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th width="5%" class="text-right">Qty</th>
                                <th width="8%">Unit</th>
                                <th width="15%" class="text-right">Price</th>
                                <th width="15%" class="text-right">Total</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="item_invoice_detail">
                            </tbody>
                        </table>
                        <button class="btn btn-light mt-3 mr-2" type="button" onclick="new_item_detail()">Add New Item</button>
                        <button class="btn btn-primary mt-3" type="submit">Save Invoice</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        init_form_element()
        let _token = '{{ csrf_token() }}', details_count = parseInt('{{ $invoice->details->count() ?? 0 }}');
        let $item_invoice_detail = $('#item_invoice_detail');

        new_item_detail = (id = '', index = '') => {
            if (index === '') index = details_count + 1;
            $.post("{{ route('invoices.details.info') }}", {_token, id, index}, (result) => {
                $item_invoice_detail.append(result);
                details_count++;
            }).fail((xhr) => {
                console.log(xhr.responseText);
            })
        }

        delete_row = (index, id = '') => {
            if (id !== '') $.post("{{ route('invoices.details.delete') }}", {_token, id});

            $('#row_' + index).remove();
            details_count--;

            if (details_count < 1) new_item_detail();
        }

        @foreach($invoice->details as $key => $detail)
            new_item_detail({{ $detail->id }}, {{ $key }});
        @endforeach

        @if(empty($invoice))
            new_item_detail();
        @endif
    </script>
@endpush
