
@extends('admin.layout.master')    
@section('main_content')
@php
$label_sales = '[';
$data_sales = '[';

if(isset($arr_products_sales) && is_array($arr_products_sales) && sizeof($arr_products_sales)>0)
{
	foreach($arr_products_sales as $key => $sales)
	{
		// array_push($label_sales, $sales['product_name']);
		if($key == 0){
			$label_sales .= "'".$sales['product_details']['product_name']."'";
			$data_sales .= "'".$sales['occurrences']."'";
		}
		else
		{
			$data_sales .= ",'".$sales['occurrences']."'";
			$label_sales .= ",'".$sales['product_details']['product_name']."'";
		}
	}
}

$label_sales .= ']';
$data_sales .= ']';



@endphp
<!-- Page header -->
@include('admin.layout.breadcrumb')  

<div class="content">
	<div class="panel panel-flat">
		@include('admin.layout._operation_status')
		<div class="row">
			
			<div class="col-sm-12">
				<canvas id="by_sale" class="chartjs-render-monitor" style="height: 550px"></canvas>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/Chart.bundle.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/utils.js"></script>
<script>
	window.onload = function() {
		var ctx      = document.getElementById('by_sale').getContext('2d');
		var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php echo $label_sales ?>,
        datasets: [{

            label: 'Most Viewed Products',
            data: <?php echo $data_sales; ?>,
            backgroundColor: [
                '#8D98B3',
                '#E5CF0D',
                '#97B552',
                '#95706D',
                '#DC69AA',
                '#DC69AA',
                '#AE98DA',
                '#2EC7C1',
                '#5AB1E4',
                '#FFC799'
            ],
            borderWidth: 1
            /*,
            #F830A1
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1*/
        }]
    },options: {
			responsive: true,
			title: {
				display: true,
				text: 'Most Viewd Products'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			}
		}
});
}
</script>
@endsection


