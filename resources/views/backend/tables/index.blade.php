@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Tables </h3>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">tous les tables</h4>
                <a href="{{ route('table.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> ajouter un table</a>

            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>numero de table</th>
                            <th>maxcapacite</th>
                            <th>location</th>
                            <th>date de creation</th>
                            <th>status</th>
                            <th>reservation</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alldata as $key => $value )
                        <tr>

                            <td>{{ $key+1 }}</td>
                            <td> {{ $value->num }}</td>	
                            <td> {{ $value->maxcapacite }}</td>		
                            <td> {{ $value->location }}</td>	
                            <td> {{ $value->created_at->diffForHumans() }}</td>	
                            <td>
                                @if($value->status == 0)
                                    <a href="{{ route('table.status.edit',$value->id) }}"> <span class="badge bg-success">Active</span> </a> 
                                @else
                                    <a href="{{ route('table.status.edit',$value->id) }}" > <span class="badge bg-danger">Inactive</span> </a> 
                                @endif
                            </td> 

                            <td>
                                <a href="" class="btn btn-info">reservation</a>
                            </td>   
                               
                            <td>
                                <a title="edit" href="{{ route('table.edit',$value->id) }}" class="btn btn-success" style="margin: 0em 0.2em"><i class="fas fa-edit"></i></a>
                                
                                <a title="delete" href="{{ route('table.delete',$value->id) }}" class="btn btn-danger" style="margin: 0em 0.2em"><i class="fas fa-trash-alt"></i></a>

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





        
            

    
