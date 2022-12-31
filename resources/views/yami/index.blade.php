@php
		$products = session()->get('product');
		$recipeIng = session()->get('recipeingredients');
		function getUserIpAddr(){ if(!empty($_SERVER['HTTP_CLIENT_IP'])){ $ip = $_SERVER['HTTP_CLIENT_IP']; }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }else{ $ip = $_SERVER['REMOTE_ADDR']; } return $ip; };
		$ip = getUserIpAddr();
		
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

	<!-- Start slides -->
	
	<div id="slides" class="cover-slides">
		<ul class="slides-container">
			<x-slider url="{{ asset('frontend/yami/images/slider-01.jpg') }}" />
			<x-slider url="{{ asset('frontend/yami/images/slider-02.jpg') }}" />
			<x-slider url="{{ asset('frontend/yami/images/slider-03.jpg') }}" />	
		</ul>
		<div class="slides-navigation">
			<a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
		</div>
	</div>
	<!-- End slides -->
	
	<!-- Start About -->
	<div class="about-section-box">
		
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<img src="{{ asset('frontend/yami/images/about-img.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 text-center">
					<div class="inner-column">
						
						<h1>Bienvenue au restaurant  <br> MarRest  </h1>
						<p>MarRest est un restaurant se situe à Errahidia ,présente la cuisine marocaine modestement. Cible à tous les gens et ages.</p>
						<a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End About -->
	
	<!-- Start QT -->
	<div class="qt-box qt-background">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto text-left">
					<p class="lead" style="color: #951414;background: #f0f8ff73;">
						" La cuisine marocaine se caractérise par une très grande diversité des plats "
					</p>
					<span class="lead"></span>
				</div>
			</div>
		</div>
	</div>
	<!-- End QT -->
	
	<!-- Start Menu -->
	<div class="menu-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>les plus demandés</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="special-menu text-center">
						<div class="button-group filter-button-group">
							<button class="active" data-filter="*">Tous</button>
							<button data-filter=".drinks">Boissons</button>
							<button data-filter=".lunch">Déjeuner</button>
							<button data-filter=".dinner">Dîner</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row special-list ">
				
				@foreach ($a_mosts_consumed as $recette )
				    @include('components.recipe',['recette',$recette])
				@endforeach
		        
		    
			{{-- <div class="row special-list ">
				<div class="col-lg-4 col-md-6 special-grid drinks rounded">
					<div class="gallery-single fix">
						<img src="{{ asset('frontend/yami/images/img-01.jpg') }}" class="img-fluid" alt="Image">

						<div class="wh-text p-4" style="border-radius: 10px;">
							<h4 style="color: #3f4870;margin-bottom: 0;font-size: 18px;font-family: Gilroy-Bold;">Special Drinks 1</h4>
							<p style="font-size: 13px;color: #439a96;margin: 6px0 0;font-family: Gilroy-Bold;text-transform: none;">
								Sed id magna vitae eros sagittis euismod.
							</p>
							<div id="product1">
								<h5 style="color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;" id="dd"> $7.79</h5>

								<div style="float: right">
									<button  style="border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;">
													    <i class="fa fa-link"></i>
									</button>
								    <button value="1" class="addToCard" style=" border-radius: 1em;background: aliceblue;width: 40px;height: 40px; cursor:pointer;">
									    <i class="fa fa-shopping-cart"></i>
								    </button>
								</div>

							</div>
							
						</div>
					</div>
				</div>
			--}}
				
			</div> 
		</div>
	</div>
	<!-- End Menu -->
	
	<!-- Start Gallery -->
	<div class="gallery-box">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Gallery</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					</div>
				</div>
			</div>
			<div class="tz-gallery">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-01.jpg') }}">
							<img class="img-fluid" src="{{ asset('frontend/yami/images/gallery-img-01.jpg') }}" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-02.jpg') }}">
							<img class="img-fluid" src="{{ asset('frontend/yami/images/gallery-img-02.jpg') }}" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-03.jpg') }}">
							<img class="img-fluid" src="{{ asset('frontend/yami/images/gallery-img-03.jpg') }}" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-04.jpg') }}">
							<img class="img-fluid" src="{{ asset('frontend/yami/images/gallery-img-04.jpg') }}" alt="Gallery Images">
						</a>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-05.jpg') }}">
							<img class="img-fluid" src="{{ asset('frontend/yami/images/gallery-img-05.jpg') }}" alt="Gallery Images">
						</a>
					</div> 
					<div class="col-sm-6 col-md-4 col-lg-4">
						<a class="lightbox" href="images/gallery-img-06.jpg') }}">
							<img class="img-fluid" src="{{ asset('frontend/yami/images/gallery-img-06.jpg') }}" alt="Gallery Images">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Gallery -->
	
	<!-- Start Customer Reviews -->
	<div class="customer-reviews-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Avis des clients</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 mr-auto ml-auto text-center">
					<div id="reviews" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner mt-4">
							<div class="carousel-item text-center active">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="{{ asset('frontend/yami/images/profile-1.jpg') }}" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Paul Mitchel</strong></h5>
								<h6 class="text-dark m-0">Chef cuisinier</h6>
								<p class="m-0 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="{{ asset('frontend/yami/images/profile-3.jpg') }}" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Steve Fonsi</strong></h5>
								<h6 class="text-dark m-0">Cuisinier</h6>
								<p class="m-0 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="{{ asset('frontend/yami/images/profile-7.jpg') }}" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Daniel vebar</strong></h5>
								<h6 class="text-dark m-0">Cuisinier</h6>
								<p class="m-0 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
							</div>
						</div>
						<a class="carousel-control-prev" href="#reviews" role="button" data-slide="prev">
							<i class="fa fa-angle-left" aria-hidden="true"></i>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#reviews" role="button" data-slide="next">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
							<span class="sr-only">Next</span>
						</a>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Customer Reviews -->
	
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
	<div class="contact-imfo-box" id="restcont">
		
	</div>
	<div  class="box-right" style="display:none;position: fixed;top: -39px;right: 141px;width: 17em;z-index: 12;height: 20em;background: aliceblue;padding: 1em;margin-top: 7em;border: 7px solid rgb(208, 167, 114);" >
			<div  class="header-cart"><!----><div  class="cart-resume">
				<div  class="boxing-cart">
					<i  class="icon-cart"></i>
					<div  class="content-resume-cart">
						<h4  class="uppercase-spacing" style="font-weight: bold;">panier</h4>
						<span  class="price">10 Dhs</span>
					</div>
				</div>
				</div><!---->
			</div>
			<div  class="order-listing">
				<h4  class="uppercase-spacing" style="font-weight: bold;">commande</h4><!----><!---->
			</div>
				<div  class="price-cart">
					<div  class="sub-price">
						<div  class="sub-sub-price">
						   <h5  class="uppercase-spacing" style="font-weight: bold;">sous-total</h5>
						   <span id="prix" >0 Dhs</span>
						</div><!---->
						<div  class="sub-sub-price">
							<h5  class="uppercase-spacing" style="font-weight: bold;">Frais de livraison</h5>
							<span >10 Dhs</span>
						</div><!----><!---->
					</div>
					<div  class="total-price">
						<h5  class="uppercase-spacing" style="font-weight: bold;">total</h5>
						<span  class="price-total" id="prix_tcc">10 Dhs</span>
					</div>
					<button  class="btn-prim">passer la commande</button>
					<!---->
				</div>

	</div>
	<!-- End Contact info -->

	<style>
		.cardButton{
			border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;
		}
	</style>


	{{-- <!--  restaurant js ajax details  -->
    <script type="text/javascript">
        
        $(document).ready(function(){
			$.ajax({
                    url: "{{ route('rest.ajax') }}",
                    type:'GET',
                    success: function(data) {
					var tml="<div class='container'>"+
								"<div class='row'>"+
									"<div class='col-md-4'>"+
										"<i class='fa fa-volume-control-phone'></i>"+
										"<div class='overflow-hidden'>"+
											"<h4>Phone</h4>"+
											"<p class='lead'>"+
												data.numtel+
											"</p>"+
										"</div>"+
									"</div>"+
									"<div class='col-md-4'>"+
										"<i class='fa fa-envelope'></i>"+
										"<div class='overflow-hidden'>"+
											"<h4>Email</h4>"+
											"<p class='lead'>"+
												data.email+
											"</p>"+
										"</div>"+
									"</div>"+
									"<div class='col-md-4'>"+
										"<i class='fa fa-map-marker'></i>"+
										"<div class='overflow-hidden'>"+
											"<h4>Location</h4>"+
											"<p class='lead'>"+
												data.adresse+
											"</p>"+
										"</div>"+
									"</div>"+
								"</div>"+
						    "</div>";

							console.log(html);
						
                        var html = "<div class='row'>" +
                                    "<div class='col-4'>" +
                                        "<p>" +
                                            "<strong>nom :</strong> "+ data.nom +
                                        "</p>" +
                                    "</div>" +
                                    "<div class='col-4'>" +
                                        "<p> <strong>email :</strong> "+data.email+"</p>"+
                                    "</div>" +

                                    "<div class='col-4'>" +
                                        "<p>" +
                                            "<strong>tel :</strong> "+ data.numtel +
                                        "</p>" +
                                    "</div>" +
                                "</div>" +
                                

                                "<div class='row'>" +
                                    "<div class='col-4'>" +
                                        "<p> <strong>capital :</strong> "+data.capital+"</p>"+
                                    "</div>" +

                                    "<div class='col-4'>" +
                                        "<p>" +
                                            "<strong>adresse :</strong> "+ data.adresse +
                                        "</p>" +
                                    "</div>" +
                                    "<div class='col-4'>" +
                                        "<p> <strong>baseline :</strong> "+data.baseline + " \(" + data.heures_ouv[0] + " à " + data.heures_ouv[1]+  "\) " + "</p>"+
                                    "</div>" +
                                "</div>" +
                                

                                "<div class='row'>" +
                                    "<div class='col-6'>" +
                                        "<p>" +
                                            "<strong>à propos :</strong> "+ data.apropos +
                                        "</p>" +
                                    "</div>" +
                                    "<div class='col-6'>" +
                                        "<p> <strong>description :</strong> "+data.description+"</p>"+
                                    "</div>" +
                                "</div>" ;
                                        
                    $('#restcont').append(html)
                }
            });
        
		});
    </script>  --}}

<!-- end restaurant js ajax details --> 

@endsection




