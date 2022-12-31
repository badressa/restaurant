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
            <form action="{{ route('ingrediant.update' , $editData->id ) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput1">Nom</label>
                                <input  name='nom' type="text" class="form-control" id="basicInput1" value=" {{ $editData->nom }} " placeholder="nom" >
                            </div>
                            <div class="form-group">
                                <label for="basicInput2">Quantite d'unité</label>
                                <input  name='quantite_unite' type="text" class="form-control" id="basicInput2" value=" {{ $editData->quantite_unite}} " placeholder="quantite d'unite">
                            </div>
                            <div class="form-group">
                                <label for="basicInput3">Unité</label>
                                <input  name='unite' type="text" class="form-control" id="basicInput3" value=" {{ $editData->unite }} " placeholder="unite">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="basicInput4">Prix unitaire</label>
                                <input  name='prix_unitaire' type="text" class="form-control" id="basicInput4" value=" {{ $editData->prix_unitaire }} " placeholder="unitaire">
                            </div>
                            <fieldset class="form-group">
                                <label for="basicSelect1">categorie</label>
                                <select name='categorie' class="form-select" id="basicSelect1">
                                    <option value="" selected="" disabled="">Selectionner une categorie</option>
                                    <option>Blade Runner</option>
                                    <option>Thor Ragnarok</option>
                                </select>
                            </fieldset>
                        </div>

                        <button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                
                    </div>
                </div>
            </form>
        </div>
    </section>

</div>

@endsection