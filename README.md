# Classy API v2
Easily access the Classy API using PHP.

## Secret Key Protection
Try to be a little more secure the secret key is imported from a different file,
be sure to create a secret key based off the sample and add it to your `.gitignore`.

[hr]

# Set Up
Download the files
You will need composer installed. Once composer installed, run `php composer.phar install`.
**THANK YOU** https://github.com/factor1/classy <-- this is where the initial set up comes from.

# Getting Data
From my initial tries via [@erwstout](https://github.com/erwstout) examples, it was great but I think Classy's API is slow. So what I ended up doing was creating a cron that runs at whatever cadence you want (I run ours every hour) and it creates json files for the data we need.I find that this is faster than pulling the data directly from Classy's API.  If you still want to get the data in real time, you can totally do so, but I found this way to be easier and faster.


# CRON
The cron.php file contains some api calls for various values. 
getCampaigns, getCampaignActivityByID, getCampaignByID, getLeadersByCampaign - Each one will create it's own individual file based on how many times you call them for different category ID's.
~~~~
CreateJsonFile('getCampaigns',$accessToken, $client, $account_id);
CreateJsonFile('getCampaignByID',$accessToken, $client, $campain_id);
CreateJsonFile('getCampaignActivityByID',$accessToken, $client, $campain_id);
CreateJsonFile('getLeadersByCampaign',$accessToken, $client, $campain_id);
~~~~

#API Test
This file contains a quick jquery call to grab the json result set and push the code on the page.
