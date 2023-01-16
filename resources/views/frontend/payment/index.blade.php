@extends('yami.yami_master')
@section('yami')

	<!-- Start All Pages -->
	
	<!-- End All Pages -->
	<div class="g-errors">

	</div>
	<!-- Start Contact -->
	<form action="{{ route('order.pay') }}" id="regForm"  class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PK') }}" method="POST">
		@csrf
		@include('components.payement.stripe',['totalPrice'=>$totalPrice])
	</form>


	{{-- <div class="container py-5">
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
								{{-- <form action="{{ route('order.pay') }}" role="form" onsubmit="event.preventDefault()"> 
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
	@section('payment-js')
	{{-- <script type="https://js.stripe.com/v3"></script>
	<script>
		const stripe = Stripe({{ env('STRIPE_SK') }});
		const elements = stripe.elements();
		cons cardElements = elements.create('card',{
			classes: {
				base: 'Stripe Element bg-white w-1/2 p-2 my-2 rounded-lg'
			}
		});

		cardElements.mount('#card-element');

		const cardButton = document.getElementById('subscribe');

		cardButton.addEventListener('click', async(e)=>{
			e.preventDefault();
			
			const {payementMethod, error} = await stripe.createPayementMethod('card', cardElement);

			if(error){
				alert(error)
			}else{
				document.getElementById('payment_method').value = payementMethod.id;
			}

			//document.getElementById('form').submit();
		})

	</script> --}}
	
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
	function checkPayement(token,callback){
		event.preventDefault();
		amount = $('.amount').val().split(' ')[0];
		username = $('.username').val();
		var token = token;

		console.log('token', token );

		var valid = true;
		var response;
		var url = '{{ route('table.select.id') }}';
		var data = { 
			_token: '{{csrf_token()}}',
			'stripeToken': token,
			'amount': amount,
		};
		try {
			stripe.handleCardPayment(
				clientSecret, cardElement
			).then(function(result) {
				if (result.error) {
				// Display error.message in your UI.
				console.log(error);
				} else {
				// The payment has succeeded. Display a success message.
				}
			});
		}
		catch(error) {
		console.log(error.message);
		}
		
		var xhttp = new XMLHttpRequest();

		xhttp.open("POST",'{{ route('stripe.pay')}}', false); 
		xhttp.setRequestHeader("Content-Type", "application/json");
		xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// Response
			response = JSON.parse(this.responseText);
			var items ='';
			if(response.length != 0){
				
				valid = true;
			}
			console.log(response);

			if(callback) callback(response);
		}else{
			console.log('error', response)
		}
		};
		xhttp.send(JSON.stringify(data));
		return  valid;
	}

	//Stripe(publishableKey,options?)
	$(function() {
		var $form = $(".require-validation");
		$('form.require-validation').bind('submit', function(e) {
			var $form = $(".require-validation");
			inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', ');
			$inputs = $form.find('.required').find(inputSelector);
			$errorMessage = $form.find('g-errors');
			valid = true;
			console.log('number' + $('.card-number').val(),
						'cvc' + $('.card-cvc').val(),
						'exp_month' + $('.card-expiry-month').val(),
						'exp_year' + $('.card-expiry-year').val(),)
			$errorMessage.addClass('hide');
			$('.has-error').removeClass('has-error');
			$inputs.each(function(i, el) {
				var $input = $(el);
				if ($input.val() === '') {
					$input.parent().addClass('has-error');
					$errorMessage.removeClass('hide');
					e.preventDefault();
				}
			});
			if (!$form.data('cc-on-file')) {
			e.preventDefault();
			var stripe = Stripe($form.data('stripe-publishable-key'));	
			Stripe.setPublishableKey($form.data('stripe-publishable-key'));
			Stripe.createToken({
				number: $('.card-number').val(),
				cvc: $('.card-cvc').val(),
				exp_month: $('.card-expiry-month').val(),
				exp_year: $('.card-expiry-year').val()
			}, stripeResponseHandler);
			}
		});
		

		function stripeResponseHandler(status, response) {
			if(response.error) {
				var items=' ';
				items +=`<li> 
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										${response.error.message}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</li> ` ;
				html = `<ul>${items}</ul>`
				document.getElementsByClassName('g-errors')[0].innerHTML = html; 

				// $('.error-r')
				// .removeClass('hide')
				// // .find('.alert')
				// .text(response.error.message);
				console.log(response.error.message);
			}else {
			/* token contains id, last4, and card type */
			var token = response['id'];
			var checkP = checkPayement(token);
			if(checkP){
			$form.get(0).submit();
			}
			
			}
		}
	});

	
	</script>
@endsection

@endsection