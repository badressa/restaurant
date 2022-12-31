	<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>MarRest restaurant</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" />
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('frontend/yami/images/favicon.ico" type="image/x-icon') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/yami/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/yami/css/bootstrap.min.css') }}">    
	<!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/yami/css/style.css') }}">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/yami/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/yami/css/custom.css') }}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    @include('yami.body.header')
    @yield('yami')
    <!-- Footer Start -->
    @include('yami.body.footer')
    <!-- Footer End -->
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
</body>
<!-- ALL JS FILES -->
<script src="{{ asset('frontend/yami/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/bootstrap.min.js') }}"></script>
<!-- ALL PLUGINS -->
<script src="{{ asset('frontend/yami/js/jquery.superslides.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/images-loded.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/isotope.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/baguetteBox.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/form-validator.min.js') }}"></script>
<script src="{{ asset('frontend/yami/js/contact-form-script.js') }}"></script>
<script src="{{ asset('frontend/yami/js/custom.js') }}"></script>


<!-- Card(panier) scripts-->
<script>
	
	$( document ).ready(function() {
		$('#panier').html("<i class='fa fa-shopping-cart'></i> panier</a> <span class='badge badge-light' style='background: white;'>" +{{$items}}+"</span>");	
	});
	
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!--  restaurant js ajax details  -->
<script type="text/javascript">

    //$.noConflict();
	
	$(document).ready(function(){
		
		$.ajax({
				url: "{{ route('rest.ajax') }}",
				type:'GET',
				success: function(data) {
				console.log('data', data)
				var html="<div class='container'>"+
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


			var footer =`<div class='container'>
							<div class='row'>
								<div class='col-lg-3 col-md-6'>
									<h3>À propos</h3>
									<p>${data.apropos}</p>
								</div>
								<div class='col-lg-3 col-md-6'>
									<h3>heures D'ouvertures</h3>
									<p><span class='text-color'>Lundi: </span>Fermé</p>
									<p><span class='text-color'>Mar-Ven :</span> 9 M - 10 N</p>
									<p><span class='text-color'>Sam-Dim :</span> ${data.heures_ouv[0]} M - ${data.heures_ouv[1]} N</p>
									
								</div>
								<div class='col-lg-3 col-md-6'>
									<h3>INFOS DE CONTACT</h3>
									<p class='lead'>${data.adresse}</p>
									<p class='lead'><a href='#'>${data.numtel}</a></p>
									<p><a href='#'>${data.email}</a></p>
								</div>
								<div class='col-lg-3 col-md-6'>
									<ul class='list-inline f-social'>
										<li class='list-inline-item'><a href='#'><i class='fa fa-facebook' aria-hidden='true'></i></a></li>
										<li class='list-inline-item'><a href='#'><i class='fa fa-twitter' aria-hidden='true'></i></a></li>
										<li class='list-inline-item'><a href='#'><i class='fa fa-linkedin' aria-hidden='true'></i></a></li>
										<li class='list-inline-item'><a href='#'><i class='fa fa-google-plus' aria-hidden='true'></i></a></li>
										<li class='list-inline-item'><a href='#'><i class='fa fa-instagram' aria-hidden='true'></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						
						<div class='copyright'>
							<div class='container'>
								<div class='row'>
									<div class='col-lg-12'>
										<p class='company-name'>All Rights Reserved. &copy; 2022 <a href='#'>MarRest Restaurant</a> Design By : badr essadiki</p>
									</div>
								</div>
							</div>
						</div>`;

			
						
					
					var hml = "<div class='row'>" +
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
				$('.footer-area').append(footer)                  
				$('#restcont').append(html);
				
			}
		});
	
	});
</script> 
<!-- end restaurant js ajax details --> 

<script type="text/javascript">

