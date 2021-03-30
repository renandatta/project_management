@extends('layouts.print')

@section('title')
    Invoices -
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
                <h1 id="title">INVOICE</h1>
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
                        Invoice To :
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
            <div class="col-10"><h6 class="mt-footer text-right">TOTAL</h6></div>
            <div class="col-2"><h6 class="mt-footer text-right">{{ format_number($invoice->details->sum('total')) }}</h6></div>
        </div>
    </div>
    <div class="mx-default mt-5">
        <div class="row">
            <div class="col-4">
                <h5>PAYMENT METHOD</h5><br>
                BNI <br>
                Gerza Renandatta R. Dayana<br>
                046 999 3120
            </div>
            <div class="col-3   "></div>
            <div class="col-5">
                <h5>TERMS & CONDITION</h5><br>
                1. Please send payment within 3 days of receiving this invoice <br>
                2. Software development start immediately after payment confirmed <br>
                3. Progress of software development will be sent every 10 days
            </div>
        </div>
    </div>
@endsection
