@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Menu </h3>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">ajouter un menu </h4>
                <button type="button" id="togglemenu" style="float: right;" class="btn btn-rounded btn-success mb-5"> ajouter un menu</button>

            </div>
            
            
            
    
                <form  action="{{ route('menu.store') }}" id="menubody" method="POST" enctype="multipart/form-data" onsubmit="" style="display: none">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">nom</label>
                                    <input  name="nom" type="text" class="form-control @error('nom') is-invalid @enderror" id="basicInput" placeholder="nom"  value="{{old('nom')}}">
    
                                @error('libelle') 
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                                </div>
                            </div>
    
                            

                            <div class="col-md-2">
                                <div class="form-check form-switch pt-4">
                                    <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">active</label>
                                </div>
                            </div>
    
                        </div>

                        <div class="row">
                            <div class="col-md-6"> 
    
                                <div class="form-group">
                                    <label for="basicInput">Photo </label>
                                    <input  name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="image" placeholder="image"  value="{{old('image')}}">
    
                                @error('image') 
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                                </div>

                                <div id="idholder">
                                    <img id="imgPreview" src="{{ asset('images/photoins.png') }}" alt="pic" />
                                </div>
                            </div>

                            <div class="col-md-4 pt-4">
                                <button type="submit" class="btn btn-primary me-1 mb-1 " >Submit</button>
                            </div>

                        </div>
                            
                    </div>
                </form>
            
        </div>

    </section>
    
    <section class="section" id="listmenu">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">liste des menus </h4>

            </div>
            
                <div class="card-body"  >
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>image</th>
                            <th>libele</th>
                            <th>date de creation</th>
                            <th>Status</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alldata as $key => $value )
                        <tr>
                            
                            <td>{{ $key+1 }}</td>
                            <td> <img src="{{ asset('images/menus/'.$value->image) }}" alt="{{ $value->nom}} " style="max-width: 18em; max-height:18em;"> </td>	
                            <td> {{ $value->nom}}</td>	

                            <td> {{ $value->created_at->diffForHumans() }}</td>	
                            <td>
                                @if($value->status == 0)
                                    <a href="{{ route('menu.status.edit', $value->id) }}"> <span class="badge bg-success">Active</span> </a> 
                                @else
                                    <a href="{{ route('menu.status.edit', $value->id) }}" > <span class="badge bg-danger">Non Active</span> </a> 
                                @endif
                            </td>      
                            <td >
                                <div style="display:flex;">
                                    <a title="edit" href="{{ route('menu.edit',$value->id) }}" class="btn btn-success" style="margin: 0em 0.2em"><i class="fas fa-edit"></i></a>
                                    
                                    <a title="delete" href="{{ route('menu.delete',$value->id) }}" class="btn btn-danger" style="margin: 0em 0.2em"><i class="fas fa-trash-alt"></i></a>

                                    <a title="details" href="{{ route('menu.details', $value->id ) }}" class="btn btn-info" style="margin: 0em 0.2em"><i class="fas fa-file-search"></i></a>
                                </div>
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


  
@endsection



