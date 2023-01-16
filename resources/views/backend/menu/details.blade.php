@extends('admin.admin_master')
@section('admin')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> Menu Details </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <!-- Basic Tables start -->
        
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: contents;">Menu </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"> 

                            @if($menu->image!=null)
                                <img src="{{ asset('images/menus/'.$menu->image) }}" alt="{{ $menu->libelle}} " style="    max-width: 18em;max-height: 18em;"> 
                            @endif

                        </div>
                        
                        <div class="col-md-6">
                                <p><b>libelle</b> {{$menu->libelle}} </p>
                                <div class="form-check form-switch pt-4">
                                    <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked="" disabled>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">active</label>
                                </div>
                        </div>
                    </div>                            
                </div>
        
                
            </div>

        </section>
        
    
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: contents;">liste des reccetes de ce menu </h4>

                </div>
                <div class="card-header">
                    <h6 style="display: contents;">recettes: </h4>
                    <button type="button"  style="float: right;" class="btn btn-rounded btn-success mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">ajouter des recettes</button>

                </div>
                    <div class="card-body"  >
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>image</th>
                                    <th>libele</th>
                                    <th>prix_ht</th>
                                    <th>tva</th>
                                    <th>ttc</th>
                                    <th>date de creation</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menu_recettes as $key => $recette )
                                @if(!$recette!=null)
                                    <tr>
                                        
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            @if( $recette->recettes->photo!=null )
                                                <img src="{{ url('/images/recettes/'.$recette->recettes->photo) }}" alt="{{ $recette->recettes->libelle}} " style="width: 6em;" > 
                                            @endif
                                        </td>	
                                        <td> {{ $recette->recettes->libelle}}</td>	
                                        <td> {{ $recette->recettes->prix_ht }}</td>	
                                        <td> {{ $recette->recettes->tva }}</td>
                                        <td> {{ $recette->recettes->tcc }}</td>	
                                        <td> {{ $recette->recettes->created_at->diffForHumans() }}</td>	
                                        <td>
                                            @if($recette->recettes->disponible == 0)
                                                <span class="badge bg-success">Disponible</span> 
                                            @else
                                                <span class="badge bg-danger">Non Disponible</span> 
                                            @endif
                                        </td>      
                                    </tr>
                                     @endif
                                @endforeach
                            </tbody>
                        </table>
                   
                </div>


                <div class="card-header">
                    <h6 style="display: contents;">boissons: </h4>
                    <button type="button"  style="float: right;" class="btn btn-rounded btn-success mb-5">modifier le menu</button>

                </div>
            
            </div>

        </section>


        <div id="inputForm" style="display: none;">
        
            <div class="row" >

                <div class="col-6">
                    <div class="form-group">
                        @if(count($recettes) !== 0)
        
                            <fieldset class="form-group">
                                <label for="basicInput">Recettes</label>
                                <select name='idrecette[]' class="form-select" id="basicSelect">
                                    <option value="" selected="" >Selectionner une recette</option>
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
                <div class="col-2 pt-4">
                    <button id="removeRow" type="button" class="btn btn-danger">x</button>
                </div>
                
            </div>
        
        </div>

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


        
        
        <!-- Basic Tables end -->
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

@endsection


  



