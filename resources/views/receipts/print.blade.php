@extends('layouts.print')

@section('title')
    Receipt {{ $invoice->project->name }}
@endsection

@push('styles')
    <style>
        @media print {
            body {-webkit-print-color-adjust: exact;}
        }
        #title {
            font-size: 68pt;
        }
        .bg-main {
            background-color: #00e676!important;
        }
        .row-header {
            height: 80px;
        }
        .mt-header {
            margin-top: 30px;
        }
        .row-footer {
            height: auto;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .mt-footer {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .mx-default {
            margin-left: 4cm!important;
            margin-right: 4cm!important;
        }
    </style>
@endpush

@section('content')
    <div class="mx-default" style="margin-top: 2cm;margin-bottom: 3cm;">
        <div class="row">
            <div class="col-6">
                <h1 id="title">RECEIPT</h1>
                <div class="row">
                    <div class="col-6 pl-3">
                        <b>#{{ $invoice->no_invoice }}</b>
                    </div>
                    <div class="col-6">
                        <b>{{ fulldate($invoice->date) }}</b>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6 text-right">
                        Receipt To :
                    </div>
                    <div class="col-6">
                        <b>{{ $invoice->project->client->name }}</b>
                        <br><br>
                        {{ $invoice->project->client->address }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 bg-main">
        <div class="row row-header mx-default">
            <div class="col-6">
                <div class="row mt-header">
                    <div class="col-1">
                        <h6>#</h6>
                    </div>
                    <div class="col-11"><h6>Item</h6></div>
                </div>
            </div>
            <div class="col-2"><h6 class="mt-header text-right">Qty</h6></div>
            <div class="col-2"><h6 class="mt-header text-right">Price</h6></div>
            <div class="col-2"><h6 class="mt-header text-right">Total</h6></div>
        </div>
    </div>
    @foreach($invoice->details as $key => $detail)
        <div class="row mx-default">
            <div class="col-6">
                <div class="row mt-header">
                    <div class="col-1">
                        <h6>{{ $key+1 }}</h6>
                    </div>
                    <div class="col-11"><h6>{{ $detail->item }}</h6></div>
                </div>
            </div>
            <div class="col-2"><h6 class="mt-header text-right">{{ format_number($detail->qty). ' ' . $detail->unit }}</h6></div>
            <div class="col-2"><h6 class="mt-header text-right">{{ format_number($detail->price) }}</h6></div>
            <div class="col-2"><h6 class="mt-header text-right">{{ format_number($detail->total) }}</h6></div>
        </div>
    @endforeach
    <div class="w-100 bg-main mt-4">
        <div class="row row-footer mx-default">
            <div class="col-10"><h6 class="mt-footer text-right">Invoice Total</h6></div>
            <div class="col-2"><h6 class="mt-footer text-right">{{ format_number($invoice->details->sum('total')) }}</h6></div>
            <div class="col-10"><h4 class="mt-footer text-right">Paid</h4></div>
            <div class="col-2"><h4 class="mt-footer text-right">{{ format_number($receipt->total) }}</h4></div>
{{--            <div class="col-10"><h6 class="mt-footer text-right">Insufficient Payment</h6></div>--}}
{{--            <div class="col-2"><h6 class="mt-footer text-right">{{ format_number($invoice->details->sum('total')-$receipt->total) }}</h6></div>--}}
        </div>
    </div>
    <div class="mx-default mt-5">
        <div class="row">
            <div class="col-4 text-center">
                Received by
                <br>
{{--                <img src="{{ asset('tanda_tangan.png') }}" alt="" class="img-fluid" style="height: 100px;">--}}
                <br>
                <br>
                <br>
                <br>
                ( Gerza Renandatta R. Dayana )
            </div>
        </div>
    </div>
@endsection
