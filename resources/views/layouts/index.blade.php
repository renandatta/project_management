<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title'){{ env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="_token" content="{{ csrf_token() }}">
{{--    <link rel="shortcut icon" type="image/png" href="{{ asset('lemon.png') }}">--}}

    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    @stack('plugins')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    @stack('styles')
</head>
<body>
<div class="main-wrapper" id="app">
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                Noble<span>UI</span>
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            @include('layouts._navbar')
        </div>
    </nav>
    <div class="page-wrapper">
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <i data-feather="menu"></i>
            </a>
        </nav>
        <div class="page-content">
            <div class="row">
                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">
                Copyright © {{ date('Y') }} <a href="https://renandatta.com" target="_blank">renandatta</a>. All rights reserved
            </p>
        </footer>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script>
    let init_form_element = () => {
        $(".select2").select2();
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $(".summernote").summernote({
            height: 300,
        });
        $('.dropify').dropify();
        $('.autonumeric').autoNumeric({
            mDec: '0',
            vMax:'9999999999999999999999999',
            vMin: '-99999999999999999'
        }).attr('data-a-sep','.').attr('data-a-dec',',');
        $('.autonumeric-decimal')
            .attr('data-a-sep','.').attr('data-a-dec',',')
            .autoNumeric({
                mDec: '2',
                vMax:'999'
            });
    }
    $("[data-hide]").on("click", function(){
        $(this).parent().hide();
    });
    let getFormData = ($form) => {
        let unindexed_array = $form.serializeArray();
        let indexed_array = {};
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }
    let displayErrors = (target_id, errors) => {
        let $target = $('#' + target_id);
        let $content = $('#' + target_id + '_content');
        $content.html('');
        $.each(errors, (i, value) => {
            $content.append('<li>'+ value +'</li>');
        });
        $target.show();
    }
</script>
@stack('scripts')

</body>
</html>
