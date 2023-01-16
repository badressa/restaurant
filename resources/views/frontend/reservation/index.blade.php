@extends('yami.yami_master')
@section('yami')
	<!-- Start Reservation -->

	
	
	
	<!-- Start Reservation -->
	<div class="reservation-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Reservation</h2>				
					</div>
					
					{{-- @if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif --}}
					{{-- @if (isset($timingerror))
						<div class="alert alert-danger">
							<ul>
								@foreach ($timingerror as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif --}}
					@if (session()->has('timingerror'))
						<div class="alert alert-danger">
							<ul>
								
									<li>{{ session('timingerror')}}</li>
						
							</ul>
						</div>
					@endif
					
				    
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="g-errors">

					</div>
					<div class="contact-block">

						<form action="{{ route('yami.reservation.store') }}" id="regForm"  class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PK') }}" method="POST" >
                            @csrf
							<div class="row">
							
								<div class="col-12">
									
									<!-- One "tab" for each step in the form: -->
									<div class="tab">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-12">
													<h3 class="pl-0">Reserve une table</h3>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="basicInput">heure de debut</label>
														<input    name="heure_debut" id='heure_debut' min="{{$opent}}" max="{{$preventt}}" value="{{$opent}}" type="time" class="form-control @error('heure_debut') is-invalid @enderror"  placeholder="heure_debut" >
								
														
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
														<input    name="heure_fin" id='heure_fin' min="{{$opent}}" max="{{$closet}}" value="{{$closet}}" type="time" class="form-control @error('heure_fin') is-invalid @enderror"  placeholder="heure_fin" >
								
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
														<input    name='date_reservation' id='date_reservation' type="date" min="{{ Date('Y-m-d')}}" value="{{Date('Y-m-d')}}" class="form-control @error('date_reservation') is-invalid @enderror"  placeholder="date_reservation"  >
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
														<input    name='nbrpersonne' id='nbrpersonne' type="number" class="form-control @error('nbrpersonne') is-invalid @enderror"  placeholder="nbrpersonne"  value="{{old('nbrpersonne')}}">
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
														<label for="client">nom du client </label>
														
														<input  {!! (!auth()->check())?'name="client"  required ':'' !!} id="client"  type="text"  class="form-control @error('client') is-invalid @enderror" placeholder="chercher un client"   {!! auth()->check()?'disabled':'' !!} value="{{(auth()->check())?auth()->user()->name:old('name')}}">
														
														
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
														<input   type="text" id="email" {!! (!auth()->check())?'name="email"  required':'' !!} id="email"  type="email"  class="form-control @error('email') is-invalid @enderror" placeholder="chercher un client"  {!! auth()->check()?'disabled':'' !!} value="{{(auth()->check())?auth()->user()->email:old('email')}}">
												
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
														<input   type="text" {!! (!auth()->check())?'name="tel" required  ':'' !!} id="tel"   placeholder="nombre de telephone"  required data-error="Please enter your tel" type="text"  class="form-control @error('tel') is-invalid @enderror" id="basicInput" placeholder="chercher un client"  {!! auth()->check()?'disabled':'' !!} value="{{(auth()->check())?auth()->user()->tel:old('tel')}}">
												
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
		
									</div>
				
									<!-- tables tab-->
									<div class="tab">
											@include('frontend.table.layout')

									</div>
								
									<!-- payement tab -->
									<div class="tab">
										<div>
											@include('components.payement.stripe',['totalPrice'=>50])
										</div>
									</div>

									<div class="col-md-12">
										<div style="overflow:auto;">
										<div style="float:right;">
											
												{{-- <div class="submit-button text-center">
													<button class="btn btn-common" id="submit" type="button" onclick="show(event)">Book Table</button>
													<div id="msgSubmit" class="h3 text-center hidden"></div>  
													 <div class="clearfix"></div>  
												</div> --}}
											
											<button type="button " id="prevBtn" onclick="nextPrev(-1, event)">precedent</button>
											<button type="button"  class="btn-common" id="nextBtn" onclick="nextPrev(1, event)">suivant</button>
										</div>
										</div>
									</div>
									<!-- Circles which indicates the steps of the form: -->
									<div style="text-align:center;margin-top:40px;">
									  <span class="step"></span>
									  <span class="step"></span>
									  <span class="step"></span>
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
	
	
	<style>
	/* * {
	  box-sizing: border-box;
	}
	body {
	  background-color: #f1f1f1;
	} */
	/* #regForm {
	  background-color: #ffffff;
	  font-family: Raleway;
	  padding: 40px;
	  min-width: 300px;
	} */
	/* h1 {
	  text-align: center;  
	} */
	/* input {
	  padding: 10px;
	  width: 100%;
	  font-size: 17px;
	  font-family: Raleway;
	  border: 1px solid #aaaaaa;
	} */
	/* Mark input boxes that gets an error on validation: */
	input.invalid {
	  background-color: #ffdddd;
	}
	/* Hide all steps by default: */
	.tab {
	  display: none;
	}
	button {
	  background-color: #04AA6D;
	  color: #ffffff;
	  border: none;
	  padding: 10px 20px;
	  font-size: 17px;
	  font-family: Raleway;
	  cursor: pointer;
	}
	button:hover {
	  opacity: 0.8;
	}
	#prevBtn {
	  background-color: #bbbbbb;
	}
	/* Make circles that indicate the steps of the form: */
	.step {
	  height: 15px;
	  width: 15px;
	  margin: 0 2px;
	  background-color: #bbbbbb;
	  border: none;  
	  border-radius: 50%;
	  display: inline-block;
	  opacity: 0.5;
	}
	.step.active {
	  opacity: 1;
	}
	/* Mark the steps that are finished and valid: */
	.step.finish {
	  background-color: #04AA6D;
	}
	</style>
	

	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

	

	@section('table-stuff')
	<script>

			//$(document).ready(function(){
	
	// $(form).on('submit', function(event){
	// event.preventDefault();
	// var url = $(this).attr('data-action');
	// var data = { heure_debut: ('#heure_debut').value, email: ('#email').value, heure_fin: ('#heure_fin').value, date_reservation: ('#date_reservation').value, nbrpersonne: ('#nbrpersonne').val(), client: ('#client').val(), tel: ('#tel').val() ,_token: '{{csrf_token()}}' };
	
	// axios.post(url, data)
	// .then(function (response) {
	// 	console.log(response);
	// })
	// .catch(function (error) {
	// 	console.log(error);
	// });
	// }

			// $(form).on('submit', function(event){
	// event.preventDefault();
	// var url = '{{ route('table.select') }}';
	// var data = { heure_debut: ('#heure_debut').val(), email: ('#email').val(), heure_fin: ('#heure_fin').val(), date_reservation: ('#date_reservation').val(), nbrpersonne: ('#nbrpersonne').val(), client: ('#client').val(), tel: ('#tel').val() ,_token: '{{csrf_token()}}' };
	// console.log('han data', data ,'han url', url);
	// var xhttp = new XMLHttpRequest();
	// xhttp.open("POST",'{{ route('table.select')}}', true); 
	// //xhttp.setRequestHeader("Content-Type", "application/json");
	// xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
	// xhttp.onreadystatechange = function() {
	// if (this.readyState == 4 && this.status == 200) {
	// 	// Response
	// 	var response = this.responseText;
	// 	console.log('form1',response);
	// }
	// };
	// xhttp.send(JSON.stringify(data));


	
			//});




	// $(form).on('submit', function(event){
	// 	event.preventDefault();

	// 	var url = $(this).attr('data-action');
	// 	console.log(FormData(this));
	// 	$.ajaxSetup({
	// 	headers: {
	// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 	}
	// 	});
	// 	$.ajax({
		
	// 		url: url,
	// 		method: 'POST',
	// 		data: { heure_debut: ('#heure_debut').val(), email: ('#email').val(), heure_fin: ('#heure_fin').val(), date_reservation: ('#date_reservation').val(), nbrpersonne: ('#nbrpersonne').val(), client: ('#client').val(), tel_token: '{{csrf_token()}}' } ,
	// 		dataType: 'JSON',
	// 		contentType: false,
	// 		cache: false,
	// 		processData: false,
	// 		success:function(response)
	// 		{
	// 			$(form).trigger("reset");
	// 			alert(response.success)
	// 		},
	// 		error: function(response) {
	// 			alert(response)
	// 		}
	// 	});
	// });

	//});

	function pushTableId(id,callback){
	event.preventDefault();
	var table_id = '';
	inputs = document.getElementsByName('table_id');
	inputs.forEach(el => { if(el.checked == true) table_id=el.value})

	console.log('tabid',table_id);
	var valid = true;
	var response;
	var url = '{{ route('table.select.id') }}';
	var data = { 
		table_id: table_id ,
		_token: '{{csrf_token()}}' 
	};
	
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST",'{{ route('table.select.id')}}', false); 
	xhttp.setRequestHeader("Content-Type", "application/json");
	xhttp.setRequestHeader("Accept", "application/json");
	//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		// Response
		response = JSON.parse(this.responseText);
		var items='';
		if(response.length != 0){
			let reskeys=Object.keys(response);
			if(reskeys.includes('errors')){		
					errors = response.errors;		
					Object.keys(errors).forEach(el=> errors[el].forEach(element =>
					items +=`<li> 
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										${Array.isArray(element)?element.join('</br>'):element}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</li> ` 
					));
					valid = false;
				}
				
			
				
				if(reskeys.includes('success')){
					let success = response.success;
					items += `  <li>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
											${success}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</li>`;
					valid = true;
					precreservations = response.reservations;
				}
				html = `<ul>${items}</ul>`
				document.getElementsByClassName('g-errors')[0].innerHTML = html; 
		}else{
			valid = false;
			items +=`<li> 
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										probleme dans la requete htttp
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</li> ` ;
			html = `<ul>${items}</ul>`
			document.getElementsByClassName('g-errors')[0].innerHTML = html; 
			console.log('tabiderror',response);
		}
		
		
		//console.log('form1',response[0]);
		if(callback) callback(response);
	}
	};
	xhttp.send(JSON.stringify(data));
	return  valid;
	}




	var precreservations = new Array();
	function showTables(event, callback){
	event.preventDefault();
	var valid = true;
	var response;
	var url = '{{ route('table.select') }}';
	var data = { 
		heure_debut: document.getElementById('heure_debut').value,
		email: document.getElementById('email').value, 
		heure_fin: document.getElementById('heure_fin').value,
		date_reservation: document.getElementById('date_reservation').value,
		nbrpersonne: document.getElementById('nbrpersonne').value,
		client: document.getElementById('client').value,
		tel: document.getElementById('tel').value ,
		_token: '{{csrf_token()}}' 
	};
	console.log('han data', data ,'han url', url);
	
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST",'{{ route('table.select')}}', false); 

	xhttp.setRequestHeader("Content-Type", "application/json");
	xhttp.setRequestHeader("Accept", "application/json");
	//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

	xhttp.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {

		response = JSON.parse(this.responseText);
		var items ='';
		if(response.length != 0){
				console.log('responsei', response);
				
				let reskeys=Object.keys(response);
		

				if(reskeys.includes('errors')){		
					errors = response.errors;		
					Object.keys(errors).forEach(el=> errors[el].forEach(element =>
					items +=`<li> 
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										${Array.isArray(element)?element.join('</br>'):element}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</li> ` 
					));
					valid = false;
				}
				
			
				
				if(reskeys.includes('success')){
					let success = response.success;
					items += `  <li>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
											${success}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</li>`;
					valid = true;
					precreservations = response.reservations;
				}
				html = `<ul>${items}</ul>`
				document.getElementsByClassName('g-errors')[0].innerHTML = html; 
			}

		}else{
			valid = false;
			items +=`<li> 
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
										probleme dans la requete http
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</li> ` ;
			html = `<ul>${items}</ul>`
			document.getElementsByClassName('g-errors')[0].innerHTML = html; 

		}

	
			
				
		
		if(callback) callback(response);
	};
	xhttp.send(JSON.stringify(data));
	
	return  valid;
	}
	function fitTables(){

	$items = document.getElementsByClassName('item');
	// nbrpersonne = document.getElementById('nbrpersonne').value;
	// $items.each(function(i, el) {
	// 				var $input = $(el);
	// 				if(element.getAttribute('data-nbrcapacite') <  nbrpersonne ){
	// 					element.style.backgroundColor = "#0c7c5d";
	// 					e.preventDefault();
	// 				}
	// 			});
	var nbrperonnes = eval(document.getElementById('nbrpersonne').value);
	for(var i=0; i<$items.length; i++){
		if($items[i].hasAttribute('data-nbrcapacite')){
			
			if(eval($items[i].getAttribute('data-nbrcapacite')) <nbrperonnes){ 
				$items[i].style.backgroundColor="yellow";
				if($items[i].childNodes[1].childNodes[3]){
					var $table = $items[i].childNodes[3].lastElementChild
					var containSuccess = $table.classList.contains('bg-success');
					var containDanger = $table.classList.contains('bg-danger');
					if(!containSuccess && !containDanger){
						containWt = $table.classList.contains('text-white');

						if(!containWt) $table.classList += ' text-white';
						$table.textContent = 'chaises insuffisantes';
						$items[i].childNodes[1].childNodes[3].style.display ='none';
					}
					
				}	
			}else{
				$items[i].style.backgroundColor="inherit";
				if($items[i].childNodes[1].childNodes[3]){
					var containSuccess = $items[i].childNodes[3].lastElementChild.classList.contains('bg-success');
					var containDanger = $items[i].childNodes[3].lastElementChild.classList.contains('bg-danger');
					if(!containSuccess && !containDanger) $items[i].childNodes[1].childNodes[3].style.display ='initial';
				}
			}
		}
	}
	function setDate(date,time) {
		var result = new Date(date+' '+time);
		if(time=='00' || time=='00:00' || time=='00:00:00') result.setDate(result.getDate() +1);
		return result;
	}
	heure_debut = document.getElementById('heure_debut').value;
	heure_fin = document.getElementById('heure_fin').value;
	date_reservation = document.getElementById('date_reservation').value;
	resdeb = setDate(date_reservation,heure_debut);
	resfin = setDate(date_reservation,heure_fin);
	
	if(precreservations){
		precreservations.forEach(res=>{

			for(var i=0; i<$items.length; i++){
				if($items[i].hasAttribute('data-nbrcapacite')){
					if($items[i].getAttribute('data-nbrcapacite') ){ 
						if($items[i].childNodes[1].childNodes[3]){
							if($items[i].childNodes[1].childNodes[3].value == res.table_id){
								
								resprecdeb = setDate(res.date_reservation,res.heure_debut);
								resprecfin = setDate(res.date_reservation,res.heure_fin);

								
								if((resdeb.getTime() >= resprecdeb.getTime() && resdeb.getTime() <= resprecfin.getTime()) || 
									(resfin.getTime()>=resprecdeb.getTime() && resfin.getTime()<=resprecfin.getTime()) ||
									(resdeb.getTime() <= resprecdeb.getTime() && resfin.getTime()>=resprecfin.getTime())
									){
									$items[i].childNodes[3].lastElementChild.classList = $items[i].childNodes[3].lastElementChild.classList[0];
									$items[i].childNodes[3].lastElementChild.classList += ' bg-success text-white';
									$items[i].childNodes[3].lastElementChild.textContent = 'reservée';
									$items[i].childNodes[1].childNodes[3].style.display = 'none';

								}else{
									if($items[i].childNodes[3].firstElementChild.classList.contains('border-danger')){
										$items[i].childNodes[3].lastElementChild.classList = $items[i].childNodes[3].lastElementChild.classList[0];
										$items[i].childNodes[3].lastElementChild.classList += ' bg-danger text-white';
										$items[i].childNodes[3].lastElementChild.textContent = 'Non active';
										$items[i].childNodes[1].childNodes[3].style.display = 'none';
									}

									// console.log(resprecdeb,resprecfin,resdeb,resfin);
									// console.log('resprecdeb,resprecfin,resdeb,resfin non act:'+i,resprecdeb.getTime(),resprecfin.getTime(),resdeb.getTime(),resfin.getTime());
									
								}
							};
						}	
			}
		}
	}
		})
	}

	}
	var currentTab = 0;  // Current tab is set to be the first tab (0)

	showTab(currentTab); // Display the current tab
	function showTab(n) {
	
	let display ="block";	
	// This function will display the specified tab of the form...
	var x = document.getElementsByClassName("tab");

	if(currentTab == 0){
	display = "flex";
	}
	x[n].style.display = display;
	if(n==1) {
	fitTables();
	}
	//... and fix the Previous/Next buttons:

	if (n == 0 ) {
	document.getElementById("prevBtn").style.display = "none";
	} else {
	document.getElementById("prevBtn").style.display = "inline";
	}
	if (n == (x.length - 1)) {
	//document.getElementById("nextBtn").style.display = "none";
	document.getElementById("nextBtn").style.display= "none";
	} else {
	document.getElementById("nextBtn").innerHTML = "Suivant";
	document.getElementById("nextBtn").style.display= "inline";
	}
	//... and run a function that will display the correct step indicator:
	fixStepIndicator(n)
	}
	function nextPrev(n,event) {
	event.preventDefault();
	console.log('n amzzwaru',currentTab);
	// This function will figure out which tab to display
	var x = document.getElementsByClassName("tab");
	// Exit the function if any field in the current tab is invalid:
	if (n == 1 && !validateForm()) return false;
	// Hide the current tab:

	x[currentTab].style.display = "none";
	// Increase or decrease the current tab by 1:
	currentTab = currentTab + n;
	// if you have reached the end of the form...
	console.log('xln',x.length,'current',currentTab)
	if (currentTab >= x.length) {
	// ... the form gets submitted:

	// document.getElementById("regForm").submit();
	alert('form submitted');
	//return false;
	}
	// Otherwise, display the correct tab:
	showTab(currentTab);
	}
	function validateForm() {
	// This function deals with validation of the form fields
	var x, y, i, valid = true;
	x = document.getElementsByClassName("tab");
	y = x[currentTab].getElementsByTagName("input");
	// A loop that checks every input field in the current tab:
	for (i = 0; i < y.length; i++) {
	// If a field is empty...
	if (y[i].value == "") {
	// add an "invalid" class to the field:
	y[i].className += " invalid";
	// and set the current valid status to false
	valid = false;
	}
	}
	if(valid ===  true){
	if(currentTab == 0){
		reservation_info=showTables(event);
		valid = reservation_info;
		console.log('reservation_info',reservation_info)
		
	}
	if(currentTab ==  1){
		reservation_info=pushTableId(event);
		valid = reservation_info;
		console.log('reservation_info',reservation_info)
		
	}
	}
	// If the valid status is true, mark the step as finished and valid:
	if (valid) {
	document.getElementsByClassName("step")[currentTab].className += " finish";
	}
	return valid; // return the valid status
	}
	function fixStepIndicator(n) {
	// This function removes the "active" class of all steps...
	var i, x = document.getElementsByClassName("step");
	for (i = 0; i < x.length; i++) {
	x[i].className = x[i].className.replace(" active", "");
	}
	//... and adds the "active" class on the current step:
	x[n].className += " active";
	}
	('.alert').alert();
	</script>
	@endsection
	@section('payment-js')
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

 

