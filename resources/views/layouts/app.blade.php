<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <!-- <base href="../"> -->
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tasks">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <!-- Page Title  -->
    <title>Tasks</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('assets/css/dashlite.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> -->

    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="{{ asset('fonts/Nioicon.woff') }}"> -->
    <style>
        div.dataTables_wrapper div.dataTables_length select {
            margin: 10px;

        }

        .dataTables_filter {
            float: right;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 190px;
        }
    </style>
    <!-- Scripts -->
    @stack("styles")
	@yield("styles")
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('layouts.sidebar')
            <!-- sidebar @e -->

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('layouts.header')
                <!-- main header @e -->

                <!-- content @s -->
                @yield('content')
                <!-- content @e -->

                <!-- footer @s -->
                @include('layouts.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
		$(document).ready(function() {
			// $('[data-toggle="tooltip"]').tooltip();
			// $('[data-toggle="popover"]').popover();
			// $('.delete-record').on("click", function(e) {
			// 	e.preventDefault();
			// });
		});
	</script>
    @stack("scripts")

</body>

</html>