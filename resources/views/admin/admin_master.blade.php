@php
    use App\Models\RecetteCategory;
    $categories = RecetteCategory::all();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restaurant Dashboard </title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" />
    
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/yami/images/favicon.ico') }}" type="image/x-icon">            
    <!-- <link rel="stylesheet" href="assets/vendors/jquery-datatables/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/fontawesome/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/pages/auth.css') }}">
    
    <style>
        table.dataTable td{
            padding: 15px 8px;
        }
        .fontawesome-icons .the-icon svg {
            font-size: 24px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.svg') }}" type="image/x-icon">


    <!--toaste message -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!--toaste message -->
</head>

<body>
    <div id="app">
        @include('admin.body.sidebar')
        <div id="main">
          @include('admin.body.header')
          @yield('admin')
          @include('admin.body.footer')
        </div>
    </div>
    {{-- <div id="alert" style="display:none; width: 100vw; height: 100vh; background: rgba(12,12,12,0.4); position: fixed; z-index: 11;top: 0; padding:5em;justify-content: center">
        <div class="page-content">
            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 style="display: contents;">Detail ingredient recette </h4>
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
        
                        <div class="row">
        
                            <div class="col-md-6 col-sm-12" style="padding-left: 5em;">
                                
                                <form action="{{ route('recette.category.store') }}" method="POST" >
                                    @csrf      
                                    <div class="form-group">
                                        @if(count($categories) !== 0)

                                            <fieldset class="form-group">
                                                <label for="basicInput">Ingredients</label>
                                                <select name='idCategorie' class="form-select" id="basicSelect">
                                                    <option value="" selected="" disabled="">Selectionner une categorie</option>
                                                    @foreach ($categories as $categorie )
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                @error('idCategorie')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div> 
                                                @enderror
                                            </fieldset>

                                        @endif

                                        <label for="basicInput" style="display: block;">recette</label>
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

    </div> --}}

    

    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('backend/assets/js/mazer.js') }}"></script>

    <script src="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('backend/assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/fontawesome/all.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Jquery Datatable
        let jquery_datatable = $("#table1").DataTable()
    </script>

    <!-- toast message -->
    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif
      
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif
      
        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif
      
        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
      </script>
      <!-- end toast message -->
        <!--menu js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
            $( "#togglemenu" ).click(function() {
        $( "#menubody" ).toggle( "slow", function() {
            // Animation complete.
            
        });
        $( "#listmenu" ).toggle( "slow");
        });
        </script>

        <script>
            $(document).ready(() => {
                $("#image").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview")
                            .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>

        <script type="text/javascript">
            // $(document).on('submit','#menubody',function(){
            // var year_id = $('#year_id').val();
            // var class_id = $('#class_id').val();
            // var assign_subject_id = $('#assign_subject_id').val();
            // var exam_type_id = $('#exam_type_id').val();
            // $.ajax({
            //     url: "{{-- route('student.marks.getstudents') --}}",
            //     type: "GET",
            //     data: {'year_id':year_id,'class_id':class_id},
            //     success: function (data) {
            //     $('#marks-entry').removeClass('d-none');
            //     var html = '';
            //     $.each( data, function(key, v){
            //         html +=
            //         '<tr>'+
            //         '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"> <input type="hidden" name="id_no[]" value="'+v.student.id_no+'"> </td>'+
            //         '<td>'+v.student.name+'</td>'+
            //         '<td>'+v.student.fname+'</td>'+
            //         '<td>'+v.student.gender+'</td>'+
            //         '<td><input type="text" class="form-control form-control-sm" name="marks[]" ></td>'+
            //         '</tr>';
            //     });
            //     html = $('#marks-entry-tr').html(html);
            //     }
            // });
            // });
        
        </script>
        <!--end menu js -->

        <!--  restaurant js ajax details  -->
        {{-- <script type="text/javascript">
         $(document).ready(function() {

            // var _token = $("input[name='_token']").val();
            // var email = $("#email").val();
            // var pswd = $("#pwd").val();
            // var address = $("#address").val();

            console.log('hanawal');
            $.ajax({
                url: "{{ route('rest.ajax') }}",
                type:'GET',
                success: function(data) {
                    var = "<div class='row'>"+
                                "<div class='col-4'>"+
                                    "<p>"+
                                        "<strong>nom :</strong> nom"+
                                    "</p>"+
                                "</div>"+
                                "<div class='col-4'>"+
                                    "<p> <strong>description :</strong> nom</p>"+
                                "</div>"+
                            "</div>"  ;
                    console.log('hanawal' + data.nom);
                    $('#restcont').append(data.nom)
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
</script> --}}
<!-- end restaurant js ajax details -->


</body>

</html>
