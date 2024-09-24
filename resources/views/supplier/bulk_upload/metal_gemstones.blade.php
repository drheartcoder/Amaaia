<table>
	<thead>
		<tr>
			<th>
				Metal Type
			</th>
			<th>
				Metal Color
			</th>
			<th>
				Metal Quality
			</th>		

			<th>
				Gemstone Type
			</th>				
			<th>
				Gemstone Color
			</th>		
			<th>
				Gemstone Quality
			</th>
			<th>
				Gemstone Shape
			</th>			
		</tr>
	</thead>
	<tbody>
		@foreach($arr_metal as $key_metal=> $metal)
		<tr>
			<td>{{$metal['metal_name'] or ''}}</td>
			<td>{{$arr_metal_color[$key_metal]['metal_color'] or ''}}</td>
			<td>{{$arr_metal_quality[$key_metal]['quality_name'] or ''}}</td>

			{{-- <td>
				@if(isset($arr_metal_color) && is_array($arr_metal_color) && sizeof($arr_metal_color)>0)
				<table>
					@foreach($arr_metal as $key_metal=> $metal)
					@if($key_metal==0)<tr></tr>@endif
					<tr>
						<td>
							{{$metal['metal_name'] or ''}}
						</td>
					</tr>
					@endforeach
				</table>
				@endif
			</td>

			<td>
				@if(isset($arr_metal_color) && is_array($arr_metal_color) && sizeof($arr_metal_color)>0)
				<table>
					@foreach($arr_metal_color as $key_metal_color=> $metal_color)
					
					@if($key_metal_color==0)<tr></tr>@endif
					<tr>
						<td>
							{{$metal_color['metal_color'] or ''}}
						</td>
					</tr>
					@endforeach

				</table>
				@endif
			</td>

			<td>
				@if(isset($arr_metal_quality) && is_array($arr_metal_quality) && sizeof($arr_metal_quality)>0)
				<table>
					@foreach($arr_metal_quality as $key_metal_quality=> $metal_quality)
					
					@if($key_metal_quality==0)<tr></tr>@endif
					<tr>
						<td>
							{{$metal_quality['quality_name'] or ''}}
						</td>
					</tr>
					@endforeach

				</table>
				@endif
			</td> --}}

		</tr>
		@endforeach		
	</tbody>
</table>
