<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Overtime extends CI_Controller {

		public function __construct() {
            parent::__construct();
        }

        public function aproval($act, $id) {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

                    $res_overtime = $this->m_crud->get_where('v_overtime', array('id_overtime' => $id));
                    if ($res_overtime->num_rows() > 0) {
                        foreach ($res_overtime->result() as $get) {	
                            $spv        = $get->nama_svp;
                            $peg        = $get->id_peg;
                            $date       = $get->date_overtime;
                        }
                    }

                    $data = array (
                        'status'      => $act
                    );

                    if ($act === 2 || $act === '2') {
                        $notif = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $peg,
                            'notif_en'      => $spv.' has approved your overtime submission with leave date submission '.$date.'.',
                            'notif_id'      => $spv.' telah menyetujui pengajuan lembur Anda dengan tanggal pengajuan '.$date.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'overtime',
                            'date'          => date("m/d/Y")
                        );
                    } else {
                        $notif = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $peg,
                            'notif_en'      => $spv.' has reject your overtime submission with leave date submission '.$date.'.',
                            'notif_id'      => $spv.' telah menolak pengajuan lembur Anda dengan tanggal pengajuan '.$date.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'overtime',
                            'date'          => date("m/d/Y")
                        );
                    }
                    
                    $ex = $this->m_crud->create('tb_notif', $notif);

                    if($ex['code'] === 0) {
                        $this->m_crud->set_data('tb_dtl_lembur', 'id_overtime', $id, $data);
                        $error      = array('code' => true, 'id' => $id);
                        echo json_encode($error);
                    } else {
                        $error      = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? 'Sorry, Some Database Error.' : 'Maaf, Sepertinya terjadi kesalahan pada Database.');
                        echo json_encode($error);
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
        
        public function insert_submission() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

                    if ($this->input->post('approver') === null || $this->input->post('approver') === '') {
                        $err_msg    = $this->session->bahasa === 'EN' ? "Sorry you cannot add submission! <br><br> <b>Note : </b>You dont have any approver in your unit, Please contact the Administrator for Adding some aprrover in your unit." : "Maaf Anda tidak dapat menambahkan pengajuan! <br><br> <b>Keterangan :</b> Anda tidak memiliki approver pada unit Anda! Tolong hubungi Administrator untuk menambahkan aprrover pada unit Anda.";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } else {

                        $akses 		= $this->encryption->decrypt($decodedToken->id_akses);
                        $svp        = $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver');

                        $data = array (
                            'id_overtime'   => uniqid(),
                            'id_peg'        => $this->input->post('id_peg'),
                            'id_spv'        => $this->input->post('approver'),
                            'date_overtime' => $this->input->post('date_overtime'),
                            'time_start'    => $this->input->post('from_time'),
                            'time_end'      => $this->input->post('to_time'),
                            'time_total'    => explode(':',$this->input->post('count_time'))[0],
                            'desc'          => $this->input->post('desc'),
                            'year'          => date("Y"),
                            'status'        => $akses === 2 || $akses === '2' ? 2 : 1
                        );

                        $notif = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $svp,
                            'notif_en'      => 'New Overtime Submission from '.$this->input->post('overtime_name_peg').'.',
                            'notif_id'      => 'Pengajuan Lembur baru dari '.$this->input->post('overtime_name_peg').'.',
                            'stat_notif'    => 0,
                            'pages'         => 'approval',
                            'date'          => date("m/d/Y")
                        );

                        $ex = $this->m_crud->create_trans('tb_dtl_lembur', 'tb_notif', $data, $notif);
                            
                        if ($ex === TRUE) {
                            $error  = array('code' => true);
                            // $this->mail('New Leave Submmision', $data['id_overtime'], 'id_spv');
                            echo json_encode($error);
                        } else {
                            $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Insert to database Error!" : "Terjadi kesalahan pada saat menyimpan ke database!");
                            unlink($full_path);
                            echo json_encode($error);
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

                    $res_cuti    = $this->m_crud->get_where('v_overtime', array('id_overtime' => $id));
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
                    if ($this->input->post('approver_edit') === null || $this->input->post('approver_edit') === '') {
                        $err_msg    = $this->session->bahasa === 'EN' ? "Sorry you cannot add submission! <br><br> <b>Note : </b>You dont have any approver in your unit, Please contact the Administrator for Adding some aprrover in your unit." : "Maaf Anda tidak dapat menambahkan pengajuan! <br><br> <b>Keterangan :</b> Anda tidak memiliki approver pada unit Anda! Tolong hubungi Administrator untuk menambahkan aprrover pada unit Anda.";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } else {
                        $id         = $this->input->post('id_overtime');
                        $svp        = $this->input->post('approver_edit');

                        $data = array (
                            'id_peg'        => $this->input->post('id_peg_edit'),
                            'id_spv'        => $this->input->post('approver_edit'),
                            'date_overtime' => $this->input->post('date_overtime_edit'),
                            'time_start'    => $this->input->post('from_time_edit'),
                            'time_end'      => $this->input->post('to_time_edit'),
                            'time_total'    => explode(':',$this->input->post('count_time_edit'))[0],
                            'desc'          => $this->input->post('desc_edit'),
                            'year'          => date("Y")
                        );

                        $notif = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $svp,
                            'notif_en'      => $this->input->post('overtime_name_peg_edit').' has changed the overtime submission data with ID '.$id.'.',
                            'notif_id'      => $this->input->post('overtime_name_peg_edit').' telah merubah data pengajuan lembur dengan ID '.$id.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'approval',
                            'date'          => date("m/d/Y")
                        );

                        $ex = $this->m_crud->create('tb_notif', $notif);
                        
                        if ($ex['code'] === 0) {
                            $error  = array('code' => true);
                            $this->m_crud->set_data('tb_dtl_lembur', 'id_overtime', $id, $data);
                            // $this->mail('New Leave Submmision', $data['id_overtime'], 'id_spv');
                            echo json_encode($error);
                        } else {
                            $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Insert to database Error!" : "Terjadi kesalahan pada saat menyimpan ke database!");
                            echo json_encode($error);
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
        
        public function delete() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id     = $this->input->post('id');
                    $nama   = null;
                    $spv    = null;

                    $res_overtime = $this->m_crud->get_where('v_overtime', array('id_overtime' => $id));
                    if ($res_overtime->num_rows() > 0) {
                        foreach ($res_overtime->result() as $get) {                            
                            $nama   = $get->nama;
                            $spv    = $get->id_spv;
                        } 
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Delete Error. Data Not Found!" : 'Hapus Gagal. Data tidak ditemukan!');
                        echo json_encode($code);
                    }

                    $notif = array (
                        'id_notif'      => uniqid(),
                        'id_peg'        => $spv,
                        'notif_en'      => $nama.' has cenceled the overtime data with ID '.$id.'.',
                        'notif_id'      => $nama.' telah membatalkan data lembur dengan ID '.$id.'.',
                        'stat_notif'    => 0,
                        'pages'         => 'approval',
                        'date'          => date("m/d/Y")
                    );
                    
                    $del = $this->m_crud->delete('tb_dtl_lembur', array('id_overtime' => $id));

                    if ($del) {
                        $this->m_crud->create('tb_notif', $notif);

                        $code = array("code" => true);
                        echo json_encode($code);
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Database Error! Cannot delete data." : "Maaf, Terjadi kesalahan pada database! Data Anda tidak dapat di hapus.");
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