<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_YouTubeService.php';

class YoububeSubscribApp {

    private $client;
    private $youtube;

    public function __construct() {
        /* You can acquire an OAuth 2 ID/secret pair from the API Access tab on the Google APIs Console
          <http://code.google.com/apis/console#access>
          For more information about using OAuth2 to access Google APIs, please visit:
          <https://developers.google.com/accounts/docs/OAuth2>
          Please ensure that you have enabled the YouTube Data API for your project. */
        $OAUTH2_CLIENT_ID = '238026065251-o8hnbmk36p3ru2h64t47a6jjp8qt5tkh.apps.googleusercontent.com';
        $OAUTH2_CLIENT_SECRET = '4PqSPyuQFH0Jj3cqzD-XQX6A';

        $this->client = new Google_Client();
        $this->client->setClientId($OAUTH2_CLIENT_ID);
        $this->client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . '/ytsub.php', FILTER_SANITIZE_URL);
        $this->client->setRedirectUri($redirect);

        // YouTube object used to make all API requests.
        $this->youtube = new Google_YoutubeService($this->client);
    }

    public function getAuthToken() {
        if (isset($_GET['code'])) {
            if (strval($_SESSION['state']) !== strval($_GET['state'])) {
                die('The session state did not match.');
            }

            $this->client->authenticate();
            $_SESSION['token'] = $this->client->getAccessToken();
        }
    }

    public function setToken() {
        if (isset($_SESSION['token'])) {
            $this->client->setAccessToken($_SESSION['token']);
            return true;
        } else {
            return false;
        }
    }

    public function isVaildTokenOrNot() {
        // Check if access token successfully acquired
        //$this->client->setAccessToken($_SESSION['token']);
        //$this->setToken();

        if ($this->client->getAccessToken()) {
        //if (isset($_SESSION["token"])) {
            return true;
        } else {
            // If the user hasn't authorized the app, initiate the OAuth flow
            $state = mt_rand();
            $this->client->setState($state);
            $_SESSION['state'] = $state;

            $authUrl = $this->client->createAuthUrl();
            $htmlBody = "<h3>Authorization Required</h3><p>You need to <a href=\"" . $authUrl . "\">authorize access</a> before proceeding.<p>";
            return $htmlBody;
        }
    }

    public function subscribChannel($username) {
        try {
            // Subscribe to a channel
            // Create a resource id with channel id and kind.
            // List Channels for the user
            $channels = $this->youtube->channels->listChannels('snippet', array("forUsername" => $username));
            if (empty($channels) || !isset($channels['items'])) {
                return "Not Subscribed!";
            }

            $channelId = $channels['items'][0]['id'];

            $resourceId = new Google_ResourceId();
            $resourceId->setChannelId($channelId);
            $resourceId->setKind('youtube#channel');

            // Create a snippet with resource id.
            $subscriptionSnippet = new Google_SubscriptionSnippet();
            $subscriptionSnippet->setResourceId($resourceId);

            // Create a subscription request with snippet.
            $subscription = new Google_Subscription();
            $subscription->setSnippet($subscriptionSnippet);

            // Execute the request and return an object containing information about the new subscription
            $subscriptionResponse = $this->youtube->subscriptions->insert('id,snippet', $subscription, array());

            $htmlBody = "<h3>Subscription</h3><ul>";
            $htmlBody .= sprintf('<li>%s (%s)</li>', $subscriptionResponse['snippet']['title'], $subscriptionResponse['id']);
            $htmlBody .= '</ul>';
        } catch (Google_ServiceException $e) {
            $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
            return $htmlBody;
        } catch (Google_Exception $e) {
            $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
            return $htmlBody;
        }

        $_SESSION['token'] = $this->client->getAccessToken();

        return true;
    }

    public function setHitNum($user) {
        mysql_query("UPDATE `users` SET `hitsbeforeref`=`hitsbeforeref`+1  WHERE `id`='{$user->id}'");
    }

    public function checkSubState($user, $site_id, $site_user) {
        $result = array();
        $siteliked4[] = -1;
        $siteliked2 = mysql_query("SELECT * FROM `ytsubed` WHERE (`user_id`='{$user->id}') ");
        for ($j = 0; $siteliked = mysql_fetch_object($siteliked2); $j++) {
            $siteliked4[] = $siteliked->site_id;
        }

        $site = mysql_query("SELECT * FROM `ytsub` WHERE (`id`='{$site_id}' AND `user`='{$site_user}') AND `id` NOT IN  (" . implode(',', $siteliked4) . ")  ");

        $result['rownum'] = mysql_num_rows($site);
        $result['res'] = mysql_fetch_object($site);

        return $result;
    }

    public function addSubData($site, $user, $referralrate) {
        $coinsadded = -1 + $site->cpc;
        mysql_query("INSERT INTO `ytsubed` (user_id, site_id) VALUES('{$user->id}','{$site->id}')");
        mysql_query("UPDATE `ytsub` SET `likes`=`likes`+'1', `points`=`points`-'{$site->cpc}' WHERE `id`='{$site->id}'");
        mysql_query("UPDATE `users` SET `coins`=`coins`+'{$coinsadded}', `hitstoday`=`hitstoday`+1, `likes`=`likes`+'1'  WHERE `id`='{$user->id}'");

        /*if ($site->top > 1) {
            if ($likesnumnum > $site->top) {
                mysql_query("UPDATE `ytsub` SET `active`='1' WHERE `id`='{$site->id}'");
            }
        }*/

        if ($user->ref2 >= 1) {
            mysql_query("UPDATE `users` SET `refgive`=`refgive`+'{$site->cpc}'-1 `totalgive`=`totalgive`+'{$site->cpc}'-1 WHERE `id`='{$user->id}'");
			$refaddnoww = $user->refgive / $referralrate;
            if ($refaddnoww >= 1) {
                mysql_query("UPDATE `users` SET `refgive`=`refgive`-'{$user->refgive}' WHERE `id`='{$user->id}'");
				mysql_query("UPDATE `users` SET `coins`=`coins`+'{$refaddnoww}', `beforeref`=`coins`  WHERE `id`='{$user->ref2}'");
            }
        }
		
		$mmillesecc = microtime(true);
		mysql_query("INSERT INTO `last_hits` (user_name, site_name, site_type, time) VALUES('{$user->login}', '{$site->title}', 'ytl', '{$mmillesecc}' )");

        mysql_query("UPDATE `stat` SET `stat`=`stat`+1 WHERE (`id`='21' or `id`='15')");
    }
}

$youbuteSub = new YoububeSubscribApp();
?>