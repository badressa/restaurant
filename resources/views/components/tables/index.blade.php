@php
    $reserved = false;
    $i =0;
    $case = $table->maxcapacite <=4 ? 'sm':($table->maxcapacite<=6 ? 'lg':($table->maxcapacite <=12) ? 'lg' : '');
    $casetable = $table->maxcapacite <=4 ? '-sm':($table->maxcapacite <=6 ? '':($table->maxcapacite <=12) ? '' : '');
@endphp

{{-- @foreach ($table->reservations as $res)
    @if(date<$res->date_reservation<=endres)
    @elseif ($res->date_reservation<=endres)
    @endif
@endforeach --}}
<div class='item' onclick="alert({{$table->num}})">
    <h2 style="    position: absolute;top: 2px;right: 10px;font-size: medium; ">N° Table : {{$table->num}}, max: {{$table->maxcapacite}}</h2>
    <div id="table-wrapper" >
        @while($i < $table->maxcapacite)
        <div class="chair chair-{{$case}} {{ $table->status==1?'border border-danger':''}}"></div>
        @php $i++ @endphp
        @endwhile
        <div class="the{{$casetable}}-table {{ $table->status==1?'bg-danger':''}}"><span class="text-light">{{ $table->status==1?'inactive':''}}</span></div>
    </div>
</div>
      
 



    

                    
