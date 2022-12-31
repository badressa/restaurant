@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <h3>Reservations :</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display: contents;">ajouter une reservation</h4>
                <a style="float: right" href="{{ route('reservation.view') }}"><i class="fa fa-reply" ></i></a>
            </div>
            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">date de reservation</label>
                                <input  name='date_reservation' type="date" class="form-control @error('date_reservation') is-invalid @enderror" id="basicInput" placeholder="date_reservation"  value="{{old('date_reservation')}}">
                                @error('date_reservation')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">heure de fin</label>
                                <input  name="heure_fin" type="time" class="form-control @error('heure_fin') is-invalid @enderror" id="basicInput" placeholder="heure_fin"  value="{{old('heure_fin')}}">

                            @error('heure_fin') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">heure de debut</label>
                                <input  name="heure_debut" type="time" class="form-control @error('heure_debut') is-invalid @enderror" id="basicInput" placeholder="heure_debut"  value="{{old('heure_debut')}}">

                            @error('heure_debut') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group" style="position: relative">
                                <label for="basicInput">client(optionnel)</label>

                                
                                <!--name='clien_id'-->
                                <input name="txt_search"  type="text" id="txt_search"  class="form-control @error('client_id') is-invalid @enderror" id="basicInput" placeholder="chercher un client"  value="{{old('client_id')}}">
                                <div class="searchinfo" style="min-height: 2em;width: 21.3em;background: aliceblue;position: absolute;top: 4em;">
                                    <ul id="searchResult"></ul>
                                    <div class="clear"></div>
                                    <div id="userDetail"></div>
                                </div>
                                
                                
                                @error('client_id')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" style="position: relative">
                                <label for="basicInput">table *</label>
                                <input  type="text" id="table_search" name="table_search" type="text" class="form-control @error('table_id') is-invalid @enderror" id="basicInput" placeholder="chercher une table "  value="{{old('table_id')}}">
                            
                                <div class="searchinfo" style="min-height: 2em; width: 21.3em; background: aliceblue; position: absolute; top: 4em;">
                                    <ul id="tableSearchResult"></ul>
                                    <div class="clear"></div>
                                    <div id="tableDetail"></div>
                                </div>
                                @error('client_id')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">nombre de personne</label>
                                <input  name='nbrpersonne' type="text" class="form-control @error('nbrpersonne') is-invalid @enderror" id="basicInput" placeholder="nbrpersonne"  value="{{old('nbrpersonne')}}">
                                @error('nbrpersonne')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                <label class="form-check-label" for="flexSwitchCheckChecked">verifiée</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch pt-4">
                                <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                <label class="form-check-label" for="flexSwitchCheckChecked">payée</label>
                            </div>
                        </div>
                    </div>
                    <div>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Submit</button>
                    </div>
                </div>
            </form>
        
        </section>
    </div>

</div>


    <script type="text/javascript">
        $(document).ready(function(){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#txt_search").keyup(function(){
                var search = $(this).val();

                if(search != ""){

                    $.ajax({
                        url: "{{ route('reservation.getclients' )}}",
                        type: 'post',
                        data: {search:search, type:1},
                        //dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            $("#userDetail").empty();
                            $("#searchResult").empty();
                            for( var i = 0; i<len; i++){
                                var id = response[i]['id'];
                                var name = response[i]['name'];

                                $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                            }

                            // binding click event to li
                            $("#searchResult li").bind("click",function(){
                                setText(this);
                            });


                        }
                    });
                }

            });


        });


        function setText(element){

            var value = $(element).text();
            var userid = $(element).val();

            $("#txt_search").val(value);
            $("#searchResult").empty();


            // Request User Details
            $.ajax({
                url: "{{ route('reservation.getclients' )}}",
                type: 'post',
                data: {userid:userid, type:2},
                dataType: 'json',
                success: function(response){
                    
                    var len = response.length;
                    $("#userDetail").empty();
                    $(".searchinfo").css('position','');
                    $(".searchinfo").css('border-radius','1em');
                    $(".searchinfo").css('padding','1em');
                    if(len > 0){
                        var userid = response[0]['id'];
                        var username = response[0]['name'] == null ? "non inséré" : response[0]['name'] ;
                        var email = response[0]['email'] == null ? "non inséré" : response[0]['email'];
                        $("#userDetail").append("<input type='hidden' name='client_id' value='"+userid+"'' />");
                        $("#userDetail").append("Username : " + username  + "<br/>");
                        $("#userDetail").append("Email : " + email  );
                    }
                }

            });
        }

    </script>


<script type="text/javascript">
    $(document).ready(function(){
        
        $("#table_search").keyup(function(){
            var search = $(this).val();

            if(search != ""){

                $.ajax({
                    url: "{{ route('reservation.gettables' )}}",
                    type: 'get',
                    data: {search:search, type:1},
                    //dataType: 'json',
                    success:function(response){
                        var len = response.length;
                        console.log(response);
                        $("#tableSearchResult").empty();
                        $("#tableDetail").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var num = response[i]['num'];

                            $("#tableSearchResult").append("<li value='"+id+"'>table "+num+"</li>");

                        }

                        // binding click event to li
                        $("#tableSearchResult li").bind("click",function(){
                            setTableText(this);
                        });


                    }
                });
            }

        });


    });


    function setTableText(element){

        var value = $(element).text();
        var tableid = $(element).val();

        $("#table_search").val(value);
        $("#tableSearchResult").empty();
        $(".searchinfo").css('position','');
        $(".searchinfo").css('border-radius','1em');
        $(".searchinfo").css('padding','1em');
        // Request User Details
        $.ajax({
            url: "{{ route('reservation.gettables' )}}",
            type: 'get',
            data: {tableid:tableid, type:2},
            dataType: 'json',
            success: function(response){
                var len = response.length;
                $("#tableDetail").empty();
                if(len > 0){
                    var tableid = response[0]['id'];
                    var num = response[0]['num'];
                    $("#tableDetail").append("<input type='hidden' name='table_id' value='"+tableid+"'' />");
                    $("#tableDetail").append("table: " + num + "<br/>");
               
                }
            }

        });
    }

</script>

    
    



@endsection