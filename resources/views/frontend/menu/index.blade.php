@php
	//dd($recipe_categories);

    $products = session()->get('product');;
	$recipeIng = session()->get('recipeingredients');
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

	
	<!-- Start Menu -->
	<div class="menu-box">
		<div class="container" {{-- style="background-image: url('{{ asset('/images/menus/'.$menu_recettes->image) }}');
		background-repeat: no-repeat;
		background-size: cover;" --}}>
		{{-- @if(isset($menu))
			<div class="row" style="margin-top: 4em;">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Menu Speciale</h2>
						<p></p>
					</div>
				</div>
			</div>

			<div class="row special-list ">
				@foreach ($menu_recettes as $recette)
					@if($recette->recettes)
						@include('components.recipe',['recette',$recette])
					@endif
				@endforeach
			</div>
			@else
			<div class="row" style="margin-top: 4em;">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>On ne peut pas afficher aucun Menu ce moment ...</h2>
						<p></p>
					</div>
				</div>
			</div>
		@endif --}}
		<div class="row" style="margin-top: 4em;">
			<div class="col-lg-12">
				<div class="heading-title text-center">
					<h2>Menu Speciale</h2>
					<p></p>
				</div>
			</div>
		</div>
		@foreach ($recipe_categories as $category)
			@if(!$category->recettes->isEmpty())
				@php $inMenu=false; @endphp		
				@foreach ($category->recetteMenuCategories as $categoryMenus)	
					
					@if ($categoryMenus->menu_id==$menu->id)
						@php $inMenu=true; @endphp
					@endif
				@endforeach

				@if($inMenu==true)
					<h1 class="px-2 py-1 " style="background-color:#cf2a35; color:white; width:10em;border-radius: 7px;">{{$category->nom}}</h1>
				@endif
				<div class="row">
				@foreach ($category->recettes as $recette)
					
					@php $inMenu=false; @endphp
					
					@foreach ($recette->recipemenus as $recipemenu)
						@if ($recipemenu->menu_id==$menu->id)
							@php $inMenu=true; @endphp
						@endif
					@endforeach
			
					@if($inMenu==true)
						@include('components.recipe',['recette',$recette])
					@endif
					{{-- <p>{{$recette->libelle}}</p> --}}
				@endforeach
			    </div>
				{{-- @if($recette->recettes)
						@include('components.recipe',['recette',$recette])
				@endif --}}
			@endif
		@endforeach
		
		


		
		
		</div>
	</div>
	<!-- End Menu -->




	<!-- End Contact info -->
	<div  class="box-right" style="display:none;position: fixed;top: -39px;right: 141px;width: 17em;z-index: 12;height: 20em;background: aliceblue;padding: 1em;margin-top: 7em;border: 7px solid rgb(208, 167, 114);" >
		<div  class="header-cart"><!----><div  class="cart-resume">
			<div  class="boxing-cart">
				<i  class="icon-cart"></i>
				<div  class="content-resume-cart">
					<h4  class="uppercase-spacing" style="font-weight: bold;">panier</h4>
					{{-- <span  class="price">10 Dhs</span> --}}
				</div>
			</div>
			{{-- <div  class="number-cart">0</div> --}}
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
				<button  class="btn-prim" ><a href="{{route('panier.addorder')}}">passer la commande</a></button>
				<!---->
			</div>
	</div>

	
</div>


<style>
    #idholder {
        height: 300px;
        width: 300px;
        border: 2px solid black;
    }
    #imgPreview {
        max-width: 300px;
        max-height: 300px;
        min-width: 300px;
        min-height: 300px;
    }
</style>


<script>
    // add row
    $("#addRow").click(function () {

        $('#inputForm').html();
        
            var html= ''; 
            html += '<div id="inputFormRow">';
            html += $('#inputForm').html();
            html += '</div>';
            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $tt = $(this).closest('#inputFormRow');
            console.log($tt);
            $(this).closest('#inputFormRow').remove();
        });
</script>


	<style>
		.cardButton{
			border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;
		}
	</style>

	



@endsection