$(document).ready(function() {
		
		$("body").on('click', '.addToCard',function(event) {
						 
			id =  event.target.value;

			var span = $(this).parents('.product');
			var prix = +span.find('.price')[0].getAttribute('data-price');

			var recipe = span.siblings('.recipe');
			//.children('.deleteRecetteIng')
			var ingredients = $(this).parents('.product').siblings('.recipe').find('span');
			console.log('recipeingrediadd',ingredients.length);

			var noFading= true;
			
			$.ajax({
				url: "{{ route('panier.addtocard') }}",
				type:'GET',
				data: { id : id , qte:1, item:1, prix: prix},
				success: function(data) {
					console.log('seksu data ahmad');
					console.log(data);
					if(data.id != null){
						// I used data-price attribute inside h1{price} element but it not appropriate and secure 
					html="<div>";
					html+="	<button value='"+ data.id +"' class='substractOneToCard cardButton' > ";
					html+="		-  ";
					html+="	</button>";
					html+="	<span class='itemqte qte'>" + data.qte + "</span>"
		
					html+="	<button value='" +data.id+ "'  class='addOneToCard cardButton' >";
					html+="	    +  ";
					html+="	</button>";
					html+="	<button value='" +data.id+ "' class='cardButton deleteFromCard'  style='background-color:red;float:right;'>";
					html+="	    x  ";
					html+="	</button>";
					html+="</div>";
					
					//prix_tcc = data.qte * prix ;
					id = data.id;
				
					span.html(html);
					//$('.product').html(html);
					
					if (noFading) {
						$(".box-right").css('display','block').stop(true,true).fadeIn().delay(4000).fadeOut();
					};
					
					$('#prix').text(data.prix_tcc);
					$('#prix_tcc').text(data.prix_tcc+10);
					$('#panier').html("<i class='fa fa-shopping-cart'></i> panier<span class='badge badge-light' style='background: white;'>"+data.items+"</span>");
					$('.badge-light').text = $('.badge-light').text+1 ;
				}	
				}
			});
		});	

	});	


	$(document).ready(function() {


	$('body').on("click", ".deleteFromCard", function (event) {
		event.preventDefault();
		var span = $(this).parents('.product');
		console.log('kes wa');
		id = event.target.value;
		var noFading = true;
			
				$.ajax({
					url: "{{ route('panier.deletefromcard') }}",
					type:'GET',
					
					data: { id : id },
					success: function(data) {
						console.log(data)
						
						console.log('njeht');
						console.log(data);
						
						html = "<h5 style='color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;' class='price' data-price='"+data.prix+"'>" + data.prix +" Dhs</h5>";
						html+= "<div style='float: right'>";
						html+= "	<button  style='border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;'>";
						html+= "					    <i class='fa fa-link'></i>";
						html+= "	</button>";
						html+= "    <button value='"+ data.id +"' class='addToCard'  style=' border-radius: 1em;background: aliceblue;width: 40px;height: 40px; cursor:pointer;'>";
						html+= "	    <i class='fa fa-shopping-cart'></i>";
						html+= "    </button>";
						html+= "</div>";
						if (noFading) {
							$(".box-right").css('display','block').stop(true,true).fadeIn().delay(4000).fadeOut();
					    }
						
							span.html(html);
							if(data.items == 0){
								$(".box-right").css('display','none');
							} 
							else {
								if (noFading) {
									$(".box-right").css('display','block').stop(true,true).fadeIn().delay(4000).fadeOut();
							    };
							}
							$('#prix').text(data.prix_tcc);
							$('#prix_tcc').text(data.prix_tcc+10);
							$('#panier').html("<i class='fa fa-shopping-cart'></i> panier <span class='badge badge-light' style='background: white;'>"+data.items+"</span>");		
					}
				});
	});
	});

		
	
	$(function(){


		$('body').on("click", ".addOneToCard", function (event) {
			event.preventDefault();
			var span = $(this).parents('.product');
			id = event.target.value;
			
			var noFading = true;
			
			console.log('addone test',noFading);
		    
			$.ajax({
				url: "{{ route('panier.addonetocard') }}",
				type:'GET',
				
				data: { id : id },
				success: function(data) {
					
					console.log(data);
					
					
					html="<div >";
					html+="	<button value='"+ data.id +"' class='substractOneToCard cardButton' >";
					html+="		-";
					html+="	</button>";
					html+="	<span class='itemqte qte' id='dd'>" + data.qte + "</span>"
					console.log(data.qte);
					html+="	<button value='"+ data.id +"'  class='addOneToCard cardButton'  >";
					html+="	    +";
					html+="	</button>";
					html+="	<button value='"+ data.id +"' class='cardButton deleteFromCard'  style='background-color:red;float:right;'>";
					html+="	    x";
					html+="	</button>";
					html+="</div>";
					
					//prix = data.qte * data.prix;

					span.html(html);
					
					if (noFading) {
						$(".box-right").css('display','block').stop(true,true).fadeIn().delay(4000).fadeOut();
					}
					setTimeout(() => {noFading = false;}, 10000);
					$('#prix').text(data.prix_tcc);
					$('#prix_tcc').text(data.prix_tcc+10);
					$('#panier').html("<i class='fa fa-shopping-cart'></i> panier <span class='badge badge-light' style='background: white;'>"+data.items+"</span>");	
				}
			});
		});
	});

	$(function(){

		$('body').on("click", ".substractOneToCard", function (event) {
			event.preventDefault();
			var span = $(this).parents('.product');
			
			id = event.target.value;
			
			var noFading = true;
				
					$.ajax({
						url: "{{ route('panier.subonetocard') }}",
						type:'GET',
						
						data: { id : id },
						success: function(data) {
							
							console.log(data);

							html="<div >";
							html+="	<button value='"+ data.id +"' class='substractOneToCard cardButton'> ";
							html+="		-";
							html+="	</button>";
							html+="	<span class='itemqte qte' >" + data.qte + "</span>"

							html+="	<button value='"+ data.id +"'  class='addOneToCard cardButton'  >";
							html+="	    +";
							html+="	</button>";
							html+="	<button value='"+ data.id +"' class='cardButton deleteFromCard'  style='background-color:red;float:right;'>";
							html+="	    x";
							html+="	</button>";
							html+="</div>";
							
							//prix = data.qte * data.prix;
							span.html(html);
							if (noFading) {
									$(".box-right").css('display','block').stop(true,true).fadeIn().delay(4000).fadeOut();
							    };
							$('#prix').text(data.prix_tcc);
							$('#prix_tcc').text(data.prix_tcc+10);
							$('#panier').html("<i class='fa fa-shopping-cart'></i> panier <span class='badge badge-light' style='background: white;'>"+data.items+"</span>");	
						}
					});
		});
	});

	$(function(){
		$('body').on("change", ".checkIngredient", function (event) {
			event.preventDefault();
			
			$(this).parent()[0].style.backgroundColor = "#0c7c5d";
			$(this).parent()[0].style.color = "white";
			
			var span = $(this).parents('.recipe');
			value = event.target.value.split('.');
			idr = +value[0];
			idi = +value[1];
			//border: none;border-radius: 10px;display: inline;background: ;padding: 0.1em 1em;color: white;margin-right: 8px;white-space: nowrap;
			$(this).parent().append("<span value='"+event.target.value+"' class='deleteRecetteIng' style='color:red;cursor:pointer;font-weight: bold;padding-left:6px;'>x</span>");
			$(this).remove();
			
		
			$.ajax({
				url: "{{ route('panier.addingrecipetocard') }}",
				type:'GET',
				
				data: { idr : idr, idi: idi },
				success: function(data) {
					console.log(data);	
				}
			});
	    });
	});

	$(function(){
		$('body').on("click", ".deleteRecetteIng", function (event) {                
			event.preventDefault();
			
			$(this).parent()[0].style.backgroundColor = "lavender";
			$(this).parent()[0].style.color = "black";

			var span = $(this).parents('.recipe');
			$(this)[0].style.backgroundColor="white";

			value = $(this)[0].getAttribute('value').split('.');
			
			idr = +value[0];
			idi = +value[1];
			
			$(this).parent().append("<input class='checkIngredient' value='"+$(this)[0].getAttribute('value')+"' type='checkbox' style='position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;' id='exampleCheck1'>");
			$(this).remove();
			
			var span = $(this).parents('.recipe');
		
			$.ajax({
				url: "{{ route('panier.deleteingrecipeincard') }}",
				type:'GET',
				
				data: { idr: idr, idi: idi },
				success: function(data) {
					console.log(data);	
				}
				});
			});
		});


	
		
		

</script>

 <!-- End Card(panier) scripts-->
</html>