<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class StripeController extends Controller
{


    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin'); // if user is admin
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.donate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        //\Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $stripe = Stripe::make(config('services.stripe.secret'), '2020-03-02');
        // validation

        //the customer
        try {
            $customer = $stripe->customers()->create([
                'email' => $request->email,
                'name' => $request->cardholdername,
                'source' => $request->stripeToken,
                'description' => 'A customer that offer me a good beer',
                'address' => [
                    'line1' => $request->address,
                    'city' => $request->city,
                    'postal_code' => $request->postalcode,
                    'country' => $request->country,
                ]
            ]);

            //the charge
            $charge = $stripe->charges()->create([
                'amount' => 5,
                'currency' => 'eur',
                'customer' => $customer['id'],
                'description' => 'A good beer for you',
                'receipt_email' => $request->email,
            ]);

            // save this info to your database

            // SUCCESSFUL
            return back()->with('message.level', 'success')->with('message.content', 'Merci pour la rebié!');
        } catch (CardErrorException $e) {
            // save info to database for failed
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
