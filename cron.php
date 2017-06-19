<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('classy.php');
$account_id = 'XXXXXXXXX';
$campain_id = 'XXXXXXXXX';
// one function that can render the json files we need.
// why create json files and not just use the live results? because our way its faster loading.
function CreateJsonFile($type,$accessToken, $client, $id)
{
    // get the type to determine what api url is needed
    switch ($type) {
        case "getCampaigns":
            $apiurl = 'https://api.classy.org/2.0/organizations/'.$id.'/campaigns';
            $jsonfile = 'getCampaigns';
            break;
        case "getCampaignActivityByID":
            $apiurl = 'https://api.classy.org/2.0/campaigns/'.$id.'/activity';
            $jsonfile = 'activity-'.$id;
            break;
        case "getCampaignByID":
            $apiurl = 'https://api.classy.org/2.0/campaigns/'.$id;
            $jsonfile = $id;
            break;
        case "getLeadersByCampaign":
            $apiurl = 'https://api.classy.org/2.0/campaigns/'.$id.'/fundraising-pages?aggregates=true&sort=total_raised:desc&per_page=10';
            $jsonfile = 'leaders-'.$id;
            break;
        default:
            $apiurl = 'https://api.classy.org/2.0/organizations/'.$id.'/campaigns';
            $jsonfile = 'getCampaigns';
    }
    
    $response = $client->request(
      'GET',
      ''.$apiurl.'',
      [
          'headers' => [
              'Authorization' => "Bearer $accessToken"
          ]
      ]
    );
    
    $filename   = '/absolute/location/to/create/json/file/named/'.$jsonfile.'.json';
    $filecontent    = $response->getBody();
    $myfile         = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, $response->getBody() );
    fclose($myfile);
}

# GETS ALL THE CAMPAIGNS AND SAVE THEM IN JSON FORMAT
CreateJsonFile('getCampaigns',$accessToken, $client, $account_id);
CreateJsonFile('getCampaignByID',$accessToken, $client, $campain_id);
CreateJsonFile('getCampaignActivityByID',$accessToken, $client, $campain_id);
CreateJsonFile('getLeadersByCampaign',$accessToken, $client, $campain_id);
?>