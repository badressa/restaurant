@php
    $reserved = false;
    $i =0;
    $j=0;
    $nbrpersonne =1;
    $dateReDebut ='0';
    $DateReFin ='0';
    $reservinfo = session()->get('resinfo');
    //page not refreshed to get session
    // if($reservinfo !== null){
    //     $nbrpersonne = $reservinfo['nbrpersonne'];
    //     $dateReDebut = $reservinfo['heure_debut'];
    //     $dateReFin =$reservinfo['heure_fin'];
    // } 
    $case = $table->maxcapacite <=4 ? 'sm':(($table->maxcapacite<=6) ? 'lg':((6<$table->maxcapacite ||  $table->maxcapacite<=12) ? 'xl' : ''));
    $casetable = $table->maxcapacite <=4 ? '-sm':($table->maxcapacite <=6 ? '':($table->maxcapacite <=12) ? '' : '');
@endphp
{{--@foreach ($table->reservations as $res)
    @if($minesQuarter < $res->date_reservation <= $plusQuarter)
        <li>{{$res->date_reservation.' '.$res->heure_debut }}</li>
    @elseif ($res->date_reservation<=$endres)
    @endif 
    @php $dateresdebut = $res->date_reservation.' '.$res->heure_debut.':00';
    $dateresfin = $res->date_reservation.' '.$res->heure_fin.':00'; @endphp
     @php if($dateReDebut!=='0' && $dateReFin!=='0'){
        $j= ( ($dateresdebut> $dateReDebut  && $dateresdebut < $dateReDebut  ) ||  ($dateresfin> $dateReFin  && $dateresfin < $dateReFin))?1:0;
        }
     @endphp 
    
@endforeach --}}


{{-- @if($table->reservations)
<h1>res {{$table->reservations[0]->id}}</h1>
@endif--}}

{{-- onclick="pushTableId({{$table->id}})" --}}
<div class='item' data-nbrcapacite="{{$table->maxcapacite}}" >
    <div style="position: absolute;top: 2px;right: 10px;font-size: medium;">
        <label  for="inlineRadio1">N° Table : {{$table->num}} </label>
        
        <input  type="radio"  name="table_id" id="table{{$table->id}}" value="{{$table->id}}" {!! ($j==0 || $table->status==1) ? 'style="display:none"':'' !!}>
    </div>
    {{-- <h2 style="    position: absolute;top: 2px;right: 10px;font-size: medium; ">N° Table : {{$table->num}}, max: {{$table->maxcapacite}}</h2> --}}
    <div id="table-wrapper" >

        @while($i < $table->maxcapacite )
            <div class="chair chair-{{$case}} {{ $table->status==1?'border border-danger':($j>0?'border border-success':'')}}"></div>
            @php $i++ @endphp
        @endwhile

        <div class="the{{$casetable}}-table {{$table->maxcapacite>6?'the-table-xl':''}} {{ ($j>0)?'bg-success':($table->status==1?'bg-danger':'')}}">
            @if ($j>0)
                <span class="text-light">Reservé</span>
            @elseif ($table->status==1)
                <span class="text-light">{{ $table->status==1?'Non active':''}} </span>
            @endif
        </div>

    </div>
</div>
      
 



    

                    
