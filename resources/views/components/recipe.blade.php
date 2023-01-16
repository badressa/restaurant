@php
    $route = Route::current()->getName();
	
    
@endphp

    @if($route=='yami.menu')
        {{-- @if($recette->recettes->disponible == 0)
            <div class="col-lg-4 col-md-6 special-grid rounded">
                <div class="gallery-single fix">
                    <div>
                        <img src="{{ asset('/images/recettes/'.$recette->recettes->photo) }}" style="max-height : 14em; padding:1em;" class="img-fluid" alt="Image">
                    </div>
                
                        @if ($recette->recettes->category!==null)
                        <p>
                            {{$recette->recettes->category->nom}}
                        </p>
                        @endif
                        
                
                    <div class="wh-text px-4"" style="border-radius: 10px;">
                        <h4 style="color: #3f4870;margin-bottom: 0;font-size: 18px;font-family: Gilroy-Bold;">{{$recette->recettes->libelle}} </h4>
                        <p style="font-size: 13px;color: #439a96;margin: 6px0 0;font-family: Gilroy-Bold;text-transform: none;">
                            {{$recette->recettes->description}}
                            
                        </p>
                            <div class="recipe py-1" style="display: block;">

                                @if($reciteI = searchIds($recipeIng, 'recipeid', $recette->recettes->id))
                                    
                                    @foreach ($recette->recettes->ingrediants as $ingrediant)
                                        @if ($ingrediant->status == 0)
                                            
                                            @php
                                                $notinIng = !in_array ($ingrediant->id,$reciteI[0]['ingredients']);
                                            @endphp
                                            <div class="form-group form-check" style="border: none; border-radius: 10px; display: inline; {{$notinIng?'background: lavender;':'background: rgb(12, 124, 93);color: white;'}} padding: 0.1em 1em; margin-right: 8px; white-space: nowrap;">
                                                <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                                @if($notinIng)
                                                    <input class='checkIngredient' value="{{$recette->recettes->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                                class="form-check-input" id="exampleCheck1">
                                                @else
                                                    <span value="{{$recette->recettes->id}}.{{$ingrediant->id}}" class="deleteRecetteIng" style="color:red;cursor:pointer;font-weight: bold;padding-left:6px;">x</span>
                                                @endif
                                            </div>
                                
                                        @endif
                                    @endforeach

                                @else
                                    @foreach ($recette->recettes->ingrediants as $ingrediant)
                                        @if ($ingrediant->status == 0)
                                            <div class="form-group form-check" style="border: none;border-radius: 10px;display: inline;background: lavender;
                                            padding: 0.1em 1em;margin-right:8px; white-space: nowrap;">
                                                <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                                <input class='checkIngredient' value="{{$recette->recettes->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                                class="form-check-input" id="exampleCheck1">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        <div class="product" style="min-height: 45px;">

                            @if($productsIds = searchIds($products, 'id', $recette->recettes->id))
                            
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
                            <h5 style="color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;" class="price" data-price="{{$recette->recettes->prix_tcc}}" > {{$recette->recettes->prix_tcc}} Dhs </h5>

                            <div style="float: right">
                                <button  style="border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;">
                                                    <i class="fa fa-link"></i>
                                </button>
                                <button value="{{$recette->recettes->id}}"  class="addToCard" 
                                style=" border-radius: 1em;background: aliceblue;width: 40px;height: 40px; cursor:pointer;">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </div>
                            @endif

                        </div>
                        
                    </div>
                </div>
            </div>
        @endif --}}
        @if($recette->disponible == 0)
            <div class="col-lg-6 col-md-12 special-grid rounded">
                <div class="gallery-single fix row">
                    <div class="col-4 py-2 " style="box-shadow: #cf2a35 0px -4px 4px">
                        <img src="{{ asset('/images/recettes/'.$recette->photo) }}" style="max-height: 7em;max-width: 10em;" class="img-fluid" alt="Image">
                    </div>
                    <div class="col-8 wh-text px-2 py-2"  style="border-radius: 10px;">
                        <h4 style="color: #3f4870;margin-bottom: 0;font-size: 18px;font-family: Gilroy-Bold;">{{$recette->libelle}} </h4>
                        <p style="font-size: 13px;color: #439a96;margin: 6px0 0;font-family: Gilroy-Bold;text-transform: none;">
                            {{$recette->description}}
                    </div> 
                    <div class="col-12">     
                        </p>
                            <div class="recipe py-1" style="display: block;">

                                @if($reciteI = searchIds($recipeIng, 'recipeid', $recette->id))
                                    
                                    @foreach ($recette->ingrediants as $ingrediant)
                                        @if ($ingrediant->status == 0)
                                            
                                            @php
                                                $notinIng = !in_array ($ingrediant->id,$reciteI[0]['ingredients']);
                                            @endphp
                                            <div class="form-group form-check" style="border: none; border-radius: 10px; display: inline; {{$notinIng?'background: lavender;':'background: rgb(12, 124, 93);color: white;'}} padding: 0.1em 1em; margin-right: 8px; white-space: nowrap;">
                                                <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                                @if($notinIng)
                                                    <input class='checkIngredient' value="{{$recette->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                                class="form-check-input" id="exampleCheck1">
                                                @else
                                                    <span value="{{$recette->id}}.{{$ingrediant->id}}" class="deleteRecetteIng" style="color:red;cursor:pointer;font-weight: bold;padding-left:6px;">x</span>
                                                @endif
                                            </div>
                                
                                        @endif
                                    @endforeach

                                @else
                                    @foreach ($recette->ingrediants as $ingrediant)
                                        @if ($ingrediant->status == 0)
                                            <div class="form-group form-check" style="border: none;border-radius: 10px;display: inline;background: lavender;
                                            padding: 0.1em 1em;margin-right:8px; white-space: nowrap;">
                                                <label class="form-check-label" for="exampleCheck1">{{ $ingrediant->nom }}</label>
                                                <input class='checkIngredient' value="{{$recette->id}}.{{$ingrediant->id}}" type="checkbox" style="position: absolute;margin-top: 0.5rem;margin-left: 0.1rem;"
                                                class="form-check-input" id="exampleCheck1">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        <div class="product" style="min-height: 45px;">

                            @if($productsIds = searchIds($products, 'id', $recette->id))
                            
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

                            <h5 style="color: #54596e;font-size: 18px;font-family: Gilroy-Bold;display: inline-block;" class="price" data-price="{{ceil($recette->prix_tcc-$recette->prix_tcc *$recette->reduction/100)}}" > 
                                <span {!! ($recette->reduction!=0)?'style="text-decoration:line-through; color:red"':''!!}>{{$recette->prix_tcc}} Dhs</span> 
                                @if($recette->reduction!=0) {{ceil($recette->prix_tcc-$recette->prix_tcc *$recette->reduction/100)}} Dhs @endif
                            </h5>

                            <div style="float: right">
                                <button  style="border-radius: 1em;background: aliceblue; width: 40px; height: 40px; cursor:pointer;">
                                                    <i class="fa fa-link"></i>
                                </button>
                                <button value="{{$recette->id}}"  class="addToCard" 
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



