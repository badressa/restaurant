@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <h3>Recettes :</h3>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display: contents;">modifier recettes </h4>
                <a style="float: right" href="{{ route('recette.view') }}"><i class="fa fa-reply" ></i></a>
            </div>

            <form action="{{ route( 'recette.update' , $recette->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">libelle</label>
                                <input  name="libelle" type="text" class="form-control @error('libelle') is-invalid @enderror" id="basicInput" placeholder="libelle"  value="{{old('libelle')==null?$recette->libelle:old('libelle')}}">

                            @error('libelle') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Prix Hors Taxe</label>
                                <input  name='prix_ht' type="text" class="form-control   @error('prix_ht') is-invalid @enderror" id="basicInput" placeholder="prix_ht" value="{{old('prix_ht')==null?$recette->prix_ht:old('prix_ht')}}" >
                                @error('prix_ht')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            @if( $recette->disponible==0  )

                                <div class="form-check form-switch pt-4">
                                    <input class="form-check-input" name="disponible" type="checkbox" id="flexSwitchCheckChecked"  checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">disponible</label>
                                </div>

                            @else

                                <div class="form-check form-switch pt-4">
                                    <input class="form-check-input" name="disponible" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">non disponible</label>
                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Reduction</label>
                                <input  name='reduction' type="text" class="form-control   @error('reduction') is-invalid @enderror" id="basicInput" placeholder="reduction" value="{{old('reduction')==null?$recette->reduction:old('reduction')}}" >
                                @error('reduction')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Taxe sur la valeur ajoutée</label>
                                <input  name='tva' type="text" class="form-control @error('tva') is-invalid @enderror" id="basicInput" placeholder="tva"  value="{{old('tva')==null?$recette->tva:old('tva')}}">
                                @error('tva')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label for="basicInput">Toutes taxes comprises.</label>
                                <input  name='prix_tcc' type="text" class="form-control @error('prix_tcc') is-invalid @enderror" id="basicInput" placeholder="ttc" value="{{ old('prix_tcc')==null ? $recette->prix_tcc : old('prix_ttc')}}">
                                @error('prix_tcc')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>

                        

                    </div>


                    <div class="row">
                        
                        <div class="col-md-6 mb-4">

                            @if(count($formats) !== 0)

                                <fieldset class="form-group">
                                    <label for="basicInput">Taille</label>
                                    <select name='idFormat' class="form-select" id="basicSelect">
                                        <option value="" selected="" disabled="">Selectionner une taille</option>
                                        @foreach ($formats as $format )
                                            <option value="{{ $format->id }}" {{ $recette->idFormat==$format->id ? 'selected' : '' }} >{{ $format->taille }}</option>
                                        @endforeach   
                                    </select>
                                    @error('prix_unitaire')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div> 
                                    @enderror
                                </fieldset>

                            @else

                            <div class="form-group">
                                <label for="basicInput">Format</label>
                                <p> aucune format insérée</p>
                            </div>

                            @endif

                        </div>
                        
                        <div class="col-md-6 mb-4">

                            @if(count($categories) !== 0)

                                <fieldset class="form-group">
                                    <label for="basicInput">Categorie</label>
                                    <select name='idCategorie' class="form-select" id="basicSelect">
                                        <option value="" selected="" disabled="">Selectionner une categorie</option>
                                        @foreach ($categories as $categorie )
                                        <option value="{{ $categorie->id }}" {{ $recette->idCategory==$categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                                        @endforeach
                                        
                                    </select>
                                    @error('idCategorie')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div> 
                                    @enderror
                                </fieldset>

                            @else

                            <div class="form-group">
                                <label for="basicInput">catégorie</label>
                                <p> aucune catégorie insérée</p>
                            </div>

                            @endif

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="col-12 mb-4">
                                <div class="form-group with-title mb-3">
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('description')==null ? $recette->description : old('description')}}">{{ old('description')==null ? $recette->description : old('description')}}</textarea>
                                    <label>recette description</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6"> 

                            <div class="form-group">
                                <label for="basicInput">Photo </label>
                                <input  name="photo" type="file" class="form-control @error('photo') is-invalid @enderror" id="basicInput" placeholder="photo"  value="{{old('photo')}}">

                            @error('photo') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </section>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">liste des ingredients des menus </h4>

            </div>
            <div class="card-header">
                <h6 style="display: contents;">Ingrediants: </h4>
            </div>
                <div class="card-body"  >
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>libele</th>
                            <th>qte</th>
                            <th>unite</th>
                            <th>date de creation</th>
                            <th>status</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recette_ingredients as $key => $ingredient )
                            <tr>
                                
                                <td> {{ $key+1 }}</td>	
                                <td> {{ $ingredient->ingrediant->nom}}</td>	
                                <td>
                                 <form action="{{ route('recette.ingrediant.update', $ingredient->id) }}" method="POST">
                                    @csrf                                
                                    <input type="text" name="qte" value="{{ $ingredient->qte }}" style="width:5em;" > 
                                    <button title="edit"  class="btn btn-success" style="margin: 0em 0.2em"><i class="fas fa-edit"></i></button>
                                 </form>  
                                </td>	
                                <td> {{ $ingredient->unite }}</td>	
                                <td> {{ $ingredient->ingrediant->created_at->diffForHumans() }}</td>	
                                <td>
                                    @if($ingredient->ingrediant->status == 0)
                                        <span class="badge bg-success">Disponible</span> 
                                    @else
                                        <span class="badge bg-danger">Non Disponible</span> 
                                    @endif
                                </td>   
                                <td>
                                    <form action="{{ route('recette.ingrediant.delete', $ingredient->id) }}" method="post">
                                        @csrf
                                        <button title="delete" type="submit" class="btn btn-danger" style="margin: 0em 0.2em"><i class="fas fa-trash-alt"></i></a>   
                                    </form>
                                     
                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        
        </div>

    </section>

</div>
@endsection