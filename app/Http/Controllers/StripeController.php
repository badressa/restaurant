<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Stripe;

class StripeController extends Controller
{
    public function index(){
        return view('stripe.index');
    }

    public function checkout(){
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // $customer = \Stripe\Customer::create(array(
        //     'name' => 'test',
        //     'description' => 'test description',
        //     'email' => 'email@gmail.com',
        //     'source' => $request->input('stripeToken'),
        //      "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]
  
        // ));
        //   try {
        //       \Stripe\Checkout\Session::create ( array (
        //               "amount" => 300 * 100,
        //               "currency" => "usd",
        //               "customer" =>  $customer["id"],
        //               "description" => "Test payment."
        //       ) );
        //       Session::flash ( 'success-message', 'Payment done successfully !' );
        //       return view ( 'cardForm' );
        //   } catch ( \Stripe\Error\Card $e ) {
        //       Session::flash ( 'fail-message', $e->get_message() );
        //   }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'MAD',
                        'product_data' =>[
                           'name' => 'myrest restaurant payement',
                        ],
                        'unit_amount' => 5000,
                    ],
                    'quantity' => 1,
                ],
                
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.payement'),
        ]);
        return redirect()->away($session->url);
    }
    public function success(){
        return view('stripe.index')->with('success', 'yes payement ' );
    }
    public function pay(Request $request){
        // $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));
    
            // $stripe->paymentIntents->create([
            //     'amount' => $request->amount*100, 
            //     'currency' => 'USD',
            //     'payment_method' => 'pm_card_visa',
            //     "source" => $request->stripeToken,
            //     "description" => "This is reservation payment",
            //      ]
            // );
            $errors = [];
            try {
                Stripe\Stripe::setApiKey(env('STRIPE_SK'));
                Stripe\Charge::create ([
                        "amount" => $request->amount*100,
                        "currency" => "MAD",
                        "source" => $request->stripeToken,
                        "description" => "This is test payment",
                ]);
                
              } catch(\Stripe\Exception\CardException $e) {
                // Since it's a decline, \Stripe\Exception\CardException will be caught
                response()->json($e->getError()->message) ;
              } catch (\Stripe\Exception\RateLimitException $e) {
                response()->json($e->getError()->message) ;
              } catch (\Stripe\Exception\InvalidRequestException $e) {
                response()->json($e->getError()->message) ;
                // Invalid parameters were supplied to Stripe's API
              } catch (\Stripe\Exception\AuthenticationException $e) {
                response()->json($e->getError()->message) ;
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
              } catch (\Stripe\Exception\ApiConnectionException $e) {
                response()->json($e->getError()->message) ;
                // Network communication with Stripe failed
              } catch (\Stripe\Exception\ApiErrorException $e) {
                response()->json($e->getError()->message) ;
                // Display a very generic error to the user, and maybe send
                // yourself an email
              } catch (Exception $e) {
                $errors[] = 'unknown problem';
                // Something else happened, completely unrelated to Stripe
              }
              if(!empty($errors)){
                return response()->json(['errors' => $errors,
                                     //'token' => $request->stripeToken,
                                     'amount'=> $request->amount,
                                     ]
                                    );
              }
              return response()->json(['success' => ' succès du payement ',
                                     //'token' => $request->stripeToken,
                                     'amount'=> $request->amount,
                                     ]
                                    );
           

    }
}
