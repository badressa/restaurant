@dd(session()->get('resinfo'))
@extends('yami.yami_master')
@section('yami')
	
	
	<!-- Start header -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>A propos</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End header -->
	
	<!-- Start About -->
	<div class="about-section-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<img src="{{ asset('frontend/yami/images/about-img.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-lg-6 col-md-6 text-center">
					<div class="inner-column">
						<h1>bienvenue à <span>Marrest Restaurant</span></h1>
						<h4>Little Story</h4>
						
						<p> Les restaurants marocains à Marrakech sont très prisés par les visiteurs venus du monde entier pour goûter aux plaisirs de la cuisine marocaine. Considérée comme l’une des toutes meilleures gastronomies dans le monde depuis plusieurs années, la cuisine marocaine est irrésistible.

							Avec une grande diversité de plats et des produits du terroir de grande qualité, notamment les épices, les légumes ou l’huile d’olive, les restaurants marocains à Marrakech proposent une succulente et exquise cuisine traditionnelle ou revisitée. Les ingrédients savamment associés et dosés procurent un plaisir incomparable aux papilles et les plus exigeants seront définitivement séduits. Tanjia, pastilla aux fruits de mer, couscous aux 7 légumes, tajines, salades en tout genre… les saveurs explosent en bouche. On ne s’en lasse jamais. </p>
						
					</div>
				</div>
				{{-- <div class="col-md-12">
					<div class="inner-pt">
						<p>Sed tincidunt, neque at egestas imperdiet, nulla sapien blandit nunc, sit amet pulvinar orci nibh ut massa. Proin nec lectus sed nunc placerat semper. Duis hendrerit elit nec sapien porttitor, ut pretium ipsum feugiat. Aenean volutpat porta nisi in gravida. Curabitur pulvinar ligula sed facilisis bibendum. Nullam vitae nulla elit. </p>
						<p>Integer purus velit, eleifend eu magna volutpat, porttitor blandit lectus. Aenean risus odio, efficitur quis erat eget, mattis tristique arcu. Fusce in ante enim. Integer consectetur elit nec laoreet rutrum. Mauris porta turpis nec tellus accumsan pellentesque. Morbi non quam tempus, convallis urna in, cursus mauris. </p>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
	<!-- End About -->
	
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
@endsection
	
	
    