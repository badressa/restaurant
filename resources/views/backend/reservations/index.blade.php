@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Reservations </h3>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 style="background: yellowgreen"> !! Note the numbers of rows should less than 12 and cols 5</h2>
                <h4 style="display: contents;">tous les reservations</h4>
                <a href="{{ route('reservation.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> ajouter un reservation</a>

            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>id de reservation</th>
                            <th>nombres de personnes</th>
                            <th>date de creation</th>
                            <th>payée</th>
                            <th>table</th>
                            <th>client</th>  
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alldata as $key => $value )
                        <tr>

                            <td>{{ $key+1 }}</td>
                            <td> {{ $value->id}}</td>	
                            <td> {{ $value->nbrpersonne }}</td>			
                            <td> {{ $value->created_at->diffForHumans() }}</td>
                            <td> {{ $value->payee }}</td>
                            <td> {{ $value->client->name }}</td>
                            <td> {{ $value->table->num }}</td>
                            <td>
                                @if($value->status == 0)
                                    <a href="{{ route('reservation.status.edit',$value->id) }}"> <span class="badge bg-success">Active</span> </a> 
                                @else
                                    <a href="{{ route('reservation.status.edit',$value->id) }}" > <span class="badge bg-danger">Inactive</span> </a> 
                                @endif
                            </td>       
                            <td>
                                <a href="{{ route('reservation.edit',$value->id) }}" class="btn btn-info">Edit</a>
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





        
            

    
