@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Recettes </h3>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">tous les recettes</h4>
                <a href="{{ route('recette.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> ajouter une recettes</a>

            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>image</th>
                            <th>libele</th>
                            {{-- <th>prix_ht</th>
                            <th>tva</th> --}}
                            <th>ttc</th>
                            {{-- <th>date de creation</th> --}}
                            <th>Ingredients</th>
                            <th>Status</th>
                            <th>modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alldata as $key => $value )
                        <tr>
                            
                            <td>{{ $key+1 }}</td>
                            <td> <img src="{{ asset('images/recettes/'.$value->photo) }}" alt="{{ $value->libelle}} " style="width: 6em;" > </td>	
                            <td> {{ $value->libelle}}</td>	
                            {{-- <td> {{ $value->prix_ht }}</td>	
                            <td> {{ $value->tva }}</td> --}}
                            <td> {{ $value->prix_tcc }}</td>	
                            {{-- <td> {{ $value->created_at->diffForHumans() }}</td>	 --}}
                           
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button"style="width:max-content" class="btn btn-primary indcmd" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{ $value->id }}" >
                                    ingredients commandes
                                </button>
                            </td>  
                            <td>
                                @if($value->disponible == 0)
                                    <a href="{{ route('recette.status.edit', $value->id) }}"> <span class="badge bg-success">Disponible</span> </a> 
                                @else
                                    <a href="{{ route('recette.status.edit', $value->id) }}" > <span class="badge bg-danger">Non Disponible</span> </a> 
                                @endif
                            </td>     
                            <td>
                                <div class="flex" style="min-width: 160px;">
                                    <a title="edit" href="{{ route('recette.edit',$value->id) }}" class="btn btn-success" style="margin: 0em 0.2em"><i class="fas fa-edit"></i></a>
                                
                                    <a title="delete" href="{{ route('recette.delete',$value->id) }}" class="btn btn-danger" style="margin: 0em 0.2em"><i class="fas fa-trash-alt"></i></a>

                                    <a title="details" href="{{ route('recette.details', $value->id ) }}" class="btn btn-info" style="margin: 0em 0.2em"><i class="fas fa-file-search"></i></a>
                                </div>
                            </td>

                           
                            </td> 

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>

    <div id="inputForm" style="display: none;">
        
            <div class="row" >

                <div class="col-6">
                    <div class="form-group">
                        @if(count($ingredients) !== 0)
        
                            <fieldset class="form-group">
                                <label for="basicInput">Ingredients</label>
                                <select name='idingrediant[]' class="form-select" id="basicSelect">
                                    <option value="" selected="" disabled="">Selectionner un ingredient</option>
                                    @foreach ($ingredients as $ingredient )
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->nom }}</option>
                                    @endforeach
                                </select>
                                @error('idIngredient')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </fieldset>
        
                            <input type="hidden" name="unite[]" value="{{ $ingredient->unite }}">
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
                <form action="{{ route('recette.ingrediant.store') }}" method="POST" >
                    @csrf
                    <div class="modal-header" id="ingrecetteid">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                            <div id='recette_ingredient' >
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                @if(count($ingredients) !== 0)
                            
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Ingredients</label>
                                                        <select name='idingrediant[]' class="form-select" id="basicSelect">
                                                            <option value="" selected="" disabled="">Selectionner un ingredient</option>
                                                            @foreach ($ingredients as $ingredient )
                                                                <option value="{{ $ingredient->id }}">{{ $ingredient->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('idIngredient')
                                                            <div class="invalid-feedback">
                                                                <i class="bx bx-radio-circle"></i>
                                                                {{ $message }}
                                                            </div> 
                                                        @enderror
                                                    </fieldset>
                                                     
                                                    <input type="hidden" name="unite[]" value="{{ $ingredient->unite }}">
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

                                    <div id="newRow"></div>
                                    
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

<script>

    $(".indcmd").click(function (e) {
             console.log(e.target.value);
            $('#ingrecetteid').append("<input type='hidden' name='recette_id' value='"+e.target.value+"'  /> ")
            
        }
    );
    // add row
    $("#addRow").click(function (e) {
            
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



