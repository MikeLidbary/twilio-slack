<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model {

	/**
	 * post message to slack webhook
	 *
	 * @param $message
	 *
	 * @return mixed
	 */
	public function postMessage( $message ) {
		$client = new Client([
			'headers' => ['Content-Type' => 'application/json']
		]);
		$response = $client->post(env( 'SLACK_WEBHOOK_URL' ),
			['body' => $message]
		);

		$data   = json_decode( $response->getBody()->getContents() );
		return $data;
	}

	public function forwardMessage(){

	}
}
