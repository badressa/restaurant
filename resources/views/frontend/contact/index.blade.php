@php 
$products = session()->get('product');
@endphp
@extends('yami.yami_master')
@section('yami')
	
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Contact</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
	
	<!-- Start Contact -->
	<div class="map-full"></div>
	<div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Contacter nous</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form action="{{ route('contact.message') }}" method="POST" >
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" placeholder="Svp enter votre nom"  value="{{old('name')}}">
						
									@error('name') 
										<div class="invalid-feedback">
											<i class="bx bx-radio-circle"></i>
											{{ $message }}
										</div> 
									@enderror
								</div>                                 
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="email"  id="email" class="form-control" name="email" placeholder="Svp enter votre email"  value="{{old('email')}}">
						
									@error('email') 
										<div class="invalid-feedback">
											<i class="bx bx-radio-circle"></i>
											{{ $message }}
										</div> 
									@enderror
									
								</div> 
							</div>
							
							<div class="col-md-12">
								<div class="form-group"> 
									<textarea class="form-control" name="message" id="message" placeholder="Ton Messagee" rows="4"  required value="{{old('heure_debut')}}"></textarea>
						
										@error('heure_debut') 
											<div class="invalid-feedback">
												<i class="bx bx-radio-circle"></i>
												{{ $message }}
											</div> 
										@enderror
									
								</div>
								<div class="submit-button text-center">
									<button class="btn btn-common" id="submit" type="submit">Send Message</button>
									
								</div>
							</div>
						</div>            
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact -->
	
	
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
@endsection
	