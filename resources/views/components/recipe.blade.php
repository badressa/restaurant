@php
    $route = Route::current()->getName();
	
    
@endphp

    @if($route=='yami.menu')
    @if($recette->receipts->disponible == 0)
 
    <div class="col-lg-4 col-md-6 special-grid drinks rounded">
        <div class="gallery-single fix">
            <img src="{{ asset('/images/recettes/'.$recette->receipts->photo) }}" style="max-height : 14em; padding:1em;" class="img-fluid" alt="Image">

            <div class="wh-text p-4" style="border-radius: 10px;">
                <h4 style="color: #3f4870;margin-bottom: 0;font-size: 18px;font-family: Gilroy-Bold;">{{$recette->receipts->libelle}} </h4>
                <p style="font-size: 13px;color: #439a96;margin: 6px0 0;font-family: Gilroy-Bold;text-transform: none;">
                    {{$recette->receipts->description}}
                    
                </p>
                    <div class="recipe py-1" style="display: block;">

                        @if($reciteI = searchIds($recipeIng, 'recipeid', $recette->receipts->id))
                             
                            @foreach ($recette->receipts->ingrediants as $ingrediant)
                                @if ($ingrediant->status == 0)
                                    
                                    @php
                                        $notinIng = !in_array ($ingrediant->id,$reciteI[0]['ingredients']);
                                    @endphp
                                    <div class="form-group form-check" style="border: none; border-radius: 10px; display: inline; {{$notinIng?'background: lavender;':'background: rgb(12, 124, 93);color: white;'}} padding: 0.1em 1em; margin-right: 8px; white-space: nowrap;">
                                        <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                        @if($notinIng)
                                            <input class='checkIngredient' value="{{$recette->receipts->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                        class="form-check-input" id="exampleCheck1">
                                        @else
                                            <span value="{{$recette->receipts->id}}.{{$ingrediant->id}}" class="deleteRecetteIng" style="color:red;cursor:pointer;font-weight: bold;padding-left:6px;">x</span>
                                        @endif
                                    </div>
                        
                                @endif
                            @endforeach

                        @else
                            @foreach ($recette->receipts->ingrediants as $ingrediant)
                                @if ($ingrediant->status == 0)
                                    <div class="form-group form-check" style="border: none;border-radius: 10px;display: inline;background: lavender;
                                    padding: 0.1em 1em;margin-right:8px; white-space: nowrap;">
                                        <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                        <input class='checkIngredient' value="{{$recette->receipts->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                        class="form-check-input" id="exampleCheck1">
                                    </div>
                                @endif
                            @endforeach
                        @endif

                    </div>
                <div class="product">

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
    </div>
        @endif
    @endif

    @if ($route=='yami.index')
    @if($recette->article->disponible == 0)
    <div class="col-lg-4 col-md-6 special-grid lunch rounded">
        <div class="gallery-single fix">
            <img src="{{ asset('/images/recettes/'.$recette->article->photo) }}" style="max-height : 14em; padding:1em;" class="img-fluid" alt="Image">

            <div class="wh-text p-4" style="border-radius: 10px;">
                <h4 style="color: #3f4870;margin-bottom: 0;font-size: 18px;font-family: Gilroy-Bold;">{{$recette->article->libelle}}</h4>
                <p style="font-size: 13px;color: #439a96;margin: 6px0 0;font-family: Gilroy-Bold;text-transform: none;">
                    {{$recette->article->description}}
                    
                </p>

                <!-- Ingredients -->
                <div class="recipe py-1" style="display: block;">

                    @if($reciteI = searchIds($recipeIng, 'recipeid', $recette->article->id))
                         
                        @foreach ($recette->article->ingrediants as $ingrediant)
                            @if ($ingrediant->status == 0)
                                
                                @php
                                    $notinIng = !in_array ($ingrediant->id,$reciteI[0]['ingredients']);
                                @endphp
                                <div class="form-group form-check" style="border: none; border-radius: 10px; display: inline; {{$notinIng?'background: lavender;':'background: rgb(12, 124, 93);color: white;'}} padding: 0.1em 1em; margin-right: 8px; white-space: nowrap;">
                                    <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                    @if($notinIng)
                                        <input class='checkIngredient' value="{{$recette->article->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                    class="form-check-input" id="exampleCheck1">
                                    @else
                                        <span value="{{$recette->article->id}}.{{$ingrediant->id}}" class="deleteRecetteIng" style="color:red;cursor:pointer;font-weight: bold;padding-left:6px;">x</span>
                                    @endif
                                </div>
                    
                            @endif
                        @endforeach

                    @else
                        @foreach ($recette->article->ingrediants as $ingrediant)
                            @if ($ingrediant->status == 0)
                                <div class="form-group form-check" style="border: none;border-radius: 10px;display: inline;background: lavender;
                                padding: 0.1em 1em;margin-right:8px; white-space: nowrap;">
                                    <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                    <input class='checkIngredient' value="{{$recette->article->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                    class="form-check-input" id="exampleCheck1">
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
                <!-- -->

                
                {{-- <div class="recipe py-1" style="display: block;">
                    @foreach ($recette->article->ingrediants as $ingrediant)
                    <button style="border: none;border-radius: 10px;">
                        {{ $ingrediant->nom }}
                    </button>
                    @endforeach
                </div> --}}
                <div class="product">

                    @if($productsIds = searchIds($products, 'id', $recette->article->id))
                       
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
                    <h5 style="color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;" class="price" data-price="{{$recette->article->prix_tcc}}" > {{$recette->article->prix_tcc}} Dhs </h5>

                    <div style="float: right">
                        <button  style="border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;">
                                            <i class="fa fa-link"></i>
                        </button>
                        <button value="{{$recette->article->id}}"  class="addToCard" 
                        style=" border-radius: 1em;background: aliceblue;width: 40px;height: 40px; cursor:pointer;">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                    @endif

                </div>
                
            </div>
        </div>
    </div>
    @endif
    @endif



