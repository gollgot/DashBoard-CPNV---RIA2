<?php
namespace App\controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Yaml\Parser;

use Abraham\TwitterOAuth\TwitterOAuth;

class HomeController extends Controller {

    private $api_config;

    function __construct($container){
        parent::__construct($container);

        // This is a one pager, we will use a lot of credentials, so we load them from a config yaml file this way we can access them easily in all our function
        $yaml = new Parser();
        $parameters = $yaml->parse(file_get_contents("../app/config/parameters.yml"));
        $this->api_config = $parameters["parameters"]["api"];
    }


    public function ActionIndex(Request $request, Response $response){
        $fbPageLikes = $this->apiFacebookFetchPageLikes();
        $twitterPageFollowers = $this->apiTwitterFetchPageFollowers();
        $instagramPageSubscribers = $this->instagramHackFetchPageSubscribers();

        $totalCount = $fbPageLikes + $twitterPageFollowers + $instagramPageSubscribers;

        $this->render($response, "home/index.twig", [
            'totalCount' => $totalCount,
            'fbPageLikes' => $fbPageLikes,
            'twitterPageFollowers' => $twitterPageFollowers,
            'instagramPageSubscribers' => $instagramPageSubscribers,
        ]);
    }






    private function apiFacebookFetchPageLikes(){
        // fetch the facebook credentials configuration
        $config = $this->api_config["facebook"];

        $app_id = $config["app_id"];
        $app_secret = $config["app_secret"];
        $access_token = $config["access_token"];

        // Init our facebook object from the Facebook php SDK => https://github.com/facebook/php-graph-sdk
        $fb = new \Facebook\Facebook([
          'app_id' => $app_id,
          'app_secret' => $app_secret,
          'default_graph_version' => 'v2.10',
        ]);

        // Run our get request to fetch the number of likes for our cpnv page
        try {
          // Returns a `FacebookFacebookResponse` object
          $fbResponse = $fb->get(
            '/135906713123852?fields=fan_count',
            $access_token
          );
        } catch(FacebookExceptionsFacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $graphNode = $fbResponse->getGraphNode();

        return $graphNode["fan_count"];
    }

    private function apiTwitterFetchPageFollowers(){
        // fetch the facebook credentials configuration
        $config = $this->api_config["twitter"];

        // Ask for a new access token
        $oauth = new TwitterOAuth($config["consumer_key"], $config["consumer_secret"]);
        $accessToken = $oauth->oauth2("oauth2/token", ["grant_type" => "client_credentials"]);

        // Init our twitter obj with our access token generated previously, now we can launch API request
        $twitter = new TwitterOAuth($config["consumer_key"], $config["consumer_secret"], null, $accessToken->access_token);
        $cpnv = $twitter->get("users/show", ["screen_name" => "cpnv_ch"]);

        return $cpnv->followers_count;
    }

    private function instagramHackFetchPageSubscribers(){
        /* Instagram need an authorization from the target page to acces their PUBLIC data from the API ... Wtf ? So I found a little hack
           to access them. Found here : ->  https://stackoverflow.com/questions/11796349/instagram-how-to-get-my-user-id-from-username */
        $url = "https://www.instagram.com/cpnv.ch/?__a=1";

        $json = file_get_contents($url);
        $jsonObj = json_decode($json);

        return $jsonObj->user->followed_by->count;
    }

}