<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Employees extends CI_Controller {

		public function __construct() {
            parent::__construct();
        }     
        
        public function insert() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $uuid = rand(100000,999999);

                    $data_user = array (
                        'id_user'       => $uuid,
                        'email'         => $this->input->post('email'),
                        'id_akses'      => $this->input->post('level'),
                        'status'        => 1
                    );
                    
                    $data_peg = array (
                        'id_peg'        => $uuid,
                        'id_user'       => $uuid,
                        'nik_peg'       => $this->input->post('nik'),
                        'nama'          => $this->input->post('name'),
                        'jekel'         => $this->input->post('gender'),
                        'id_div'        => $this->input->post('unit'),
                        'bahasa'        => 'EN',
                    );

                    $res_email = $this->m_crud->get_where('tb_user', array('email' => $this->input->post('email')));
                    if ($res_email->num_rows() > 0) {
                        $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Your email address already axist!" : "Email Anda sudah terdaftar!");
                        echo json_encode($error);
                    } else {
                        $res_dirut  = $this->m_crud->get_where('tb_user', array('id_akses' => '2'));
                        $res_diputi = $this->m_crud->get_where('tb_user', array('id_akses' => '3'));
                        if ($this->input->post('level') === '2' && $res_dirut->num_rows() >= 1) {
                            $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Director level cannot be more than 1 account!" : "Level Akun Directur tidak boleh lebih dari 1 akun!");
                            echo json_encode($error);
                        } else if ($this->input->post('level') === '3' && $res_diputi->num_rows() >= 2) {
                            $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Deputi level cannot be more than 2 account!" : "Level Akun Deputi tidak boleh lebih dari 2 akun!");
                            echo json_encode($error);
                        } else {
                            $ex = $this->m_crud->create_trans('tb_user', 'tb_peg', $data_user, $data_peg);
                            
                            if ($ex === TRUE) {
                                $error  = array('code' => true);
                                echo json_encode($error);
                            } else {
                                $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Insert to database Error!" : "Terjadi kesalahan pada saat menyimpan ke database!");
                                echo json_encode($error);
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

        public function edit() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id = $this->input->post('id');

                    $res_cuti    = $this->m_crud->get_where('v_pegawai', array('id_peg' => $id));
                    $get['data'] = $res_cuti->result();
                    
                    if ($res_cuti->num_rows() > 0) {
                        $code = array("code" => true, "get" => $get['data']);
                        echo json_encode($code);
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Delete Error. Data Not Found!" : "Maaf, Data tidak ditemukan!");
                        echo json_encode($code);
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

        public function update() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

                    $id = $this->input->post('id_peg');
                    
                    $data_user = array (
                        'id_user'       => $id,
                        'email'         => $this->input->post('email_edit'),
                        'id_akses'      => $this->input->post('level_edit'),
                        'status'        => $this->input->post('status_edit')
                    );

                    if ($this->input->post('unit_edit') === null) {
                        $data_peg = array (
                            'id_peg'        => $id,
                            'id_user'       => $this->input->post('id_peg'),
                            'nik_peg'       => $this->input->post('nik_edit'),
                            'nama'          => $this->input->post('name_edit'),
                            'jekel'         => $this->input->post('gender_edit')
                        );
                    } else {
                        $data_peg = array (
                            'id_peg'        => $id,
                            'id_user'       => $this->input->post('id_peg'),
                            'nik_peg'       => $this->input->post('nik_edit'),
                            'nama'          => $this->input->post('name_edit'),
                            'jekel'         => $this->input->post('gender_edit'),
                            'id_div'        => $this->input->post('unit_edit'),
                        );
                    }

                    $this->m_crud->set_data('tb_user', 'id_user', $id, $data_user);
                    $this->m_crud->set_data('tb_peg', 'id_peg', $id, $data_peg);

                    $error = array("code" => true, 'id_peg' => $id);
                    echo json_encode($error);

				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
        }
        
        public function delete() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id     = $this->input->post('id');

                    $res_pegawai = $this->m_crud->get_where('v_pegawai', array('id_peg' => $id));
                    if ($res_pegawai->num_rows() > 0) {
                        foreach ($res_pegawai->result() as $get) {                            
                            // $this->m_crud->delete('tb_user', array('id_user' => $get->id_user));
                            $del = $this->m_crud->delete('tb_user', array('id_user' => $get->id_user));

                            if ($del) {
                                $code = array("code" => true);
                                echo json_encode($code);
                            } else {
                                $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Database Error! Cannot delete data." : "Maaf, Terjadi kesalahan pada database! Data Anda tidak dapat di hapus.");
                                echo json_encode($code);
                            }
                        } 
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Delete Error. Data Not Found!" : 'Hapus Gagal. Data tidak ditemukan!');
                        echo json_encode($code);
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