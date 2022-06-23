<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;



class PaymentController extends Controller
{
    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct()
    {
        if( config("paypal.settings.mode") == "live") {
            $this->clientId = config("paypal.live_client_id");
            $this->secret = config("paypal.live_client_id");
        } else {
            $this->clientId = config("paypal.sandbox_client_id");
            $this->secret = config("paypal.sandbox_secret");
        }


        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId,$this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));


    }

    public function payWithPaypal(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');

        // set payer

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");


        $item = new Item();
        $item->setName($name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setDescription("Buying From Kemobyte Shop item dsecription")
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems(array($item));

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Buying From Kemobyte Shop");
    
        
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/done")
            ->setCancelUrl("http://localhost:8000/canceled");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            dd($ex);
        }

        $approvalUrl = $payment->getApprovalLink();

        return redirect($approvalUrl);
    }
        public function status()
        {
            
        }
        public function canceled()
        {
            return 'payment canceled';
        }
}
