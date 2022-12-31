@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Personelles </h3>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">tous les personels</h4>
                <a href="{{ route('staff.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> ajouter un personel</a>

            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>nom</th>
                            
                            <th>date de creation</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allData as $key => $value )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> {{ $value->name }}</td>	
                            <td> {{ $value->created_at->diffForHumans() }}</td>	
                            <td>
                                @if($value->status == 0)
                                    <a href="{{-- route('staff.status.edit',$value->id) --}}"> <span class="badge bg-success">Active</span> </a> 
                                @else
                                    <a href="{{-- route('staff.status.edit',$value->id) --}}" > <span class="badge bg-danger">Inactive</span> </a> 
                                @endif
                            </td>       
                            <td style="display:flex;">

                                <a title="edit" href="{{ route('staff.edit',$value->id) }}" class="btn btn-success" style="margin: 0em 0.2em"><i class="fas fa-edit"></i></a>
                                
                                <a title="delete" href="{{ route('staff.delete',$value->id) }}" class="btn btn-danger" style="margin: 0em 0.2em"><i class="fas fa-trash-alt"></i></a>
                                                                
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


@endsection





        
            

    
