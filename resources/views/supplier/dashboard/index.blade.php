@extends('supplier.layout.master')    
@section('main_content')
 <!-- Page header -->
          
@include('supplier.layout.breadcrumb')

<style type="text/css">
.temp_text
{
	text-align: center;
	font-size: 75px!important;
	padding-top: 150px!important;
	color: #b4a3a2;
}
</style>

<!-- /page header -->
<!-- BEGIN Main Content -->

	<!-- Content area -->
	<div class="content">


		<!-- Dashboard content -->
		<div class="row">
			<div class="col-lg-12">

				<!-- Quick stats boxes -->
				<div class="row">

					<div class="col-lg-3">

						<a href="{{ url('/supplier/product/jewellery') }}">
							<div class="panel bg-blue-600">
								<div class="panel-body">
									<div class="heading-elements">
										<span class="badge bg-teal-800"></span>
									</div>

									<h2 class="no-margin">{{ isset($products_count) ? $products_count : '0' }}</h2>
									<h1 class="no-margin">Products</h1>
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>
						</a>

					</div>

					<div class="col-lg-3">

						<a href="{{ url('/supplier/orders/new') }}">
							<div class="panel bg-pink-600">
								<div class="panel-body">
									<div class="heading-elements">
										<span class="badge bg-teal-800"></span>
									</div>

									<h2 class="no-margin">{{ isset($orders_count) ? $orders_count : '0' }}</h2>
									<h1 class="no-margin">My Orders</h1>
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>
						</a>

					</div>

					<div class="col-lg-3">

						<a href="{{ url('/supplier/notifications') }}">
							<div class="panel bg-indigo-600">
								<div class="panel-body">
									<div class="heading-elements">
										<span class="badge bg-teal-800"></span>
									</div>

									<h2 class="no-margin">{{ isset($notifications_count) ? $notifications_count : '0' }}</h2>
									<h1 class="no-margin">Notification</h1>
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>
						</a>

					</div>

					<?php
					$total_amount = 0;
					if(isset($arr_orders) && !empty($arr_orders))
					{
						foreach($arr_orders as $orders)
						{
							$amt = isset($orders['order_products']['0']['total_amount']) ? $orders['order_products']['0']['total_amount'] : 0;
							$total_amount = $total_amount + $amt;
						}
					}
					?>

					<div class="col-lg-3">

						<a href="{{ url('/supplier/earnings') }}">
							<div class="panel bg-teal-400">
								<div class="panel-body">
									<div class="heading-elements">
										<span class="badge bg-teal-800"></span>
									</div>

									<h2 class="no-margin"><i class='fa fa-inr'></i> {{ $total_amount }}</h2>
									<h1 class="no-margin">My Earnings</h1>
								</div>

								<div class="container-fluid">
									<div id="members-online"></div>
								</div>
							</div>
						</a>

					</div>

				</div>
				<!-- /quick stats boxes -->

			</div>

		</div>
		<!-- /dashboard content -->


	</div>

@endsection


			