<?php

namespace App\Http\Controllers;

use App\Models\Quote_Requests;
use Paypalpayment;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;

    /**
     * Set the ClientId and the ClientSecret.
     * @param
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId='AVJx0RArQzkCCsWC0evZi1SsoO4gxjDkkULQBdmPNBZT4fc14AROUq-etMEY';
    private $_ClientSecret='EH5F0BAxqonVnP8M4a0c6ezUHq-UT-CWfGciPNQOdUlTpWPkNyuS6eDN-tpA';

    /*
     *   These construct set the SDK configuration dynamiclly,
     *   If you want to pick your configuration from the sdk_config.ini file
     *   make sure to update you configuration there then grape the credentials using this code :
     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct()
    {

        // ### Api Context
        // Pass in a `ApiContext` object to authenticate
        // the call. You can also send a unique request id
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly.

        $this->_apiContext = Paypalpayment::apiContext(config('paypal_payment.Account.ClientId'),

                                                        config('paypal_payment.Account.ClientSecret'));

    }

    /*
        Use this call to get a list of payments.
        url:payment/
    */
    public function index()
    {
        echo "<pre>";

        $payments = Paypalpayment::getAll(array('count' => 1, 'start_index' => 0), $this->_apiContext);

        dd($payments);
    }

    /*
        Use this call to get details about payments that have not completed,
        such as payments that are created and approved, or if a payment has failed.
        url:payment/PAY-3B7201824D767003LKHZSVOA
    */

    public function show()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            $token = $_GET['paymentId'];

            $payment = Paypalpayment::getById($token, $this->_apiContext);

            dd($payment);

        }

    }

    /*
    * Display form to process payment using credit card
    */
    public function store()
    {

        $getid = Events::select('EventID')->get();

        if(!$getid->isEmpty()){

            $getid = Events::select('EventID')->orderBy('EventID', 'desc')->first()->get();

            foreach ($getid as $key) {

                $id = ((int)$key->EventID) + 1;

            }

        }
        else {

            $id = 1;

        }

        $result = Request::all();

        $quoteID = $result['quoteid'];
        $eventType = $result['eventType'];
        $downpayment = $result['downpayment'];
        $userID = Auth::user()->id;
        $addedDate = date('Y-m-d H:i:s');

        try {
            /*
             * Insert the new Quote to Database Table 'quote_requests'
             */
            $events = new Events;

            $events->EventID = $id;
            $events->QuoteID = $quoteID;
            $events->UserID = $userID;
            $events->EventType = $eventType;
            $events->AddedDate = $addedDate;

            $events->save();

            Quote_Requests::where('id', $quoteID)
                ->update(['Status' => 'Paid']);

        } catch (QueryException $e) {

        }

        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $addr= Paypalpayment::address();
        $addr->setLine1("22/1, Nagavihara Road");
        $addr->setLine2("Pitakotte");
        $addr->setCity("Pitakotte");
        $addr->setState("");
        $addr->setPostalCode("10100");
        $addr->setCountryCode("SL");
        $addr->setPhone("0094773685526");

        // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType("visa")
            ->setNumber("4758411877817150")
            ->setExpireMonth("05")
            ->setExpireYear("2019")
            ->setCvv2("456")
            ->setFirstName("Hasitha")
            ->setLastName("Jayasinghe");

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Quote ID: ' . $quoteID) // item name
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($downpayment); // unit price


        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($downpayment);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'


        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment-status')) // Specify return URL
        ->setCancelUrl(URL::route('payment-status'));

        $payment = new Payment();
        $payment->setIntent('order')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create($this->_apiContext);
        } catch (\PPConnectionException $ex) {
            return  "Exception: " . $ex->getMessage() . PHP_EOL;
            exit(1);
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect::route('original-route')
            ->with('error', 'Unknown error occurred');

        dd($payment);
    }
}