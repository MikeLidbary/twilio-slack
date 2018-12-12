<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Webhook;
use Twilio\Twiml;

class WebhookController extends Controller
{
	/**
	 * post message to the slack channel
	 */
    public function index(){

    	$message="How do I make a comment on the blog?";
    	$webhook=new Webhook();
    	$data=json_encode(['text'=>$message]);
    	echo $webhook->postMessage($data);
    }

	/**
	 * The slack webhook
	 *
	 * @return $this
	 */
    public function forward(){
	    $sms_body=$_REQUEST['Body'];
	    $from=$_REQUEST['From'];
	    $full="From: ".$from." SMS: ".$sms_body;
	    $webhook=new Webhook();
	    $data=json_encode(['text'=>$full]);
	    $webhook->postMessage($data);
	    $response = new Twiml;
	    $response->message($full);
	    return response($response, 200)
		    ->header('Content-Type', 'application/xml');
    }
}
