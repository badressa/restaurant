@php
$route = Route::current()->getName();
@endphp
<!-- Start header -->
<header class="top-navbar" style="z-index:12;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="{{ asset('frontend/yami/images/logo.png') }}" alt="" style="width:4em;"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ ($route == 'yami.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('yami.index') }}">Accueil</a></li>
                    <li class="nav-item {{ ($route == 'yami.menu') ? 'active' : '' }}"><a class="nav-link" href="{{ route('yami.menu') }}">Menu</a></li>
                    <li class="nav-item {{ ($route == 'yami.about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('yami.about') }}">A propos</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Autres </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item {{ ($route == 'yami.reservation') ? 'active' : '' }}" href="{{ route('yami.reservation') }}">Reservation</a>
                            <a class="dropdown-item" href="{{-- route('yami.staff') --}}">Staff</a>
                            <a class="dropdown-item" href="{{-- route('yami.gallery') --}}">Gallery</a>
                        </div>
                    </li>
                    <li class="nav-item {{ ($route == 'yami.contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('yami.contact') }}">Contacter</a></li>
                    <li class="nav-item {{ ($route == 'yami.panier') ? 'active' : '' }}"><a class="nav-link" id="panier" href="{{ route('yami.panier') }}"><i class="fa fa-shopping-cart"></i> panier 
                        <span class="badge badge-light" style="background: white;">@if(@isset($item))   {{$item ==null ? 0 : $item }}   @else  0 @endif</span>
                        </a>
                    </li>
                    @if(auth()->check())
                        <li class="nav-item ">
                            <div  style="    background: white;
                            border-radius: 10px;
                            width: 51px;
                            height: 39px;">
                               {{auth()->user()->name}}
                           </div>
                           <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" href="{{ route('logout') }}">deconnecter</a>
                        
                            </form>
                           
                        </li>
                    @else 
                        <li class="nav-item dropdown">
                            
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-b" data-toggle="dropdown"><i class="fa fa-sign-in" aria-hidden="true"></i> </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a" style="left: -120px;">
                                <a class="dropdown-item {{ ($route == 'yami.reservation') ? 'active' : '' }}" href="{{ route('login') }}">Connecter</a>
                                <a class="dropdown-item" href="{{ route('register') }}">Inscrire</a>
                                
                            </div>
                        </li>
                    @endif
                    
                </ul>
            </div>
        </div>
    </nav>
</header>
<style>
    #dropdown-b::after{
        display: none;
    }
    /* #dropdown-b:hover{
        background-color: inherit;
    } */
</style>
<!-- End header -->