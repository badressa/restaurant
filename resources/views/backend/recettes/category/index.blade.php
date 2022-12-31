@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Catégories </h3>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">tous les catégories</h4>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <form action="{{ route('recette.category.update') }}" method="POST" > 
                            @csrf
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Category</th>
                                        <th>date de création</th>
                                        <th>modifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alldata as $key => $value )
                                <tr>
                                    
                                    <td>{{ $key+1 }}</td>
                                    <td> 
                                        <input type="text" name="nom[]" value="{{ $value->nom }}" > 
                                        
                                    </td>		
                                    <td> {{ $value->created_at->diffForHumans() }}</td>	      
                                    <td>
                                        <button type="submit" name="key" value="{{ $value->id }}.{{ $key }}" class="btn btn-info">Edit</a>
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <div class="col-md-6 col-sm-12" style="padding-left: 5em;">
                        <h6 >ajouter une catégorie </h6>
                        <form action="{{ route('recette.category.store') }}" method="POST" >
                            @csrf      
                            <div class="form-group">
                                <label for="basicInput" style="display: block;">nom</label>
                                <input  name="nom" type="text" class="form-control"  style="width: 50%;display: inline;"
                                @error('nom') is-invalid @enderror" id="basicInput" placeholder="nom"  value="{{old('nom')}}">

                                    @error('nom') 
                                        <div class="invalid-feedback" >
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div> 
                                    @enderror
                                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>


@endsection
