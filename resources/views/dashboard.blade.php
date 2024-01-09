@extends('layouts.app')
@section('content')
@push('styles')
	<style>
		.order-card {
			color: #fff;
		}

		.bg-c-blue {
			background: linear-gradient(45deg, #4099ff, #73b4ff);
		}

		.bg-c-blue:hover {
			background: linear-gradient(45deg, #5aa6fd, #5d93d0);
		}

		.bg-c-green {
			background: linear-gradient(45deg, #2ed8b6, #59e0c5);
		}

		.bg-c-green:hover {
			background: linear-gradient(45deg, #34dfbd, #63fadc);
		}

		.bg-c-yellow {
			background: linear-gradient(45deg, #FFB64D, #ffcb80);
		}

		.bg-c-yellow:hover {
			background: linear-gradient(45deg, #ffbe63, #e4b572);
		}

		.bg-c-pink {
			background: linear-gradient(45deg, #FF5370, #ff869a);
		}

		.bg-c-pink:hover {
			background: linear-gradient(45deg, #ed5e76, #d76679);
		}

		.bg-c-grey {
			background: linear-gradient(45deg, #838080, #c9b8bb);
		}

		.bg-c-grey:hover {
			background: linear-gradient(45deg, #5a5757, #998085);
		}

		.card {
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
			box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
			border: none;
			margin-bottom: 30px;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		.card .card-block {
			padding: 25px;
			padding-top: 50px;
			padding-bottom: 50px;
		}

		.order-card i {
			font-size: 26px;
		}

		.f-left {
			float: left;
		}

		.f-right {
			float: right;
		}

		.snip-table-hide {
			display: none;
		}

		.snippet-chart {
			width: 100%;
			max-width: 100%;
			display: block;
			box-sizing: border-box;
			padding: 10px;
			box-shadow: 0 0px 2px 0 rgb(0 0 0 / 16%), 0 2px 3px 0 rgb(0 0 0 / 12%) !important;
			background: #fff;
			border-radius: 7px;
		}

		.border-left-primary {
			border-left: 0.25rem solid #4e73df !important;
		}

		.border-left-secondary {
			border-left: 0.25rem solid #4e73df !important;
		}

		.rounded {
			border-radius: 20px !important;
		}

		.text-orange {
			color: #FF881C;
		}

		.text-green {
			color: #68E365;
		}

		.text-lblue {
			color: #4C91C4;
		}

		.text-yellow {
			color: #F0D800;
		}

		.text-purple {
			color: #8951FF;
		}

		.text-blue {
			color: #668EF4;
		}
	</style>
@endpush
<div>
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
