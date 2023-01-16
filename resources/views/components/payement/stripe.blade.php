<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Formulaires de paiement</h1>
        </div>
    </div> 
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p><br>
        </div>
    @endif
    <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fa fa-credit-card mr-2"></i> Numéro de carte</a> </li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">

                            <input type="hidden" name="payment_method" id="payment_method">
                            {{-- <form action="{{ route('order.pay') }}" method="post" role="form">
                                @csrf --}}
                            {{-- <form action="{{ route('order.pay') }}" role="form" onsubmit="event.preventDefault()"> --}}
                                <div class="form-group"> 
                                    <label for="username">
                                        <h6>Propriétaire</h6>
                                    </label> 
                                    <input type="text" name="username" placeholder="Nom du titulaire de la carte" required class="form-control username"> 
                                </div>
                                
                                <div class="form-group"> 
                                    <label for="cardNumber">
                                        <h6>Numéro de carte</h6>
                                    </label>
                                    <div class="input-group"> 
                                        <input autocomplete='off' type="text" name="card-number" placeholder="Numéro de carte valide" class="form-control card-number" required>

                                        <div class="input-group-append"> 
                                            <span class="input-group-text text-muted"> 
                                                <i class="fa fa-cc-visa mx-1"></i> <i class="fa fa-cc-mastercard mx-1"></i> <i class="fa fa-cc-amex mx-1"></i> 
                                            </span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> 
                                            <label>
                                                <span class="hidden-xs">
                                                        <h6> Date d'expiration</h6>
                                                </span>
                                            </label>
                                            <div class="input-group"> 
                                                <input name='card-expiry-month'  type="number" placeholder="MM" class="form-control card-expiry-month" required> 
                                                 <input name='card-expiry-year' type="number" placeholder="YYYY" class="form-contro card-expiry-year" required>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> 
                                                <input  name='card-cvc' type="text" required class="form-control card-cvc"> 
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> 
                                            <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>Prix</h6>
                                            </label> 
                                            <input name='amount' required class="form-control amount"  value="{{$totalPrice!=null?$totalPrice:'00'}} Dhs" readonly> </div>
                                    </div>
                                </div>
        

                                <div class="card-footer">
                                     <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                            {{-- </form> --}}
                                </div>
                        </div>
                    </div> <!-- End -->
                
                    
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>

</div>







   
         
                
                
                {{-- <form role="form" action="{{ route('yami.reservation.store') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PK') }}" id="payment-form">
                   @csrf
                   <div class='form-row row'>
                      <div class='col-xs-12 col-md-6 form-group required'>
                         <label class='control-label'>Name on Card</label> 
                         <input class='form-control' size='4' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-6 form-group required'>
                         <label class='control-label'>Card Number</label> 
                         <input autocomplete='off' class=' card-number' name='card-number' size='20' type='text'>
                      </div>                           
                   </div>                        
                   <div class='form-row row'>
                      <div class='col-xs-12 col-md-4 form-group cvc required'>
                         <label class='control-label'>CVC</label> 
                         <input autocomplete='off'  placeholder='ex. 311' size='4' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                         <label class='control-label'>Expiration Month</label> 
                         <inputplaceholder='MM' size='2' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                         <label class='control-label'>Expiration Year</label> 
                         <input  placeholder='YYYY' size='4' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                         <label class='control-label'>Amount</label> 
                         <input   placeholder='00.00 Dhs'  type='number'>
                     </div>
                   </div>                     
                   <div class="form-row row">
                      <div class="col-xs-12">
                         <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                      </div>
                   </div>
                </form>
              --}}

