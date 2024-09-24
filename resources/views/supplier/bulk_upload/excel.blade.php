<table border="1">
	<thead>
		<th>
			<tr>
				<th> Category Name</th>
				<th> Subcategory Name</th>
				<th> Product Lines</th>
			</tr>
		</th>
	</thead>

	<tbody>
		@if(isset($category) && is_array($category) && sizeof($category)>0)
		@foreach($category as $key=>$arr_category)
		<tr>
			<td>
				{{$arr_category['category_name'] or ''}}
			</td>
			@if(isset($arr_category['sub_categories']) && is_array($arr_category['sub_categories']) && sizeof($arr_category['sub_categories'])>0)

			<td>
				<table border="1">
					@foreach($arr_category['sub_categories'] as $key1=>$subcategory)
					<tr>
						@if($key1==0)
						<tr></tr>
						@endif
						<td>
							{{$subcategory['subcategory_name']}}

						</td>
						@if(isset($subcategory['product_line']) && is_array($subcategory['product_line']) && sizeof($subcategory['product_line'])>0)
						<td>
							<table border="1">

								@foreach($subcategory['product_line'] as $key2 =>$product_line)
								<tr>
									@if($key2==0)
									<tr></tr>
									@endif
									<td>
										{{$product_line['product_line_name']}}
									</td>
								</tr>
								@endforeach
							</table>
						</td>
						@endif
					</tr>
					@endforeach
				</table>
			</td>
			@endif
		</tr>
		@endforeach
		@endif
	</tbody>
</table>