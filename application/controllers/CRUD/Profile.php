<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Profile extends CI_Controller {

		public function __construct() {
			parent::__construct();
		}
        
        public function update_personal(){
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $tbl 	= 'tb_peg';
                    $req    = 'id_user';
                    $id     = $decodedToken->id_user;

                    $data = array (
                        'nik_peg' 		=> $this->input->post('nik'),
                        'nama'			=> $this->input->post('name'),
                        'jekel'		    => $this->input->post('jekel'),
                        'tgl_lahir'		=> $this->input->post('tgl_lahir'),
                        'tempat_lahir'	=> $this->input->post('tempat_lahir'),
                        'alamat'		=> $this->input->post('alamat')
                    );

                    $this->m_crud->set_data($tbl, $req, $id, $data);

                    $code = array("code" => true);
                    echo json_encode($code);
                   
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
		}

		public function change_pass() {
			$headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$res_peg = $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
					if ($res_peg->num_rows() > 0) {
						foreach ($res_peg->result() as $tmps) {	
							$oldpass 	= $this->input->post('opass');
							$npass 		= $this->input->post('newpass');
							$tbl 		= 'tb_user';
							$req    	= 'id_user';
							$id     	= $decodedToken->id_user;
							$data 		= array ('password' => $this->encryption->encrypt($npass));

							if($tmps->password != null || $tmps->password != '') {
								if ($this->encryption->decrypt($tmps->password) == $oldpass) {
									$this->m_crud->set_data($tbl, $req, $id, $data);
									$code = array("code" => TRUE);							
									echo json_encode($code);
								} else {
									$code = array("code" => FALSE, "error" => $this->session->bahasa === 'EN' ? "Your old password is wrong!" : "Maaf, password lama Anda salah!");							
									echo json_encode($code);
								}
							} else {
								if ( $oldpass != null || $oldpass != '') {
									$code = array("code" => FALSE, "error" => $this->session->bahasa === 'EN' ? "Your old password is wrong!" : "Maaf, password lama Anda salah!");							
									echo json_encode($code);
								} else {
									$this->m_crud->set_data($tbl, $req, $id, $data);
									$code = array("code" => TRUE);							
									echo json_encode($code);
								}
							}
						}
					}
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
		}

		public function update_pic() {
			$headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$config['upload_path']          = './assets/img/profile';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 20000;
					$config['file_name']        	= $decodedToken->id_user.'_'.$decodedToken->full_name;
				
					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('pics')) {
						$error = array('code' => false , 'error' => $this->upload->display_errors());
					
						echo json_encode($error);
					} else {
							
						$tmp = $this->upload->data();

						$res_peg = $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
						if ($res_peg->num_rows() > 0) {
							foreach ($res_peg->result() as $tmps) {	
								if ($tmps->pic !== null && $tmps->pic !== '' ) {									
									unlink($_SERVER['DOCUMENT_ROOT'].$tmps->pic);
								}
							}
						}
						
						$tbl 	= 'tb_peg';
						$req    = 'id_user';
						$id     = $decodedToken->id_user;

						$data = array (
							'pic' 			=> '/assets/img/profile/'.$tmp['file_name']
						);

						$this->m_crud->set_data($tbl, $req, $id, $data);
						$data = array('code' => true);

						echo json_encode($data);
					}
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
		}

		public function restore_pic() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$res_peg1 = $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
					if ($res_peg1->num_rows() > 0) {
						foreach ($res_peg1->result() as $tmps) {	
							if ($tmps->pic !== null && $tmps->pic !== '') {									
								unlink($_SERVER['DOCUMENT_ROOT'].$tmps->pic);

								$tbl 	= 'tb_peg';
								$req    = 'id_user';
								$id     = $decodedToken->id_user;

								$data = array (
									'pic' 			=> null
								);

								$this->m_crud->set_data($tbl, $req, $id, $data);

								$code = array("code" => true);
                    			echo json_encode($code);
							} else {
								$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Your picture already default!" : "Foto Profil Anda sudah di atur ulang!");
								echo json_encode($code);
							}
						}
					}
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
		}
    
		
}