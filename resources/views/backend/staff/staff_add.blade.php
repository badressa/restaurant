@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <h3>Personnels:</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display: contents;">ajouter un personnel</h4>
                <a style="float: right" href="{{ route('staff.view') }}"><i class="fa fa-reply" ></i></a>
            </div>
        

            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div>
                    <input type="hidden" name='type' value="admin" > 
                    <!-- admin select role  
                    <input type="hidden" name='role' value="admin" > --> 
                </div>

                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                               
                                <label for="basicInput">Nom</label>
                                <input  name="fname" type="text" class="form-control @error('fname') is-invalid @enderror" id="basicInput" placeholder="nom"  value="{{old('fname')}}">

                                @error('fname') 
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="form-group">
                               
                                <label for="basicInput">Preom</label>
                                <input  name="lname" type="text" class="form-control @error('lname') is-invalid @enderror" id="basicInput" placeholder="prenom"  value="{{old('lname')}}">

                            @error('lname') 
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                            </div>

                        
                         
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="basicInput" placeholder="email"  value="{{old('email')}}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hbt">date de naissance </label>
                                <input  name='hbt' type="date" class="form-control @error('hbt') is-invalid @enderror"  placeholder="hbt" value="{{old('hbt')}}">
                                @error('hbt')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <fieldset class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-select" id="role">
                                    <option value="" selected="" >Selectionner un role</option>
                                    <option >admin</option>
                                    <option >cuisiner</option>
                                    <option >serveur</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </fieldset>

                        </div>

                        <div class="col-md-6 mb-4">

                            <div class="form-group">
                                <label for="basicInput">mot de passe</label>
                                <input  name='password' type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="password" value="{{old('password')}}">
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">mot de passe confirmation</label>
                                <input  name='password_confirmation' type="password" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="password" value="{{old('password_confirmation')}}">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <fieldset class="form-group">
                                <label for="sexe">Sexe</label>
                                <select name="gender" class="form-select" id="sexe">
                                    <option value="" selected="" >Selectionner le sexe</option>
                                    <option value="h" {{ old('gender') == 'h' ? 'seleted' : '' }} >Homme</option>
                                    <option value="f" {{ old('gender') == 'f' ? 'seleted' : '' }}>Femme</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </fieldset>

                            <div class="form-group">
                                <label for="tel">Tel</label>
                                <input  name='tel' type="text" class="form-control @error('tel') is-invalid @enderror"  placeholder="tel" value="{{old('tel')}}">
                                @error('tel')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div> 
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-4 w-100 ">Submit</button>
                            </div>

                        </div>

       
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('déjà enregistré?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

</div>

@endsection