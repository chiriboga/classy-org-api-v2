<?php
/*
 * @Package: Classy
 * @Author: Eric Stout (factor1)
 * @Version: 0.0.1
 *
 */

// Assumes Guzzle added through Composer,
// @link http://getcomposer.org
// @link http://guzzlephp.org

require_once('vendor/autoload.php');
require_once('secret.php');

// Substitute w/ your own values.  PROTECT YOUR SECRET.  Do not put in public repo!
$clientId = 'UlLPejurQ4ulTl27';
$clientSecret = $secret;

$client = new GuzzleHttp\Client();

try {
    // Use credentials to receive access token
    $response = $client->request(
        'POST',
        'https://api.classy.org/oauth2/auth',
        [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret
            ]
        ]
    );

    $result = json_decode($response->getBody(), true);
    $accessToken = $result['access_token'];

} catch (Exception $ex) {

    // Handle ...
    echo $ex->getMessage() . "\n";
}

// Now use that token to make all subsequent requests
// Fetch a campaign
function getCampaign($accessToken, $client, $id){
  $response = $client->request(
      'GET',
      'https://api.classy.org/2.0/campaigns/'.$id,
      [
          'headers' => [
              'Authorization' => "Bearer $accessToken"
          ]
      ]
  );

  echo $response->getBody();
}

getCampaign($accessToken,$client,91466);
