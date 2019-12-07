<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Auth extends CI_Controller {

		/*
			Author 	: Betuah Anugerah
			Email 	: betuahanugerah@gmail.com
		*/

		// Setup your Google OAuth setting Here
		private $client_id 			= '939591270256-49hu6f9bb4ulcvadjemputtkiem7fuoq.apps.googleusercontent.com';
        private $client_secret 		= '1ZKG5Som4oDY_4C--Zas0kvU';
        private $simple_api_key 	= 'AIzaSyB5DJARg6frkjwMk-FHa3oa0i6Wwp1_OTs';

		public function __construct() {
			parent::__construct();
		}

		public function manual_login() {
			
			$this->load->view('auth/login');
		}

		function is_connected() {
			$connected = @fsockopen("www.google.com", 443); 
	
			if ($connected){
				$is_conn = TRUE; 
				fclose($connected);
			}else{
				$is_conn = FALSE; 
			}
			echo $is_conn;
		}

		public function index(){
			// If user dont have token will be redirect to login form
			if (isset($_SESSION['token']) && $_SESSION['token']) {
				
				$jwt_data = AUTHORIZATION::validateToken($_SESSION['token']);

				if ($jwt_data != false) {

					$data = array (
						'pic_google' 			=> $jwt_data->pic
					);

					$this->m_crud->set_data('tb_peg', 'id_peg', $jwt_data->id_user, $data);

					$res = $this->m_crud->get_where('v_pegawai', array('id_user' => $jwt_data->id_user));

					if ($res->num_rows() > 0) {
						foreach ($res->result() as $datas) {		
							$pic 					= $datas->pic != null || $datas->pic != '' ? $datas->pic : $jwt_data->pic;
							$data['id_user'] 		= $jwt_data->id_user;
							$data['full_name'] 		= $jwt_data->full_name;
							$data['email'] 			= $jwt_data->email;
							$data['pic'] 			= $pic;
				
							$this->load->view('apps/app', $data);
						}
					}
				}
	
			} else {
				if (isset($_GET['code'])) {
					$this->google_oauth();
				} else if (isset($_SESSION['status']) && $this->session->status === '1') {
					$data['div'] 	= $this->m_crud->get_all('tb_divisi');
					$data['detail']	= $this->session->userdata;

					$this->load->view('auth/verify', $data);
					session_destroy();
				} else {
					if (isset($_SESSION['alert'])) {
						$data['alert'] = $this->session->alert;
						$this->load->view('auth/portal', $data);
						// $this->load->view('auth/login', $data);
						session_destroy();
					} else {
						$this->load->view('auth/portal');
					}
				}
			}
		}

		// Static login (login without SSO / Manual Login)
		public function login() {
			$res_mail = $this->m_crud->get_where('v_pegawai', array('email' => $this->input->post('email')));

			if ($res_mail->num_rows() > 0) {
				foreach ($res_mail->result() as $peg) {
					$id_peg = $peg->id_peg;
				}

				$data = array(
					'email' => $this->input->post('email')
				);

				$res = $this->m_crud->get_where('tb_user', $data);

				if ($res->num_rows() > 0) {

					foreach ($res_mail->result() as $data) {	

						if ($data->password != null || $data->password != '') {
							$LPass 	= $this->input->post('pass');
							$pass 	= $this->encryption->decrypt($data->password);

							if ($LPass === $pass) {
								$path 	= $data->jekel === 'Female' ? base_url('assets/img/profile/avatar2.png') : base_url('assets/img/profile/avatar4.png');
								$pic 	= $data->pic == '' || $data->pic == null ? (($data->pic_google == '' || $data->pic_google == null) ? $path : $data->pic_google) : $data->pic;
								
								$tokenData = array(
									'id_user'    	=> $data->id_user,
									'id_peg' 		=> $id_peg,
									'id_akses'		=> $this->encryption->encrypt($data->id_akses),
									'full_name'  	=> $data->nama,
									'id_div' 		=> $data->id_div,
									'email'     	=> $data->email,
									'pic'			=> $pic,
								);

								$token = AUTHORIZATION::generateToken($tokenData);

								$Data = array(
									'token'			=> $token,
									'bahasa'		=> $data->bahasa
								);
				
								$this->session->set_userdata($Data);

								echo json_encode(1);
							} else {
								echo json_encode(0);
							}
						} else {
							echo json_encode(3);
						}
					}
				} else {
					echo json_encode(2);
				}
			} else {
				echo json_encode(2);
			}
		}

		// Reset Password
		public function reset_password() {
			echo "sukses";
		}

		// For Verifying Data Email
		public function verify() {
			$nik = $this->input->post('nik');

			$res = $this->m_crud->get_where('tb_user', array('nik' => $nik));

			if ($res->num_rows() === 0 || $res->num_rows() === '0') {
				$user = array(
					'nik' 		=> $nik,
					'email' 	=> $this->input->post('email'),
					'id_div' 	=> $this->input->post('divisi'),
					'id_akses' 	=> 5,
					'status' 	=> 2
				);
	
				$peg = array(
					'nama' 		=> $this->input->post('name'),
					'jekel' 	=> $this->input->post('gender'),
					'nik_peg'	=> $nik
				);

				$res = $this->m_crud->create_trans('tb_user','tb_peg',$user, $peg);

				if ($res === FALSE) {
					$msgs = array('code'=>500,'msg'=>'Error Submit Data!');
					echo json_encode($msgs, JSON_PRETTY_PRINT);
				} else {
					$msgs = array('code'=>200,'msg'=>'Success Submit Data!');
					echo json_encode($msgs, JSON_PRETTY_PRINT);
				}
			} else {
				$msgs = array('code' => 409, 'msg' => 'Your NIK already exist!');
				echo json_encode($msgs, JSON_PRETTY_PRINT);
			}
		}

		public function g_auth_config() {
			// Include google-php-client library in controller
			include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
			include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

			// Store values in variables from project created in Google Developer Console
			$client_id 		= $this->client_id;
			$client_secret 	= $this->client_secret;
			$redirect_uri 	= 'http://demohr.seameo-recfon.org';
			$simple_api_key = $this->simple_api_key;
	
			// Create Client Request to access Google API
			$client = new Google_Client();
			$client->setApplicationName("PHP Google OAuth Login Example");
			$client->setClientId($client_id);
			$client->setClientSecret($client_secret);
			$client->setRedirectUri($redirect_uri);
			$client->setDeveloperKey($simple_api_key);
			$client->setAccessToken($this->session->g_token);

			return $client;
		}

		// For Delete All session
		public function logout() {

			if (isset($_SESSION['g_token']) && $_SESSION['g_token']) {
				// $this->g_auth_config()->setAccessToken($this->session->g_token);
				$this->g_auth_config()->revokeToken();
			}

			unset($_SESSION['g_token']);
			unset($_SESSION['token']);
			unset($_SESSION['bahasa']);
			session_destroy();
			
			header('Location: http://demohr.seameo-recfon.org');
		}
	
		// Google OAuth
		public function google_oauth() {

			// Include google-php-client library in controller
			include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
			include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";
	
			// Store values in variables from project created in Google Developer Console
			$client_id 		= $this->client_id;
			$client_secret 	= $this->client_secret;
			$redirect_uri 	= 'http://demohr.seameo-recfon.org';
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
			$client->setIncludeGrantedScopes(true);
	
			// Send Client Request
			$objOAuthService = new Google_Service_Oauth2($client);

			// Add Google Token to Session
			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$this->session->g_token = $client->getAccessToken();
				// header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
			}
	
			// Set Google Token to make Request and Get User Data and store to userdata session
			if (isset($_SESSION['g_token']) && $_SESSION['g_token']) {
				$client->setAccessToken($this->session->g_token);

				$tmp_GData = $objOAuthService->userinfo->get();
				$_SESSION['g_token'] = $client->getAccessToken();

				$res = $this->m_crud->get_where('v_pegawai', array('email' => $tmp_GData->email));

				if ($res->num_rows() > 0) {
					foreach ($res->result() as $data) {		
						
						if ($data->status === '2') {
							$this->session->alert = "Sorry your account with email <b>". $data->email ."</b> have not been activated. Please contact your Administrator for Activated your account.";
							header('Location: ' . $redirect_uri);
						} else {
							$tokenData = array(
								'id_user'    		=> $data->id_user,
								'id_peg' 			=> $data->id_peg,
								'id_akses'			=> $this->encryption->encrypt($data->id_akses),
								'full_name'  		=> $data->nama,
								'email'     		=> $data->email,
								'pic'				=> $tmp_GData->picture,
							);

							$token = AUTHORIZATION::generateToken($tokenData);

							$Data = array(
								'token'			=> $token,
								'bahasa'		=> $data->bahasa
							);
			
							$this->session->set_userdata($Data);
							header('Location: ' . $redirect_uri);
							
						}
					}
				} else {
					$email 		= explode("@",$tmp_GData->email);
					$domain 	= $email[1];

					if($domain === 'seameo-recfon.org') {
						$this->session->alert = "Sorry your account is not registered to the system.<br> Please contact your Administrator for registering your google suites account to the system.";
						$this->g_auth_config()->revokeToken();

						header('Location: ' . $redirect_uri);
					} else {
						$this->session->alert = 'Sorry just for <b class="text-dark">SEAMEO RECFON Google Suites</b> Access.<br> Please contact the Administrator.';
						$this->g_auth_config()->revokeToken();

						header('Location: ' . $redirect_uri);
					}
				}
			} else {
				// If not log in redirect to google login url
				$authUrl = $client->createAuthUrl();
				$data['authUrl'] = $authUrl;
				header('Location:' .$data['authUrl']);
			}
		}
	
}