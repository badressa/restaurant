@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <h3>Tables:</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display: contents;">modifier la table</h4>
                <a style="float: right" href="{{ route('table.view') }}"><i class="fa fa-reply" ></i></a>
            </div>


            <form action="{{ route('table.update' , $editData->id ) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Num</label>
                                <input  name="num" type="text" class="form-control @error('num') is-invalid @enderror" id="basicInput" placeholder="num"  value="{{( old('num')==null ) ? $editData->num : old('num')}}">

                            @error('num') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Maximale nombre des gens</label>
                                <input  name='maxcapacite' type="text" class="form-control   @error('maxcapacite') is-invalid @enderror" id="basicInput" placeholder="max capacité" value="{{( old('maxcapacite')==null ) ? $editData->maxcapacite : old('maxcapacite')}}" >
                                @error('maxcapacite')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">location</label>
                                <input  name='location' type="text" class="form-control @error('location') is-invalid @enderror" id="basicInput" placeholder="x,y"  value="{{( old('location')==null ) ? $editData->location : old('location')}}">
                                @error('location')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">

                            @if( $editData->status==0  )

                                <div class="form-check form-switch pt-4">
                                    <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked"  checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">active</label>
                                </div>

                            @else

                                <div class="form-check form-switch pt-4">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">inactive</label>
                                </div>

                            @endif

                        </div>

                    </div>

                        <button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </section>

</div>

@endsection