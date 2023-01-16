
@php 
    // dd($tablemaxrow,$tables,$tablemaxcol,$rowcount);
    $num = 2;

    function get($reservations){
        $reserDateArray = [];
        if(isset($reservations)){
           foreach($resercations as $reservation){
            $reserDateArray[] = array('id' =>   $reservation->id , 'date_reservation' );
           } 
        }
    }
    
@endphp
@extends('yami.yami_master')
@section('yami') 
<div class="table-box">
    <div class="container">
        <h1>Choisir la table qui te convient</h1> 
        <div id="restborder" style="margin: 44px 0px;border: 10px solid;padding:20px;position:relative;">
            <div style=" width: 20%;height: 10px;position: absolute;border-radius: 20px 20px  0px 0px;left: 40%;top: -10px;background: azure;"></div>
            
            <div class="tabler">
                <div class="grid-container" >
                    @if(isset($tables))
                        @foreach ($tables as $table )
                        
                            {{--static $row = 1;--}}
                            @php static $i = 1; static  $j=1; @endphp
                            @php  $row = $table->row @endphp
                          
                            @if($j==$table->row)

                                @if($i==$table->col)
                                    @include('components.tables.index', ['table',$table])
                                    @php $i++; @endphp
                                @else
                                    @while (($i <= $table->col && $i <= $tablemaxcol ))
                                            @if($i==$table->col)
                                            @include('components.tables.index', ['table',$table])
                                                @php $i++; @endphp
                                            @else
                                                <div class='item'>
                                                    <h2 style="    position: absolute;top: 2px;right: 10px;font-size: medium;"> Loc: {{$table->location}} i = {{$i}} - j{{$j}}  row{{$row}} </h2>
                                                </div>
                                                @php $i++; @endphp
                                            @endif
                                    @endwhile

                                @endif
                    
                            @endif

                            @if($j!=$table->row)
                                @if($i!=1)
                                    @while (($i <= $tablemaxcol ))
                                        <div class='item'>
                                            <h2 style="    position: absolute;top: 2px;right: 10px;font-size: medium;">{{--N° Table : $table->num--}} Loc: {{$table->location}} i = {{$i}} - j{{$j}}  khalf{{$row}} </h2>
                                        </div>
                                        @php $i++; @endphp
                                    @endwhile
                                    @php  if($i==$tablemaxcol+1) {$i =1; $j++;} @endphp
                                @endif
                                @if($i==1 && $j<$table->row )
                                    @while($table->row<$j)
                                        @while (($i <= $tablemaxcol ))
                                            <div class='item'>
                                                <h2 style="    position: absolute;top: 2px;right: 10px;font-size: medium;">{{--N° Table : $table->num--}} Loc: {{$table->location}} i = {{$i}} - j{{$j}}  row{{$row}} </h2>
                                            </div>
                                            @php $i++; @endphp
                                        @endwhile
                                        @php  if($i==$tablemaxcol+1) {$i =1; $j++;} @endphp
                                    @endwhile                
                                @endif
                                @if($i==$table->col)
                                    @include('components.tables.index', ['table',$table])
                                    @php $i++; @endphp
                                @else
                                    @while (($i <= $table->col && $i <= $tablemaxcol ))
                                            @if($i==$table->col)
                                                @include('components.tables.index', ['table',$table])
                                                @php $i++; @endphp
                                            @else
                                                <div class='item'>
                                                    <h2 style="    position: absolute;top: 2px;right: 10px;font-size: medium;">{{--N° Table : $table->num--}} Loc: {{$table->location}} i = {{$i}} - j{{$j}}  row{{$row}} </h2>
                                                </div>
                                                @php $i++; @endphp
                                            @endif
                                    @endwhile

                                @endif
                                
                            @endif
                            
                            @php  if($i==$tablemaxcol+1) {$i =1; $j++;} @endphp
                        
                        @endforeach
                    @endif                    
                </div>
            </div>
            
           
        </div>
    </div>
</div>
    
<style>
.table-box{
    padding: 98px 0px;
}
.grid-container{
    display: grid;
    grid-template-columns: repeat({{$tablemaxcol}},1fr);
    grid-gap: 10px;
    row-gap: 10px;
    grid-auto-rows: 200px;
}
.item{
    border: 1px solid grey;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}
#table-wrapper {

position: relative;
}

.item .the-table-xl {
  border-radius: 32px !important;
}

.item .the-table {
   /* position: absolute;
   left: 30px;
  top: 30px; */
  display: flex;
  border-radius: 5px;
  width: 10em;
  height: 6em;
  justify-content: center;
  align-items: center;
  background-color: #5e4837;
  box-shadow: 0 3px 9pt rgba(0, 0, 0, 0.23), 0 3px 9pt rgba(0, 0, 0, 0.16);

  /* position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); */
}
.item .the-sm-table {
    display: flex;
    width: 6em;
    height: 4em;
    justify-content: center;
    align-items: center;
    background-color: #5e4837;
    box-shadow: 0 3px 9pt rgba(0, 0, 0, 0.23), 0 3px 9pt rgba(0, 0, 0, 0.16);
    border-radius: 5px;
}

