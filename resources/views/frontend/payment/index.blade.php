@extends('yami.yami_master')
@section('yami')

	<!-- Start All Pages -->
	
	<!-- End All Pages -->
	
	<!-- Start Contact -->

	<div class="container py-5">
		<!-- For demo purpose -->
		<div class="row mb-4">
			<div class="col-lg-8 mx-auto text-center">
				<h1 class="display-6">Bootstrap Payment Forms</h1>
			</div>
		</div> 
		<!-- End -->
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card ">
					<div class="card-header">
						<div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
							<!-- Credit card form tabs -->
							<ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
								<li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fa fa-credit-card mr-2"></i> Credit Card </a> </li>
							</ul>
						</div> <!-- End -->
						<!-- Credit card form content -->
						<div class="tab-content">
							<!-- credit card info-->
							<div id="credit-card" class="tab-pane fade show active pt-3">
								<form action="{{ route('order.pay') }}" method="post" role="form">
									@csrf
								{{-- <form action="{{ route('order.pay') }}" role="form" onsubmit="event.preventDefault()"> --}}
									<div class="form-group"> 
										<label for="username">
											<h6>Card Owner</h6>
										</label> 
										<input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> 
									</div>
									<div class="form-group"> 
										<label for="cardNumber">
											<h6>Card number</h6>
										</label>
										<div class="input-group"> 
											<input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>

											<div class="input-group-append"> 
												<span class="input-group-text text-muted"> 
													<i class="fa fa-cc-visa mx-1"></i> <i class="fa fa-cc-mastercard mx-1"></i> <i class="fa fa-cc-amex mx-1"></i> 
												</span> 
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-8">
											<div class="form-group"> 
												<label>
													<span class="hidden-xs">
															<h6>Expiration Date</h6>
													</span>
												</label>
												<div class="input-group"> 
													<input name="m" type="number" placeholder="MM" class="form-control" required> 
											     	<input name="y" type="number" name="y" placeholder="YY" class="form-control" required>
											     </div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
													<h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
												</label> 
												    <input name="cvv" type="text" required class="form-control"> 
												</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group mb-4"> 
												<label data-toggle="tooltip" title="Three digit CV code on the back of your card">
													<h6>Price</h6>
												</label> 
												<input name="price" type="text"  required class="form-control" value="{{$totalPrice}} Dhs" readonly> </div>
										</div>
									</div>
				
									<div class="card-footer"> <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
								</form>
							</div>
						</div> <!-- End -->
					
						
						<!-- End -->
					</div>
				</div>
			</div>
		</div>
	
	</div>


</div>
	{{-- <div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center pt-4">
						<h2>Payement</h2>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
				
						<div class="row special-list ">
							<div class="col-lg-12 col-md-12 special-grid drinks rounded">
								<div class="gallery-single fix" style="padding: 1em;">
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
								</div>
							</div>
						</div>

				
				</div>
			</div>
		</div>
	</div> --}}
	<!-- End Contact -->	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

@endsection