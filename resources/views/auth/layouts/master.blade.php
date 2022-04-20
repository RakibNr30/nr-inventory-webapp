<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ $global_site->favicon->file_url ?? config('core.image.' . config('core.theme') . '.default.favicon') }}">
    {{--{!! SEO::generate(true) !!}--}}

    <link rel="icon" href="{{ $global_site->favicon->file_url ?? config('core.image.' . config('core.theme') . '.default.favicon') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('common/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('common/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('common/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('style')
</head>
<body class="hold-transition login-page">
    {{--<div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1" href="{{ url('/') }}"><b>{{ $global_site->title ?? '' }}</b></a>
            </div>
            @yield('content')
        </div>
    </div>--}}

    @yield('content')

<script src="//cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write(`<script src="{{ asset('common/plugins/jquery-3.3.1/jquery-3.3.1.min.js') }}"><\/script>`)</script>
<!-- Select2 -->
<script src="{{ asset('common/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('common/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('common/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/app.min.js') }}"></script>
<script>
    $('.select2').select2().on('change', function() {
        //$(this).valid();
    });
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@yield('script')
</body>
</html>