#table-wrapper .chair {
  position: absolute;
  width: 2em;
  height: 2.3em;
  background-color: black;
  background-color: #3e2f24;
  border-radius: 13%/100px 100px 0 0;
  box-shadow: 0 3px 9pt rgba(0, 0, 0, 0.23), 0 3px 9pt rgba(0, 0, 0, 0.16);
}

#table-wrapper .chair.chair-lg {
  width: 2em;
  height: 2.3em;
}
/* #table-wrapper .chair.chair-lg:before {
  width: 2em;
  height: 2.3em;
  
} */
#table-wrapper .chair-lg:nth-child(1) {
    left: 30px;
    top: -26px;
}

#table-wrapper .chair-lg:nth-child(2) {
    right: 30px;
    top: -26px;
}
#table-wrapper .chair-lg:nth-child(3) {
    right: -26px;
    top: 26px;
    transform: rotate(90deg);
}
#table-wrapper .chair-lg:nth-child(4) {
    right: 30px;
    bottom: -26px;
    transform: rotate(180deg);
}
#table-wrapper .chair-lg:nth-child(5) {
    left: 30px;
    bottom: -26px;
    transform: rotate(180deg);
}

#table-wrapper .chair-lg:nth-child(6) {
    left: -26px;
    top: 26px;
    transform: rotate(-90deg);
  
} 


#table-wrapper .chair-sm:nth-child(1) {
    left: 30px;
    top: -26px;
}

#table-wrapper .chair-sm:nth-child(2) {
    right: -26px;
    transform: rotate(90deg);
    top: 1em;
}
#table-wrapper .chair-sm:nth-child(3) {
    right: 30px;
    bottom: -26px;
    transform: rotate(180deg);
}
#table-wrapper .chair-sm:nth-child(4) {
    left: -26px;
    top: 1em;
    transform: rotate(-90deg);
}
/* xl */
#table-wrapper .chair-xl:nth-child(1) {
    left: -15px;
    top: -11px;
    transform: rotate(-52deg);
}

#table-wrapper .chair-xl:nth-child(2) {
    right: -15px;
    top: -11px;
    transform: rotate(52deg);
}
#table-wrapper .chair-xl:nth-child(3) {
    right: -15px;
    bottom: -11px;
    transform: rotate(128deg);
}
#table-wrapper .chair-xl:nth-child(4) {
    left: -15px;
    bottom: -11px;
    transform: rotate(-128deg);
}
#table-wrapper .chair-xl:nth-child(5) {
    /*left: 30px;*/
    left : 26px;
    top: -26px;
}
#table-wrapper .chair-xl:nth-child(6) {
    right: 26px;
    top: -26px;
}
#table-wrapper .chair-xl:nth-child(7) {
    right: 26px;
    bottom: -26px;
    transform: rotate(180deg);
}
#table-wrapper .chair-xl:nth-child(8) {
    left: 26px;
    bottom: -26px;
    transform: rotate(180deg);
}
#table-wrapper .chair-xl:nth-child(9) {
    right: -26px;
    top: 26px;
    transform: rotate(90deg);
    
}
#table-wrapper .chair-xl:nth-child(10) {
    left: -26px;
    top: 26px;
    transform: rotate(-90deg);
}
#table-wrapper .chair-xl:nth-child(11) {
    top: -26px;
    left: 60px;
}
#table-wrapper .chair-xl:nth-child(12) {
    bottom: -26px;
    right: 60px;
}





</style>


{{-- <div class="row">
    <div class="col-md-6">
    Restaurant
    <div id="restaurant" class="restaurant">
        <div id="table_1" class="table_restaurant sortable connectedSortable" draggable="true""
             ondrop="drop(event,this)">Table 1
            <div id="waiter_1" class="waiter" draggable="true" ondragstart="drag(event)" table_id="table_1">Bob</div>
            <div id="waiter_2" class="waiter" draggable="true" ondragstart="drag(event)" table_id="table_1">Alice</div>
            </div>
        </div>
        <div id="table_2" class="table_restaurant sortable connectedSortable" draggable="true"">Table 1
            <div id="waiter_3" class="waiter" draggable="true" ondragstart="drag(event)" table_id="table_2">Jim</div>
            <div id="waiter_4" class="waiter" draggable="true" ondragstart="drag(event)" table_id="table_2">Zoe</div>
        </div>
    </div>
    <div class="col-md-2">
        <div>
            <span>Serveurs  </span>
        </div>
        <div id="waiters" class="waiters sortable connectedSortable" ondrop="drop(event,this)">
            <div id="waiter_5" class="waiter" draggable="true" ondragstart="drag(event)">John</div>
            <div id="waiter_6" class="waiter" draggable="true" ondragstart="drag(event)">Emily</div>
        </div>
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $(".sortable").sortable({
            connectWith: '.connectedSortable'
        }).disableSelection();
    });
</script> --}}
@endsection