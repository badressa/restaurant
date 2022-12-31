@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Restaurant  </h3>
            </div>
        </div>
    </div>
</div>

<div class="page-content" >
    <!-- Basic Tables start -->
    <section class="section" >
        <div class="card">
            <div class="card-header">
                <h4 style="display: contents;">informations sur le Restaurant </h4>

            </div>
            
            <div class="card-body"  id="restcont" >

                {{--<div class="row">
                    <div class="col-4">
                        <p><strong>nom :</strong> nom</p>
                    </div>
                    <div class="col-4">
                        <p><strong>description :</strong> nom</p>
                    </div>
                </div>
               
                 <div class="row">
                    <div class="col-4">
                        <p><strong>nom :</strong> nom</p>
                    </div>
                    <div class="col-4">
                        <p><strong>description :</strong>  Contrairement à une opinion répandue, le Lorem Ipsum n'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l'éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", proviennent de la section 1.10.32.

                            L'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).</p>
                    </div>
                </div> --}}
               

            </div>
           
        </div>

    </section>
    
    <!-- Basic Tables end -->
</div>



<!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery CDN --> 
<!--  restaurant js ajax details  -->
    <script type="text/javascript">
        
        $(document).ready(function() {

                // var _token = $("input[name='_token']").val();
                // var email = $("#email").val();
                // var pswd = $("#pwd").val();
                // var address = $("#address").val();

                $.ajax({
                    url: "{{ route('rest.ajax') }}",
                    type:'GET',
                    success: function(data) {
                        var html = "<div class='row'>" +
                                    "<div class='col-4'>" +
                                        "<p>" +
                                            "<strong>nom :</strong> "+ data.nom +
                                        "</p>" +
                                    "</div>" +
                                    "<div class='col-4'>" +
                                        "<p> <strong>email :</strong> "+data.email+"</p>"+
                                    "</div>" +

                                    "<div class='col-4'>" +
                                        "<p>" +
                                            "<strong>tel :</strong> "+ data.numtel +
                                        "</p>" +
                                    "</div>" +
                                "</div>" +
                                

                                "<div class='row'>" +
                                    "<div class='col-4'>" +
                                        "<p> <strong>capital :</strong> "+data.capital+"</p>"+
                                    "</div>" +

                                    "<div class='col-4'>" +
                                        "<p>" +
                                            "<strong>adresse :</strong> "+ data.adresse +
                                        "</p>" +
                                    "</div>" +
                                    "<div class='col-4'>" +
                                        "<p> <strong>baseline :</strong> "+data.baseline + " \(" + data.heures_ouv[0] + " à " + data.heures_ouv[1]+  "\) " + "</p>"+
                                    "</div>" +
                                "</div>" +
                                

                                "<div class='row'>" +
                                    "<div class='col-6'>" +
                                        "<p>" +
                                            "<strong>à propos :</strong> "+ data.apropos +
                                        "</p>" +
                                    "</div>" +
                                    "<div class='col-6'>" +
                                        "<p> <strong>description :</strong> "+data.description+"</p>"+
                                    "</div>" +
                                "</div>" ;
                    
                        
                        $('#restcont').append(html)
                    }
                });
        

            function printMsg (msg) {
            if($.isEmptyObject(msg.error)){
                console.log(msg.success);
                $('.alert-block').css('display','block').append('<strong>'+msg.success+'</strong>');
            }else{
                $.each( msg.error, function( key, value ) {
                $('.'+key+'_err').text(value);
                });
            }
            }
        });
    </script>
<!-- end restaurant js ajax details --> 


{{-- <script type='text/javascript'>
$(document).ready(function(){
    // Fetch all records
    $('#fetchAllRecord').click(function(){
        fetchRecords(0);
    });
    // Search by userid
    $('#btnSearch').click(function(){
        var userid = Number($('#search').val().trim());
        if(userid > 0){
            fetchRecords(userid);
        }
    });
});
function fetchRecords(id){
        $.ajax({
            url: 'getData/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                var len = 0;
                $('#userTable tbody').empty(); // Empty <tbody>
                if(response['data'] != null){
                    len = response['data'].length;
                }
            if(len > 0){
                for(var i=0; i<len; i++){
                    var id = response['data'][i].id;
                    var username = response['data'][i].username;
                    var name = response['data'][i].name;
                    var email = response['data'][i].email;
                    var tr_str = "<tr>" +
                    "<td align='center'>" + (i+1) + "</td>" +
                    "<td align='center'>" + username + "</td>" +
                    "<td align='center'>" + name + "</td>" +
                    "<td align='center'>" + email + "</td>" +
                    "</tr>";
                    $("#userTable tbody").append(tr_str);
                }
            } else if(response['data'] != null){
                var tr_str = "<tr>" +
                "<td align='center'>1</td>" +
                "<td align='center'>" + response['data'].username + "</td>" + 
                "<td align='center'>" + response['data'].name + "</td>" +
                "<td align='center'>" + response['data'].email + "</td>" +
                "</tr>";
                $("#userTable tbody").append(tr_str);
            } else{
                var tr_str = "<tr>" +
                "<td align='center' colspan='4'>No record found.</td>" +
                "</tr>";
                $("#userTable tbody").append(tr_str);
            }
        }
        });
}
</script> --}}

@endsection





        
            

    
