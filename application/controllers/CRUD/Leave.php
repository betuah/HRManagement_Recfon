<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Leave extends CI_Controller {

		public function __construct() {
            parent::__construct();
            $this->load->library('email', $this->config->item('mail_config'));
        }
        
        public function mail($req, $id_cuti, $type) {

            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

                    $res_mail   = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id_cuti));
                    if ($res_mail->num_rows() > 0) {
                        foreach ($res_mail->result() as $get) {  

                            $start                  = date_create($get->start_date);
                            $end                    = date_create($get->end_date);

                            $approval               = $get->approval;

                            $data['req']            = $req;
                            $data['name']           = $get->nama_user;
                            $data['nama_spv']       = $get->nama_supervisor;
                            $data['type_leave']     = $get->nama_jen_cut;
                            $data['count_day']      = $get->lama_hari;
                            $data['from_date']      = date_format($start , "d M Y");
                            $data['until_date']     = date_format($end , "d M Y");

                            if ($req === 'send') {
                                if ($type === '1' || $type === 1) {
                                    $to_mail        = $get->spv_mail;
                                    $subject        = $this->session->bahasa === 'EN' ? 'New Leave Submmision' : 'Pengajuan Cuti Baru';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has apply the leave submission to you with the information in this bellow :' : 'telah mengajukan cuti kepada Anda dengan informasi di bawah ini :';

                                    $mail_content   = $this->load->view('mail/submission_mail',$data,true);
                                } else {
                                    $to_mail        = $get->plt_mail;
                                    $subject        = 'PLT Notification';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has delegated his duties to you from '.$data['from_date'].' until '.$data['until_date'].'.' : "telah mendelegasikan tugasnya kepada Anda dari tanggal ".$data['from_date']." sampai tanggal ".$data['until_date'].".";

                                    $mail_content   = $this->load->view('mail/plt_mail',$data,true);
                                }
                            } elseif ($req === 'approval') {
                                if ($type === '1' || $type === 1) {
                                    $to_mail        = $get->email_peg;
                                    $subject        = $this->session->bahasa === 'EN' ? 'Leave Submmision Approval' : 'Penyetujuan Cuti';

                                    if ($approval === 2 || $approval === '2') {
                                        $data['msg']    = $this->session->bahasa === 'EN' ? 'has <b>approved</b> your leave submission with the information in this bellow :' : 'telah <b>menyetujui</b> pengajuan cuti Anda dengan informasi di bawah ini :';
                                    } elseif ($approval === 0 || $approval === '0') {
                                        $data['msg']    = $this->session->bahasa === 'EN' ? 'has <b>reject</b> your leave submission with the information in this bellow :' : 'telah <b>menolak</b> pengajuan cuti Anda dengan informasi di bawah ini :';
                                    } else {
                                        return FALSE;
                                    }
                                } else {
                                    $to_mail        = $get->plt_mail;
                                    $subject        = $this->session->bahasa === 'EN' ? 'PLT Notification' : 'PLT Notification';

                                    if ($approval === 2 || $approval === '2') {
                                        $data['msg']    = $this->session->bahasa === 'EN' ? 'submission has approved. and you will delegate his duties from '.$data['from_date'].' until '.$data['until_date'].'.' : "telah mendelegasikan tugasnya kepada Anda dari tanggal ".$data['from_date']." sampai tanggal ".$data['until_date'].".";
                                    } elseif ($approval === 0 || $approval === '0') {
                                        $data['msg']    = $this->session->bahasa === 'EN' ? 'submission was reject and your name is cenceled as a delegation.' : 'tidak dizinkan cuti dan nama Anda telah dibatalkan sebagai delegasinya';
                                    } else {
                                        return FALSE;
                                    }
                                }

                                $mail_content   = $this->load->view('mail/submission_mail',$data,true);
                            } else {
                                if ($type === '1' || $type === 1) {
                                    $to_mail        = $get->spv_mail;
                                    $subject        = $this->session->bahasa === 'EN' ? 'Update Leave Submmision' : 'Perubahan Pengajuan Cuti';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has delegated his duties to you from '.$data['from_date'].' until '.$data['until_date'].'.' : "telah mendelegasikan tugasnya kepada Anda dari tanggal ".$data['from_date']." sampai tanggal ".$data['until_date'].".";

                                    $mail_content   = $this->load->view('mail/submission_mail',$data,true);
                                } else {
                                    $to_mail        = $get->plt_mail;
                                    $subject        = 'PLT Notification';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has changed his delegated and you are no longer a delegate.' : 'telah merubah delegasinya dan Anda sudah tidak menjadi delegasinya lagi.';

                                    $mail_content   = $this->load->view('mail/plt_mail',$data,true);
                                }
                            }
                        }
                    } else {
                        return false;
                    }
                    
                    $this->email->from('no-reply@seameo-recfon.org', 'Notification');
                    $this->email->to($to_mail); 
                    $this->email->subject($subject);
                    $this->email->message($mail_content);

                    if ($this->email->send()) {
                        $msg = array('code' => TRUE);
                        echo json_encode($msg);
                    } else {
                        $msg = array('code' => FALSE);
                        echo json_encode($msg);
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
        
        public function aproval($act, $id) {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

                    $res_cuti = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
                    if ($res_cuti->num_rows() > 0) {
                        foreach ($res_cuti->result() as $get) {	
                            $spv        = $get->nama_supervisor;
                            $peg        = $get->nama_user;
                            $id_peg     = $get->id_peg;
                            $date       = $get->tgl_cuti;
                            $id_plt     = $get->plt;
                            $count_day  = $get->lama_hari;
                            $s_date     = $get->start_date;
                            $n_date     = $get->end_date; 
                        }
                    }

                    $data = array (
                        'approval'      => $act
                    );

                    if ($act === 2 || $act === '2') {
                        $notif1 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $id_peg,
                            'notif_en'      => $spv.' has approved your leave submission with leave date submission '.$date.'.',
                            'notif_id'      => $spv.' telah menyetujui pengajuan cuti Anda dengan tanggal pengajuan cuti '.$date.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'leave',
                            'date'          => date("m/d/Y")
                        );

                        $notif2 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $id_plt,
                            'notif_en'      => $peg.' delegates his duties to you for '.$count_day.' days from date '.$s_date.' until '.$n_date.'.',
                            'notif_id'      => $peg.' mendelegasikan tugasnya kepada Anda selama '.$count_day.' hari dari tanggal '.$s_date.' sampai tanggal '.$n_date.'.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );
                    } else {
                        $notif1 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $id_peg,
                            'notif_en'      => $spv.' has reject your leave submission with leave date submission '.$date.'.',
                            'notif_id'      => $spv.' telah menolak pengajuan cuti Anda dengan tanggal pengajuan cuti '.$date.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'leave',
                            'date'          => date("m/d/Y")
                        );

                        $notif2 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $id_plt,
                            'notif_en'      => $peg.' submission has rejected and your name is cenceled as a delegation.',
                            'notif_id'      => $peg.' tidak diizinkan cuti dan nama Anda dibatalkan sebagai delegasinya.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );
                    }
                    
                    $ex = $this->m_crud->create_trans('tb_notif', 'tb_notif', $notif1, $notif2);

                    if($ex === TRUE) {
                        $this->m_crud->set_data('tb_dtl_cuti', 'id_cuti', $id, $data);
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
                    $year                   = date("Y");
                    $type_leave             = $this->input->post('sub_type');
                    $lama_hari              = $this->input->post('count_day');

                    $c_tahun 				= $this->m_crud->count_leave( $decodedToken->id_peg, '1', '2', $year);
                    $c_bersalin 			= $this->m_crud->count_leave( $decodedToken->id_peg, '3', '2', $year);
                    $c_haid 				= $this->m_crud->count_leave( $decodedToken->id_peg, '4', '2', $year);
                    $c_nikah 				= $this->m_crud->count_leave( $decodedToken->id_peg, '5', '2', $year);
                    $c_keluarga				= $this->m_crud->count_leave( $decodedToken->id_peg, '7', '2', $year);

                    $r_tahun 				= $c_tahun[0]->lama_hari === null ? '0' : $c_tahun[0]->lama_hari;
                    $r_bersalin 			= $c_bersalin[0]->lama_hari === null ? '0' : $c_bersalin[0]->lama_hari;
                    $r_haid 				= $c_haid[0]->lama_hari === null ? '0' : $c_haid[0]->lama_hari === null;
                    $r_nikah 				= $c_nikah[0]->lama_hari === null ? '0' : $c_nikah[0]->lama_hari;
                    $r_keluarga 			= $c_keluarga[0]->lama_hari === null ? '0' : $c_keluarga[0]->lama_hari;

                    $res_jen_cuti = $this->m_crud->get_where('tbl_jen_cuti', array('id_jen_cuti' => $type_leave));
                    if ($res_jen_cuti->num_rows() > 0) {
                        foreach ($res_jen_cuti->result() as $tmps) {
                            switch ($type_leave) {
                                case '1':
                                    $count = $tmps->quota - $r_tahun;
                                    break;
                                case '3':
                                    $count = $tmps->quota - $r_bersalin;
                                    break;
                                case '4':
                                    $count = $tmps->quota - $r_haid;
                                    break;
                                case '5':
                                    $count = $tmps->quota - $r_nikah;
                                    break;
                                case '7':
                                    $count = $tmps->quota - $r_keluarga;
                                    break;
                            }
                        }
                    }

                    if ($type_leave === '1' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your annual leave is ".$count." !" : "Hari tersisa untuk cuti tahunan Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '3' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Maternity Leave is ".$count." !" : "Hari tersisa untuk cuti bersalin Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '4' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Menstruation Leave is ".$count." !" : "Hari tersisa untuk cuti haid Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '5' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Wedding Leave is ".$count." !" : "Hari tersisa untuk cuti pernikahan Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '7' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Family leave is ".$count." !" : "Hari tersisa untuk cuti keluarga Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($this->input->post('approver') === null || $this->input->post('approver') === '') {
                        $err_msg    = $this->session->bahasa === 'EN' ? "Sorry you cannot add submission! <br><br> <b>Note : </b>You dont have any approver in your unit, Please contact the Administrator for Adding some aprrover in your unit." : "Maaf Anda tidak dapat menambahkan pengajuan! <br><br> <b>Keterangan :</b> Anda tidak memiliki approver pada unit Anda! Tolong hubungi Administrator untuk menambahkan aprrover pada unit Anda.";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } else {
                   
                        $date_range     = explode("-", $this->input->post('date_range'));
                        $date_ra        = date_create($date_range[0]);
                        $date_rb        = date_create($date_range[1]);

                        $uuid           = uniqid();

                        $config['upload_path']          = './assets/files/leave';
                        $config['allowed_types']        = 'pdf';
                        $config['max_size']             = 5000;
                        $config['file_name']        	= 'file_cuti_'.$uuid;
                    
                        $this->upload->initialize($config);
                        $files_name = null;
                        $error      = array('code' => true);

                        if (!$_FILES['files_cuti']["error"] == 4) {
                            if ( ! $this->upload->do_upload('files_cuti')) {
                                $error = array('code' => false , 'error' => $this->upload->display_errors());
                            } else {
                                $files_name = '/assets/files/leave/'.$this->upload->data('file_name');
                                $full_path  = $this->upload->data('full_path');
                            }
                        }

                        $akses 				= $this->encryption->decrypt($decodedToken->id_akses);

                        $data1 = array (
                            'id_cuti'       => $uuid,
                            'tgl_cuti'      => $this->input->post('sub_date'),
                            'id_peg'        => $this->input->post('id_peg'),
                            'start_date'    => date_format($date_ra , "Y-m-d"),
                            'end_date'      => date_format($date_rb , "Y-m-d"),
                            'tipe_cuti'     => $this->input->post('sub_type'),
                            'lama_hari'     => $this->input->post('count_day'),
                            'supervisor'    => $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver'),
                            'plt'           => $akses === 2 || $akses === '2' ? 1 : $this->input->post('plt'),
                            'ket'           => $this->input->post('statement'),
                            'year'          => $year,
                            'lampiran'      => $files_name,
                            'approval'      => $akses === 2 || $akses === '2' ? 2 : 1
                        );

                        $data2 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver'),
                            'notif_en'      => 'New Leave Submission from '.$this->input->post('leave_name_peg').'.',
                            'notif_id'      => 'Pengajuan cuti baru dari '.$this->input->post('leave_name_peg').'.',
                            'stat_notif'    => 0,
                            'pages'         => 'approval',
                            'date'          => date("m/d/Y")
                        );

                        $data3 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $this->input->post('plt'),
                            'notif_en'      => $this->input->post('leave_name_peg').' has submit your name as a delegation.',
                            'notif_id'      => $this->input->post('leave_name_peg').' mengajukan nama Anda sebagai delegasinya.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );

                        if ($error['code'] === false) {
                            echo json_encode($error);
                        } else {
                            // $ex = $this->m_crud->create('tb_dtl_cuti', $data);
                            $ex = $this->m_crud->create_trans_notif('tb_dtl_cuti', 'tb_notif', $data1, $data2, $data3);
                            if ($ex === TRUE) {
                                $error      = array('code' => true, 'id_cuti' => $data1['id_cuti']);
                                // $this->mail('New Leave Submmision', $data1['id_cuti'], 'aprrover');
                                // $this->mail('PLT', $data1['id_cuti'], 'plt');
                                echo json_encode($error);
                            } else {
                                $error = array('code' => false, 'error' => $this->session->bahasa === 'EN' ? "Insert to database Error!" : "Terjadi kesalahan pada saat menyimpan ke database!");
                                unlink($full_path);
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

        public function attachment_viewer() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id = $this->input->post('id');

                    $res_cuti = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
                    if ($res_cuti->num_rows() > 0) {
                        foreach ($res_cuti->result() as $get) {                            
                            if($get->lampiran != null || $get->lampiran != '') {
                                $code = array("code" => true, 'pdf' => $get->lampiran);
                                echo json_encode($code);
                            } else {
                                $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "No Attachments!" : "Maaf, Tidak Ada Lampiran!");
                                echo json_encode($code);
                            }
                        } 
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Data Not Found!" : "Maaf, Data Tidak Ditemukan!");
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

        public function edit() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id = $this->input->post('id');

                    $res_cuti    = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
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
                    $year                   = date("Y");
                    $type_leave             = $this->input->post('sub_type');
                    $lama_hari              = $this->input->post('count_day');
                    $c_tahun 				= $this->m_crud->count_leave( $decodedToken->id_peg, '1', '2', $year);
                    $c_bersalin 			= $this->m_crud->count_leave( $decodedToken->id_peg, '3', '2', $year);
                    $c_haid 				= $this->m_crud->count_leave( $decodedToken->id_peg, '4', '2', $year);
                    $c_nikah 				= $this->m_crud->count_leave( $decodedToken->id_peg, '5', '2', $year);
                    $c_keluarga				= $this->m_crud->count_leave( $decodedToken->id_peg, '7', '2', $year);

                    $r_tahun 				= $c_tahun[0]->lama_hari === null ? '0' : $c_tahun[0]->lama_hari;
                    $r_bersalin 			= $c_bersalin[0]->lama_hari === null ? '0' : $c_bersalin[0]->lama_hari;
                    $r_haid 				= $c_haid[0]->lama_hari === null ? '0' : $c_haid[0]->lama_hari === null;
                    $r_nikah 				= $c_nikah[0]->lama_hari === null ? '0' : $c_nikah[0]->lama_hari;
                    $r_keluarga 			= $c_keluarga[0]->lama_hari === null ? '0' : $c_keluarga[0]->lama_hari;

                    $res_jen_cuti = $this->m_crud->get_where('tbl_jen_cuti', array('id_jen_cuti' => $type_leave));
                    if ($res_jen_cuti->num_rows() > 0) {
                        foreach ($res_jen_cuti->result() as $tmps) {
                            switch ($type_leave) {
                                case '1':
                                    $count = $tmps->quota - $r_tahun;
                                    break;
                                case '3':
                                    $count = $tmps->quota - $r_bersalin;
                                    break;
                                case '4':
                                    $count = $tmps->quota - $r_haid;
                                    break;
                                case '5':
                                    $count = $tmps->quota - $r_nikah;
                                    break;
                                case '7':
                                    $count = $tmps->quota - $r_keluarga;
                                    break;
                            }
                        }
                    }

                    if ($type_leave === '1' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your annual leave is ".$count." !" : "Hari tersisa untuk cuti tahunan Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '3' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Maternity Leave is ".$count." !" : "Hari tersisa untuk cuti bersalin Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '4' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Menstruation Leave is ".$count." !" : "Hari tersisa untuk cuti haid Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '5' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Wedding Leave is ".$count." !" : "Hari tersisa untuk cuti pernikahan Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($type_leave === '7' && $lama_hari > $count) {
                        $err_msg    = $this->session->bahasa === 'EN' ? "The remaining day for your Family leave is ".$count." !" : "Hari tersisa untuk cuti keluarga Anda adalah ".$count." !";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } elseif ($this->input->post('approver_edit') === null || $this->input->post('approver_edit') === '') {
                        $err_msg    = $this->session->bahasa === 'EN' ? "Sorry you cannot add submission! <br><br> <b>Note : </b>You dont have any approver in your unit, Please contact the Administrator for Adding some aprrover in your unit." : "Maaf Anda tidak dapat menambahkan pengajuan! <br><br> <b>Keterangan :</b> Anda tidak memiliki approver pada unit Anda! Tolong hubungi Administrator untuk menambahkan aprrover pada unit Anda.";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } else {

                        $date_range = explode("-", $this->input->post('date_range_edit'));
                        $date_ra    = date_create($date_range[0]);
                        $date_rb    = date_create($date_range[1]);
                        $id         = $this->input->post('id_cuti');

                        $config['upload_path']          = './assets/files/leave';
                        $config['allowed_types']        = 'pdf';
                        $config['max_size']             = 5000;
                        $config['file_name']        	= 'file_cuti_'.$id;
                    
                        $this->upload->initialize($config); 
                        $files_name = null;
                        $old_plt    = null;
                        $new_plt    = $this->input->post('plt_edit');
                        $error      = array('code' => true);

                        if (!$_FILES['files_cuti_edit']["error"] == 4) {
                            if ( ! $this->upload->do_upload('files_cuti_edit')) {
                                $error = array('code' => false , 'error' => $this->upload->display_errors());
                            } else {
                                $res_cuti = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
                                if ($res_cuti->num_rows() > 0) {
                                    foreach ($res_cuti->result() as $tmps) {	
                                        if ($tmps->lampiran != null && $tmps->lampiran != '' ) {									
                                            unlink($_SERVER['DOCUMENT_ROOT'].$tmps->lampiran);
                                        }
                                    }
                                }

                                $files_name = '/assets/files/leave/'.$this->upload->data('file_name');
                            }
                        } else {
                            $res_cuti = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
                            if ($res_cuti->num_rows() > 0) {
                                foreach ($res_cuti->result() as $tmps) {
                                    $files_name = $tmps->lampiran;
                                    $old_plt    = $tmps->plt;
                                }
                            }
                        }

                        $akses 				= $this->encryption->decrypt($decodedToken->id_akses);

                        $data = array (
                            // 'id_cuti'       => $id,
                            'tgl_cuti'      => $this->input->post('sub_date_edit'),
                            'id_peg'        => $this->input->post('id_peg_edit'),
                            'start_date'    => date_format($date_ra , "Y-m-d"),
                            'end_date'      => date_format($date_rb , "Y-m-d"),
                            'tipe_cuti'     => $this->input->post('sub_type_edit'),
                            'lama_hari'     => $this->input->post('count_day_edit'),
                            'supervisor'    => $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver_edit'),
                            'plt'           => $akses === 2 || $akses === '2' ? 1 : $this->input->post('plt_edit'),
                            'ket'           => $this->input->post('statement_edit'),
                            'year'          => date("Y"),
                            'lampiran'      => $files_name
                        );

                        $notif1 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $this->input->post('approver_edit'),
                            'notif_en'      => $this->input->post('leave_name_peg_edit').' has changed the leave submission data with ID '.$id.'.',
                            'notif_id'      => $this->input->post('leave_name_peg_edit').' telah merubah data pengajuan cuti dengan ID '.$id.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'approval',
                            'date'          => date("m/d/Y")
                        );

                        $notif2 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $old_plt,
                            'notif_en'      => $this->input->post('leave_name_peg_edit').' has changed his delegated and you are no longer a delegate.',
                            'notif_id'      => $this->input->post('leave_name_peg_edit').' telah merubah delegasinya dan Anda sudah tidak menjadi delegasinya lagi.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );

                        $notif3 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $new_plt,
                            'notif_en'      => $this->input->post('leave_name_peg_edit').' has delegated his duties to you from '.$date_range[0].' until '.$date_range[1].'.',
                            'notif_id'      => $this->input->post('leave_name_peg_edit').' telah mendelegasikan tugasnya kepada Anda dari tanggal '.$date_range[0].' sampai tanggal '.$date_range[1].'.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );

                        if ($error['code'] === false) {
                            echo json_encode($error);
                        } else {
                            if ($old_plt === $new_plt) {
                                
                                $ex = $this->m_crud->create('tb_notif', $notif1);
                                if($ex['code'] === 0) {
                                    $this->m_crud->set_data('tb_dtl_cuti', 'id_cuti', $id, $data);
                                    // $this->mail('RE: New Leave Submmision', $id, 'aprrover');
                                    $error      = array('code' => true, 'id_cuti' => $id);
                                    echo json_encode($error);
                                } else {
                                    $error      = array('code' => false, 'error' => $ex['message']);
                                    echo json_encode($error);
                                }
                                
                            } else { 
                                // $this->m_crud->set_data('tb_dtl_cuti', 'id_cuti', $id, $data);
                                $ex = $this->m_crud->create_trans_notif('tb_notif', 'tb_notif', $notif1, $notif2, $notif3);
                                if($ex === TRUE) {
                                    $this->m_crud->set_data('tb_dtl_cuti', 'id_cuti', $id, $data);
                                    $error      = array('code' => true, 'id_cuti' => $id, 'stat' => 2);
                                    echo json_encode($error);
                                } else {
                                    $error      = array('code' => false, 'error' => 'Database Error!');
                                    echo json_encode($error);
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
        
        public function delete() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id     = $this->input->post('id');
                    $nama   = null;
                    $plt    = null;
                    $spv    = null;

                    $res_cuti = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
                    if ($res_cuti->num_rows() > 0) {
                        foreach ($res_cuti->result() as $get) {                            
                            if($get->lampiran != null || $get->lampiran != '') {
                                unlink($_SERVER["DOCUMENT_ROOT"].$get->lampiran);
                                $nama   = $get->nama_user;
                                $spv    = $get->supervisor;
                                $plt    = $get->plt;
                            } else {
                                $nama   = $get->nama_user;
                                $spv    = $get->supervisor;
                                $plt    = $get->plt;
                            }
                        } 
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Delete Error. Data Not Found!" : 'Hapus Gagal. Data tidak ditemukan!');
                        echo json_encode($code);
                    }

                    $notif1 = array (
                        'id_notif'      => uniqid(),
                        'id_peg'        => $spv,
                        'notif_en'      => $nama.' has cenceled the leave submission data with ID '.$id.'.',
                        'notif_id'      => $nama.' telah membatalkan data pengajuan cuti dengan ID '.$id.'.',
                        'stat_notif'    => 0,
                        'pages'         => 'approval',
                        'date'          => date("m/d/Y")
                    );

                    $notif2 = array (
                        'id_notif'      => uniqid(),
                        'id_peg'        => $plt,
                        'notif_en'      => $nama.' has cenceled his delegated and you are no longer a delegate.',
                        'notif_id'      => $nama.' telah membatalkan delegasinya dan Anda sudah tidak menjadi delegasinya lagi.'.$this->input->post('leave_name_peg_edit').'.',
                        'stat_notif'    => 0,
                        'date'          => date("m/d/Y")
                    );
                    
                    $del = $this->m_crud->delete('tb_dtl_cuti', array('id_cuti' => $id));

                    if ($del) {
                        
                        $this->m_crud->create_trans('tb_notif', 'tb_notif', $notif1, $notif2);

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