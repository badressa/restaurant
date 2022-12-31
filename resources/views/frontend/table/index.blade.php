

@extends('yami.yami_master')
@section('yami')
	
	<!-- Start Table Reservation  -->
	
	<div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						table 
						{{-- <h2>Table {{ $id }}</h2> --}}
						{{-- <p>max capacite {{ $table->maxcapacite }}</p> --}}
					</div>
				</div>
			</div>
		
		</div>
	</div>
	
	<!-- End Contact -->
	
	<!-- Start Contact info -->
	{{-- <div class="contact-imfo-box">
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
	</div> --}}
	<!-- End Contact info -->
	{{-- <form action="{{ route('reservation.store') }}" method="POST">
		@csrf
		<div class="card-body">
			

			
				
				

				 <div class="col-md-4">
					<div class="form-group" style="position: relative">
						<label for="basicInput">table *</label>
						<input  type="text" id="table_search" name="table_search" type="text" class="form-control @error('table_id') is-invalid @enderror" id="basicInput" placeholder="chercher une table "  value="{{old('table_id')}}">
					
						<div class="searchinfo" style="min-height: 2em; width: 21.3em; background: aliceblue; position: absolute; top: 4em;">
							<ul id="tableSearchResult"></ul>
							<div class="clear"></div>
							<div id="tableDetail"></div>
						</div>
						@error('client_id')
							<div class="invalid-feedback">
								<i class="bx bx-radio-circle"></i>
								{{ $message }}
							</div> 
						@enderror
					</div>
				</div> 

				 <div class="col-md-4">
					<div class="form-group">
						<label for="basicInput">nombre de personne</label>
						<input  name='nbrpersonne' type="text" class="form-control @error('nbrpersonne') is-invalid @enderror" id="basicInput" placeholder="nbrpersonne"  value="{{old('nbrpersonne')}}">
						@error('nbrpersonne')
							<div class="invalid-feedback">
								<i class="bx bx-radio-circle"></i>
								{{ $message }}
							</div> 
						@enderror
					</div>
				</div> 

			</div>

			<div class="row">
				
				<div class="col-md-4">
					<div class="form-check form-switch pt-4">
						<input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked="">
						<label class="form-check-label" for="flexSwitchCheckChecked">verifiée</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-check form-switch pt-4">
						<input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked="">
						<label class="form-check-label" for="flexSwitchCheckChecked">payée</label>
					</div>
				</div>
			</div>
			<div>
			<button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
			</div>
		</div>
	</form> --}}
	
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
@endsection