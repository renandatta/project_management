@extends('layouts.print')

@section('title')
    Invoice {{ $invoice->details[0]->item }}
@endsection

@push('styles')
    <style>
        @media print {
            body {-webkit-print-color-adjust: exact;}
        }
        #title {
            font-size: 52pt;
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
                        To :
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
    @php($no = 1)
    @foreach($invoice->details as $key => $detail)
        <div class="row mx-default">
            <div class="col-6">
                <div class="row mt-header">
                    <div class="col-1">
                        @if($detail->unit != '-')
                            <h6>{{ $no++ }}</h6>
                        @endif
                    </div>
                    <div class="col-11"><h6>{{ $detail->item }}</h6></div>
                </div>
            </div>
            @if($detail->unit != '-')
                <div class="col-2"><h6 class="mt-header text-right">{{ format_number($detail->qty). ' ' . $detail->unit }}</h6></div>
                <div class="col-2"><h6 class="mt-header text-right">{{ format_number($detail->price) }}</h6></div>
                <div class="col-2"><h6 class="mt-header text-right">{{ format_number($detail->total) }}</h6></div>
            @endif
        </div>
    @endforeach
{{--    <div class="row mx-default">--}}
{{--        <div class="col-6">--}}
{{--            <div class="row mt-header">--}}
{{--                <div class="col-1"></div>--}}
{{--                <div class="col-11"><h6>PPH 2%</h6></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-2"><h6 class="mt-header text-right"></h6></div>--}}
{{--        <div class="col-2"><h6 class="mt-header text-right"></h6></div>--}}
{{--        <div class="col-2"><h6 class="mt-header text-right"></h6></div>--}}
{{--    </div>--}}
{{--    @foreach($invoice->receipts as $key => $receipt)--}}
{{--        <div class="row mx-default">--}}
{{--            <div class="col-10">--}}
{{--                <div class="row mt-header">--}}
{{--                    <div class="col-1">--}}
{{--                        <h6>{{ $no++ }}</h6>--}}
{{--                    </div>--}}
{{--                    <div class="col-11"><h6>Pembayaran Termin 1</h6></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-2"><h6 class="mt-header text-right">-{{ format_number($receipt->total) }}</h6></div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
    <div class="w-100 bg-main mt-4">
        <div class="row row-footer mx-default">
            <div class="col-10"><h6 class="mt-footer text-right">TOTAL</h6></div>
            @php($total = $invoice->details->sum('total'))
            <div class="col-2"><h6 class="mt-footer text-right">{{ format_number($total) }}</h6></div>
        </div>
{{--        <div class="row row-footer mx-default">--}}
{{--            <div class="col-10"><h6 class="mt-footer text-right">Pembayaran Pertama (50%)</h6></div>--}}
{{--            @php($dp = $total / 2)--}}
{{--            <div class="col-2"><h6 class="mt-footer text-right">{{ format_number($dp) }}</h6></div>--}}
{{--        </div>--}}
{{--        <div class="row row-footer mx-default">--}}
{{--            <div class="col-10"><h6 class="mt-footer text-right">Pembayaran Pertama</h6></div>--}}
{{--            <div class="col-2"><h6 class="mt-footer text-right">-3.750.000</h6></div>--}}
{{--        </div>--}}
{{--        <div class="row row-footer mx-default">--}}
{{--            <div class="col-10"><h6 class="mt-footer text-right">Termin Pembayaran Kedua (50%)</h6></div>--}}
{{--            <div class="col-2"><h6 class="mt-footer text-right">{{ format_number($total - (0.5 * $total)) }}</h6></div>--}}
{{--            <div class="col-2"><h6 class="mt-footer text-right">3.750.000</h6></div>--}}
{{--        </div>--}}
    </div>
    <div class="mx-default mt-5">
        <div class="row">
            <div class="col-4">
                <h5>PAYMENT METHOD</h5><br>
                <table>
                    <tr>
                        <td>
                            BCA <br>
                            Gerza Renandatta R. Dayana<br>
                            018 277 3199
                        </td>
                        <td>&nbsp; &nbsp; &nbsp;</td>
                        <td>
                            BNI <br>
                            Gerza Renandatta R Dayana <br>
                            046 999 3120
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-3   "></div>
            <div class="col-5">
                <h5>TERMS & CONDITION</h5><br>
                1. Please send payment within 2 days of receiving this invoice <br>
                2. Software development start immediately after payment confirmed <br>
                3. Progress of software development will be sent every 3 days
            </div>
        </div>
    </div>

{{--    <div class="mx-default mt-5">--}}
{{--    <p>--}}
{{--        Kesepakatan dengan PT Pertamina Lubricants sebagai berikut: <br>--}}
{{--        1. Menyampaikan deliverables/output yang berupa web monitoring bank garansi. <br>--}}
{{--        2. Menyerahkan source code web monitoring bank garansi. <br>--}}
{{--        3. Menyelesaikan PEKERJAAN dalam waktu 10 (sepuluh) hari kerja sejak pembayaran termin pertama diterima. <br>--}}
{{--        4. Maksimal dalam 1x24 jam wajib menyelesaikan permasalahan/kendala/maintenance dari PEKERJAAN. <br>--}}
{{--        5. Memberikan jasa maintenance/operation web selama 6 (enam) bulan terhitung sejak pembayaran pertama. <br>--}}
{{--        6. Bertanggungjawab atas pendaftaran domain dan server yang berlangganan minimal selama 1 (satu) tahun. <br>--}}
{{--        7. Menerima penambahan fitur dashboard atau fitur lainnya yang belum tercantum dalam <br>--}}
{{--        lampiran sepanjang fitur tersebut sederhana <br>--}}
{{--    </p>--}}
{{--    </div>--}}

    <div class="mx-default mt-5">
        <div class="row">
            <div class="col-4 text-center">
                <img src="{{ asset('tanda_tangan.png') }}" alt="" class="img-fluid" style="height: 100px;">
                <br>
                ( Gerza Renandatta Rooziq Dayana ) <br>
{{--                NIK : 3517063004940001 <br>--}}
{{--                Alamat : Taman Puspa Sarirogo AA-3, Sidoarjo <br>--}}
{{--                NPWP : 93.056.256.6-603.000--}}
            </div>
        </div>
    </div>
@endsection
