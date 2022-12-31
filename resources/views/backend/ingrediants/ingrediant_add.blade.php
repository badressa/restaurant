@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <h3>Ingrédients:</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display: contents;">ajouter un ingredient</h4>
                <a style="float: right" href="{{ route('ingrediant.view') }}"><i class="fa fa-reply" ></i></a>
            </div>
            <form action="{{ route('ingrediant.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nom</label>
                                <input  name="nom" type="text" class="form-control @error('nom') is-invalid @enderror" id="basicInput" placeholder="nom"  value="{{old('nom')}}">

                            @error('nom') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Quantite</label>
                                <input  name='quantite_unite' type="text" class="form-control   @error('nom') is-invalid @enderror" id="basicInput" placeholder="quantite d'unite" value="{{old('quantite_unite')}}" >
                                @error('quantite_unite')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Unite</label>
                                <input  name='unite' type="text" class="form-control @error('nom') is-invalid @enderror" id="basicInput" placeholder="unite"  value="{{old('unite')}}">
                                @error('unite')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="basicInput">Prix unitaire</label>
                                <input  name='prix_unitaire' type="text" class="form-control @error('nom') is-invalid @enderror" id="basicInput" placeholder="prix hors taxe" value="{{old('unite')}}">
                                @error('prix_unitaire')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <fieldset class="form-group">
                                <label for="basicInput">Categorie</label>
                                <select name='categorie' class="form-select" id="basicSelect">
                                    <option value="" selected="" disabled="">Selectionner une categorie</option>
                                    <option>Blade Runner</option>
                                    <option>Thor Ragnarok</option>
                                </select>
                                @error('prix_unitaire')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </fieldset>
                            
                        </div>

                        <button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</div>

@endsection