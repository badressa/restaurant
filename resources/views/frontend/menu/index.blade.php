@php
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
		<div class="container" 
		{{-- style="background-image: url('{{ asset('/images/menus/'.$menu_recettes->image) }}');
		background-repeat: no-repeat;
		background-size: cover;" --}}
		>
		@if(isset($menu))
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
				@if($recette->receipts)
				{{-- <div class="col-lg-4 col-md-6 special-grid drinks rounded">
					<div class="gallery-single fix">
						<img src="{{ asset('/images/recettes/'.$recette->receipts->photo) }}" style="max-height : 14em; padding:1em;" class="img-fluid" alt="Image">

						<div class="wh-text p-4" style="border-radius: 10px;">
							<h4 style="color: #3f4870;margin-bottom: 0;font-size: 18px;font-family: Gilroy-Bold;">{{$recette->receipts->libelle}}</h4>
							<p style="font-size: 13px;color: #439a96;margin: 6px0 0;font-family: Gilroy-Bold;text-transform: none;">
								{{$recette->receipts->description}}
								
							</p>
							<div class="product">
								<div class="recipe py-1" style="display: block;">
								@foreach ($recette->receipts->ingrediants as $ingrediant)
								  <button style="border: none;border-radius: 10px;">
									  {{ $ingrediant->nom }}
								  </button>
								@endforeach
							    </div>

								@if($productsIds = searchIds($products, 'id', $recette->receipts->id))
								   
								<div>
										<button value="{{$productsIds[0]['id']}}" class='substractOneToCard cardButton' > 
											-  
										</button>
										<span class='itemqte qte'>{{$productsIds[0]['qte']}}</span>
						
										<button value="{{$productsIds[0]['id']}}"  class='addOneToCard cardButton' >
										    +  
										</button>
										<button value="{{$productsIds[0]['id']}}" class='cardButton deleteFromCard'  style='background-color:red;float:right;'>
										    x  
										</button>
								</div>
								@else 
								<h5 style="color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;" class="price" data-price="{{$recette->receipts->prix_tcc}}" > {{$recette->receipts->prix_tcc}} Dhs </h5>

								<div style="float: right">
									<button  style="border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;">
													    <i class="fa fa-link"></i>
									</button>
								    <button value="{{$recette->receipts->id}}"  class="addToCard" 
									style=" border-radius: 1em;background: aliceblue;width: 40px;height: 40px; cursor:pointer;">
									    <i class="fa fa-shopping-cart"></i>
								    </button>
								</div>
								@endif

							</div>
							
						</div>
					</div>
				</div> --}}
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
			@endif


		
		
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

	{{-- <form id="myform" class="form-wizard">
		<h2 class="form-wizard-heading">BootStap Wizard Form</h2>
		<input type="text" value=""/>
		<input type="submit"/>
	</form>
	
	<!-- Modal -->
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Modal header</h3>
		</div>
		<div class="modal-body">
			<p>One fine body…</p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary">Save changes</button>
		</div>
	</div>
	<script>
		$('#myModal').modal('toggle');
		$('#myModal').modal('show');
		$('#myModal').modal('hide');
	</script> --}}
	{{-- <button type="button"  style="float: right;" class="btn btn-rounded btn-success mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">ajouter des recettes</button>

	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('menu.recipe.store') }}" method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div id='recette_recette' >
                                    <div id="newRow">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                @if(count($recettes) !== 0)
                            
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Recettes</label>
                                                        <select name="idrecette[]" class="form-select" id="basicSelect">
                                                            <option value="" selected="" disabled="">Selectionner un recette</option>
                                                            @foreach ($recettes as $recette )
                                                                <option value="{{ $recette->id }}">{{ $recette->libelle }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('idrecette')
                                                            <div class="invalid-feedback">
                                                                <i class="bx bx-radio-circle"></i>
                                                                {{ $message }}
                                                            </div> 
                                                        @enderror
                                                    </fieldset>
                            
                                                @endif
                                            </div>    
                                        </div> 
                                        
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="basicInput" style="display: block;">quantité</label>
                                                <input  name="qte[]" type="text" class="form-control
                                                @error('qte') is-invalid @enderror" id="basicInput" placeholder="quantité"  value="{{old('qte')}}" >
                            
                                                    @error('qte') 
                                                        <div class="invalid-feedback" >
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                    @enderror
                                            </div>
                                            
                                        </div>
                                    </div>

                                    </div>
                                    <div class="col-2 pt-4">
                                        <button id="addRow" type="button" class="btn btn-info"><i class="bi bi-plus-circle"></i></button>
                                    </div>

                            </div>    
                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <!-- Basic Tables end --> --}}
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




