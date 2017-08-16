<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
	<div class="wrapper">
		@include('layouts._header')
  		@include('layouts._sidebar')

		<div class="content-wrapper">
			<section class="content">
				@yield('content')
			</section>
  		</div>

		@include('layouts._footer')
		@include('layouts._right-sidebar')
	</div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
