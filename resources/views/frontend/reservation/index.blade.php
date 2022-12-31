@extends('yami.yami_master')
@section('yami')
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Reservation</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
	
	<!-- Start Reservation -->
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Reservation</h2>				
					</div>
					@if (session()->has('errorr'))
						@foreach($errors as $error)
						  <li style="backround: red;">{{$error}}</li>
					    @endforeach
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="contact-block">

						<form action="{{ route('table.select') }}" method="POST" >
                            @csrf
							<div class="row">

								<div class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<h3 class="pl-0">Reserve une table</h3>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="basicInput">heure de debut</label>
												<input  name="heure_debut" min="{{$opent}}" max="{{$preventt}}" value="{{$opent}}" type="time" class="form-control @error('heure_debut') is-invalid @enderror" id="basicInput" placeholder="heure_debut"  value="{{old('heure_debut')}}">
						
											@error('heure_debut') 
												<div class="invalid-feedback">
													<i class="bx bx-radio-circle"></i>
													{{ $message }}
												</div> 
											@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="basicInput">heure de fin</label>
												<input  name="heure_fin" min="{{$opent}}" max="{{$closet}}" value="{{$closet}}" type="time" class="form-control @error('heure_fin') is-invalid @enderror" id="basicInput" placeholder="heure_fin"  value="{{old('heure_fin')}}">
						
											@error('heure_fin') 
												<div class="invalid-feedback">
													<i class="bx bx-radio-circle"></i>
													{{ $message }}
												</div> 
											@enderror
											</div>
										</div>
										{{-- <div class="col-md-12">
											<div class="form-group">
												<input id="input_date" class="datepicker picker__input form-control" name="date" type="text" value="" equired data-error="Please enter Date">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div> --}}
										<div class="col-md-12">
											<div class="form-group">
												<label for="basicInput">date de reservation</label>
												<input  name='date_reservation' type="date" min="{{ Date('Y-m-d')}}" value="{{Date('Y-m-d')}}" class="form-control @error('date_reservation') is-invalid @enderror" id="basicInput" placeholder="date_reservation"  value="{{old('date_reservation')}}">
												@error('date_reservation')
													<div class="invalid-feedback">
														<i class="bx bx-radio-circle"></i>
														{{ $message }}
													</div> 
												@enderror
											</div>
										</div>
										
										{{-- <div class="col-md-12">
											<div class="form-group">
												<input id="input_time" class="time form-control picker__input" required data-error="Please enter time">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div> --}}
										<div class="col-md-12">
											<div class="form-group">
												<label for="basicInput">nombre de personne</label>
												<input  name='nbrpersonne' type="number" class="form-control @error('nbrpersonne') is-invalid @enderror" id="basicInput" placeholder="nbrpersonne"  value="{{old('nbrpersonne')}}">
												@error('nbrpersonne')
													<div class="invalid-feedback">
														<i class="bx bx-radio-circle"></i>
														{{ $message }}
													</div> 
												@enderror
											</div>
										</div>
										
										{{-- <div class="col-md-12">
											<div class="form-group">
												<select class="custom-select d-block form-control" id="person" required data-error="Please select Person">
												<option disabled selected>Select Person*</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												</select>
												<div class="help-block with-errors"></div>
											</div> 
										</div> --}}
									</div>
								</div>

								<div class="col-md-6">
									<div class="row">

										<div class="col-md-12">
											 <h3 class=pl-0>Détails du contact</h3>
										</div>
										<div class="col-md-12">
											<div class="form-group" style="position: relative">
												<label for="basicInput">nom du client </label>
												
												<input name="client"  type="text" id="txt_search"  class="form-control @error('client') is-invalid @enderror" id="basicInput" placeholder="chercher un client"  value="{{old('client')}}">
					
												
												@error('client')
													<div class="invalid-feedback">
														<i class="bx bx-radio-circle"></i>
														{{ $message }}
													</div> 
												@enderror
											</div>
										</div>
										{{-- <div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required data-error="Please enter your name">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div> --}}
										<div class="col-md-12">
											<div class="form-group">
												<label for="basicInput">Email</label>
												<input type="text" id="email" name="email" required  type="text" id="txt_search"  class="form-control @error('email') is-invalid @enderror" id="basicInput" placeholder="chercher un client"  value="{{old('email')}}">
										
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
												<label for="basicInput">Tel</label>
												<input type="text" name="tel" required  placeholder="nombre de telephone" id="phone" required data-error="Please enter your email" type="text" id="txt_search"  class="form-control @error('tel') is-invalid @enderror" id="basicInput" placeholder="chercher un client"  value="{{old('tel')}}">
										
												@error('tel')
													<div class="invalid-feedback ">
														<i class="bx bx-radio-circle"></i>
														{{ $message }}
													</div> 
												@enderror
											</div>
									
										</div>
							           
									</div> 
							    </div>



								<div class="col-md-12">
									<div class="submit-button text-center">
										<button class="btn btn-common" id="submit" type="submit">Book Table</button>
										{{-- <div id="msgSubmit" class="h3 text-center hidden"></div>  --}}
										{{-- <div class="clearfix"></div>  --}}
									</div>
								</div>
								
							    
							</div>           
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Reservation -->

	
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

	


@endsection
