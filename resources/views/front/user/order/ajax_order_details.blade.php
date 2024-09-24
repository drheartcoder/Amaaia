<div class="cart-login dynamic_view">

					<div class="title-logins-accounts">
						Addresses
					</div>

					<div class="row">
						<div class="radio-sections-new">
							@if(isset($arr_addresses) && is_array($arr_addresses) && sizeof($arr_addresses)>0)
							@foreach($arr_addresses as $key=>$address)
							@php  @endphp

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="radio-btn">
									<input type="checkbox" id="{{$key.'add'}}-option" value="{{base64_encode($address['id'])}}" onchange="uncheck_others(this)" class="address-select" name="address" data-rule-required='true'>
									<label for="{{$key.'add'}}-option">
										<div class="title-checkboxs">{{$obj_user->first_name or ''}} {{$obj_user->last_name or ''}}</div>
										<div class="address-text">{{$address['flat_no'] or ''}}, {{$address['building_name'] or ''}}, {{$address['address'] or ''}}, {{$address['city'] or ''}}, {{$address['state'] or ''}}, {{$address['country'] or ''}}, {{$address['post_code'] or ''}}</div>
										<div class="edit-icon-blo" onclick="edit_address('{{base64_encode($address["id"])}}')"><a class="edit-addres" href="javascript:void(0)"></a> </div>
										<div class="closes-icon-blo"><a class="closes-addres" href="javascript:void(0)" onclick="delete_address('{{base64_encode($address["id"])}}')"></a> </div>
									</label>
									<div class="check"><div class="inside"></div></div>
								</div>
							</div>

							@endforeach
							@endif
							@if((isset($key) && $key <= 3) | !($arr_addresses))
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="wholsel-pro-block-bg address">
									<a class="plusbtns" href="javascript:void(0)" onclick="add_address()"></a>
								</div>
							</div>
							@endif
						</div>
					</div>
					<div class="box-form login-carts none-psace mobile-btns-shop pull-left">
						<div class="full-button">
							<button type="button" class="button-shop btn-span-two-prev">
								<span>Back</span>
							</button>
						</div>
					</div>

					<div class="box-form login-carts none-psace mobile-btns-shop">
						<div class="full-button">
							<button type="button" class="button-shop btn-span-two-next"><span>Proceed to payment</span></button>
						</div>
					</div>

				</div>