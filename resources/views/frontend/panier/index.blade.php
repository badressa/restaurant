@php
		$products = session()->get('product');
	
		function searchIds($array, $key = 'id', $value){
		$results = array();

		if (is_array($array)) {
			if (isset($array[$key]) && $array[$key] == $value) {
				$results[] = $array;
			}

			foreach ($array as $subarray) {
				$results = array_merge($results, searchIds($subarray, $key, $value));
			}
		}

		 return  $results;
		}   
		
@endphp
@extends('yami.yami_master')
@section('yami')

	<!-- Start All Pages -->
	
	<!-- End All Pages -->
	
	<!-- Start Contact -->
	
	<div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center pt-4">
						<h2>Panier</h2>
						<h6>commandes</h6>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					
						<div class="row special-list ">
								@foreach ($menu_recettes as $recette)
		
										{{-- <div class="gallery-single fix" style="padding: 1em;">
											<img src="{{ asset('frontend/yami/images/img-01.jpg') }}" class="img-fluid" alt="Image" style="max-width: 10em;border-radius: 1em;">
					
											<div class="wh-text p-4" style="float: right">
												<h4 style="
															color: #3f4870;
															margin-bottom: 0;
															font-size: 18px;
															font-family: Gilroy-Bold;
														">Special Drinks 1</h4>
								
												<div>
													<h5 style="
														color: #54596e;
														font-size: 18px;
														font-family: Gilroy-Bold;
													"> $7.79</h5>
					
												</div>
												
											</div>
										</div> --}}
									<div class="col-lg-4 col-md-6 special-grid drinks rounded">
										<div class="gallery-single fix">
											<img src="{{ asset('/images/recettes/'.$recette->photo) }}" class="img-fluid" alt="Image" style="max-width: 10em;max-height: 7em;border-radius: 1em;">

											<div class="wh-text p-4" style="float: right">
												<h4 style=" color: #3f4870;
															margin-bottom: 0;
															font-size: 18px;
															font-family: Gilroy-Bold;">
												        {{$recette->libelle}}
												</h4>
								
												<div>
													<h5 style="
														color: #54596e;
														font-size: 18px;
														font-family: Gilroy-Bold;">
														    {{$recette->prix_tcc}} Dhs
												</h5>
					
												</div>
												
											</div>
										</div>
										<div class="product">
											@if($productsIds = searchIds($products, 'id', $recette->id))
											   
											<div>
													<button value="{{$productsIds[0]['id']}}" class='substractOneToCard cardButton' > 
														-  
													</button>
													<span class='itemqte qte'>{{$productsIds[0]['qte']}}</span>
									
													<button value="{{$productsIds[0]['id']}}"  class='addOneToCard cardButton' >
														+  
													</button>
													<button value="{{$productsIds[0]['id']}}" class='cardButton deleteFromCard'  style='background-color:red;float:right;'>
														x  
													</button>
											</div>
											@else 
											<h5 style="color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;" class="price" data-price="{{$recette->receipts->prix_tcc}}" > {{$recette->receipts->prix_tcc}} Dhs </h5>
			
											<div style="float: right">
												<button  style="border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;">
																	<i class="fa fa-link"></i>
												</button>
												<button value="{{$recette->id}}"  class="addToCard" 
												style=" border-radius: 1em;background: aliceblue;width: 40px;height: 40px; cursor:pointer;">
													<i class="fa fa-shopping-cart"></i>
												</button>
											</div>
											@endif
			
										</div>
									</div>
								@endforeach
								
							</div>


							@if(!empty($menu_recettes[0]))
							<div class="row mt-4 p-2" style="justify-content: space-between;" >
								<h3 style="float: left;"  >
									Total Price: <span id="prix_tcc">{{$totalPrice}}</span> Dhs
								</h3>
								<div style="float: right;" >
									<button  class="btn-prim" ><a href="{{route('panier.addorder')}}">passer la commande</a></button>
								</div>
							</div>
							@endif
						</div>

						{{-- <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required data-error="Please enter your name">
									<div class="help-block with-errors"></div>
								</div>                                 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" placeholder="Your Email" id="email" class="form-control" name="name" required data-error="Please enter your email">
									<div class="help-block with-errors"></div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select class="custom-select d-block form-control" id="guest" required data-error="Please Select Person">
									  <option disabled selected>Please Select Person*</option>
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
									<div class="help-block with-errors"></div>
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group"> 
									<textarea class="form-control" id="message" placeholder="Your Message" rows="4" data-error="Write your message" required></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<div class="submit-button text-center">
									<button class="btn btn-common" id="submit" type="submit">Send Message</button>
									<div id="msgSubmit" class="h3 text-center hidden"></div> 
									<div class="clearfix"></div> 
								</div>
							</div>
						</div>            
					 --}}
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact -->
	
	<!-- Start Contact info -->
	<div class="contact-imfo-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<i class="fa fa-volume-control-phone"></i>
					<div class="overflow-hidden">
						<h4>Phone</h4>
						<p class="lead">
							+01 123-456-4590
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-envelope"></i>
					<div class="overflow-hidden">
						<h4>Email</h4>
						<p class="lead">
							yourmail@gmail.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker"></i>
					<div class="overflow-hidden">
						<h4>Location</h4>
						<p class="lead">
							800, Lorem Street, US
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact info -->
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>




@endsection