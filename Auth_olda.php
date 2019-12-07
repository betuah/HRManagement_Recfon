<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	// Include google-php-client library in controller
	require APPPATH . "/libraries/google-api-php-client-master/src/Google/Client.php";
	require APPPATH . "/libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

	class Auth extends CI_Controller {

		/*
			Author 	: Betuah Anugerah
			Email 	: betuahanugerah@gmail.com
		*/

		// Setup your Google OAuth setting Here
		private $client_id 			= '1005530415845-kh36a2o43d7rjfnimpi5kqjfhha5omb0.apps.googleusercontent.com';
        private $client_secret 		= 'RtEl0CPtd1CiCJku7PTcu87-';
		private $simple_api_key 	= 'AIzaSyBIf4RaWWD4vUEVymgRqzBkGSf_kMx6sds';
		private $auth_url 			= 'http://demo3.seamolec.org';

		public function __construct() {
			parent::__construct();
		}

		public function index() {
			// if(isset($_GET['code'])) {
			// 	$this->google_oauth_settings()->authenticate($_GET['code']);
			// 	$this->session->g_token = $this->google_oauth_settings()->getAccessToken();
			// 	// if (isset($_SESSION['g_token']) && $_SESSION['g_token']) {
			// 		// $this->google_oauth_settings()->($_SESSION['g_token']);
			// 	// 	print_r($this->session->g_token);
			// 	// }
				
			// 	// header('Location: ' . filter_var($this->auth_url, FILTER_SANITIZE_URL));
			// 	// print_r($this->session->g_token);
			// }

			if (isset($_SESSION['g_token']) && $_SESSION['g_token']) {
				// $this->google_oauth_settings()->setAccessToken($_SESSION['g_token']);
				// $_SESSION['g_token'] = $this->google_oauth_settings()->getAccessToken();

				// $objOAuthService = new Google_Service_Oauth2($client);
				// $tmp_GData = $objOAuthService->userinfo->get();
				echo "ada ".$this->session->g_token;
				// print_r($tmp_GData);
			} else {
				if(isset($_GET['code'])) {

					$token = $this->google_oauth_settings()->authenticate($_GET['code']);
					print_r($token);
					// $this->session->g_token = $token;
					$this->session->g_token = $this->google_oauth_settings()->getAccessToken();
					print_r('token : '.$this->session->g_token);
					// $this->google_oauth_settings()->setAccessToken($auth);
					// $_SESSION['g_token'] = $this->google_oauth_settings()->getAccessToken();
					// $this->session->g_token = 'sempak';
					
					// if (isset($_SESSION['g_token']) && $_SESSION['g_token']) {
					// 	$this->google_oauth_settings()->setAccessToken($_SESSION['g_token']);
					// // 	print_r($this->session->g_token);
					// } else {
					// 	$this->google_oauth_settings()->authenticate($_GET['code']);
					// 	$this->session->g_token = $this->google_oauth_settings()->getAccessToken();
						// header('Location: ' . filter_var($this->auth_url, FILTER_SANITIZE_URL));
					// }
					// $asd = json_decode( $auth, true);
					
					// print_r();
					// echo "<br>";
					// print_r($this->google_oauth_settings()->getAccessToken());
				} else {
					// If not log in redirect to google login url
					$auth_url = $this->google_oauth_settings()->createAuthUrl();
					header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
				}
			}
		}
	
		public function google_oauth_settings () {
			// Store values in variables from project created in Google Developer Console
			$client_id 		= $this->client_id;
			$client_secret 	= $this->client_secret;
			$redirect_uri 	= 'http://demo3.seamolec.org';
			$simple_api_key = $this->simple_api_key;
	
			// Create Client Request to access Google API
			$client = new Google_Client();
			$client->setApplicationName("PHP Google OAuth Login Example");
			$client->setClientId($client_id);
			$client->setClientSecret($client_secret);
			$client->setRedirectUri($redirect_uri);
			$client->setDeveloperKey($simple_api_key);
			$client->setScopes(array(
			"https://www.googleapis.com/auth/plus.login",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile",
			"https://www.googleapis.com/auth/plus.me"
			));
			// $client->setAccessType('offline');        // offline access
			// $client->setIncludeGrantedScopes(true);   // incremental auth

			return $client;
		}
}