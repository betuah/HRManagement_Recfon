<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Research extends CI_Controller {

		public function __construct() {
            parent::__construct();
            $this->load->library('email', $this->config->item('mail_config'));
        }
        
        public function mail($req, $id_research, $type) {

            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

                    $res_mail   = $this->m_crud->get_where('v_research', array('id_research' => $id_research));
                    if ($res_mail->num_rows() > 0) {
                        foreach ($res_mail->result() as $get) {  

                            $start                  = date_create($get->start_date);
                            $end                    = date_create($get->end_date);

                            $approval               = $get->approval;

                            $data['req']            = $req;
                            $data['name']           = $get->nama;
                            $data['nama_spv']       = $get->nama_spv;
                            $data['name_plt']       = $get->nama_plt;
                            $data['type_leave']     = $this->session->bahasa === 'EN' ? $get->type_research_en : $get->type_research_id;
                            $data['count_day']      = $get->lama_hari;
                            $data['from_date']      = date_format($start , "d M Y");
                            $data['until_date']     = date_format($end , "d M Y");

                            if ($req === 'send') {
                                if ($type === '1' || $type === 1) {
                                    $to_mail        = $get->email_spv;
                                    $subject        = $this->session->bahasa === 'EN' ? 'New General Leave Submmision' : 'Pengajuan Cuti Umum Baru';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has apply the General leave submission to you with the information in this bellow :' : 'telah mengajukan cuti umum kepada Anda dengan informasi di bawah ini :';

                                    $mail_content   = $this->load->view('mail/submission_mail',$data,true);
                                } else {
                                    $to_mail        = $get->email_plt;
                                    $subject        = 'PLT Notification';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has delegated his duties to you for '.$get->lama_hari.' from '.$data['from_date'].' until '.$data['until_date'].'.' : "telah mendelegasikan tugasnya kepada Anda selama '.$get->lama_hari.' dari tanggal ".$data['from_date']." sampai tanggal ".$data['until_date'].".";

                                    $mail_content   = $this->load->view('mail/plt_mail',$data,true);
                                }
                            } elseif ($req === 'approval') {
                                if ($type === '1' || $type === 1) {
                                    $to_mail        = $get->email;
                                    $subject        = $this->session->bahasa === 'EN' ? 'Leave Submmision Approval' : 'Penyetujuan Cuti';

                                    if ($approval === 2 || $approval === '2') {
                                        $data['msg']    = $this->session->bahasa === 'EN' ? 'has <b>approved</b> your leave submission with the information in this bellow :' : 'telah <b>menyetujui</b> pengajuan cuti Anda dengan informasi di bawah ini :';
                                    } elseif ($approval === 0 || $approval === '0') {
                                        $data['msg']    = $this->session->bahasa === 'EN' ? 'has <b>reject</b> your leave submission with the information in this bellow :' : 'telah <b>menolak</b> pengajuan cuti Anda dengan informasi di bawah ini :';
                                    } else {
                                        return FALSE;
                                    }
                                } else {
                                    $to_mail        = $get->email_plt;
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
                                    $to_mail        = $get->email_spv;
                                    $subject        = $this->session->bahasa === 'EN' ? 'Update Leave Submmision' : 'Perubahan Pengajuan Cuti';
                                    $data['msg']    = $this->session->bahasa === 'EN' ? 'has delegated his duties to you from '.$data['from_date'].' until '.$data['until_date'].'.' : "telah mendelegasikan tugasnya kepada Anda dari tanggal ".$data['from_date']." sampai tanggal ".$data['until_date'].".";

                                    $mail_content   = $this->load->view('mail/submission_mail',$data,true);
                                } else {
                                    $to_mail        = $get->email_plt;
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

                    $res_cuti = $this->m_crud->get_where('v_research', array('id_research' => $id));
                    if ($res_cuti->num_rows() > 0) {
                        foreach ($res_cuti->result() as $get) {	
                            $spv        = $get->nama_spv;
                            $id_peg     = $get->id_peg;
                            $peg        = $get->nama;
                            $date       = $get->date_submission;
                            $id_plt     = $get->id_plt;
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
                            'pages'         => 'general',
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
                            'pages'         => 'general',
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
                        $this->m_crud->set_data('tb_dtl_research', 'id_research', $id, $data);
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
                   
                        $akses 	    = $this->encryption->decrypt($decodedToken->id_akses);
                        $date_range = explode("-", $this->input->post('date_range'));
                        $date_ra    = date_create($date_range[0]);
                        $date_rb    = date_create($date_range[1]);
                        $uuid       = uniqid();

                        $dana   = $this->input->post('sof') === 3 || $this->input->post('sof') === '3' ? $this->input->post('osof') : $this->input->post('sof'); 

                        $data1  = array (
                            'id_research'       => $uuid,
                            'date_submission'   => $this->input->post('sub_date'),
                            'id_peg'            => $this->input->post('id_peg'),
                            'id_spv'            => $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver'),
                            'id_plt'            => $akses === 2 || $akses === '2' ? 1 : $this->input->post('plt'),
                            'start_date'        => date_format($date_ra , "Y-m-d"),
                            'end_date'          => date_format($date_rb , "Y-m-d"),
                            'nama_research'     => $this->input->post('p_name'),
                            'jabatan'           => $this->input->post('position'),
                            'picopi'            => $this->input->post('picopi'),
                            'sponsor'           => $this->input->post('sponsor'),
                            'jenis_keg'         => $this->input->post('toa'),
                            'jenis_keg_lain'    => $this->input->post('oat'),
                            'sumber_dana'       => $dana,
                            'lama_hari'         => $this->input->post('count_day'),
                            'tgl_mou'           => $this->input->post('date_mou'),
                            'tgl_research'      => $this->input->post('proposal'),                        
                            'tgl_buget'         => $this->input->post('budget'),
                            'tgl_ethic'         => $this->input->post('e_approval'),
                            'tgl_installment'   => $this->input->post('installment'),
                            'tgl_izin_riset'    => $this->input->post('date_permission'),
                            'lokasi'            => $this->input->post('location'),
                            'ket'               => $this->input->post('statement'),
                            'year'              => date("Y"),
                            'approval'          => $akses === 2 || $akses === '2' ? 2 : 1
                        );

                        // echo json_encode($data1);

                        $data2 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver'),
                            'notif_en'      => 'New Research Leave Submission from '.$this->input->post('research_name_peg').'.',
                            'notif_id'      => 'Pengajuan izin Riset baru dari '.$this->input->post('research_name_peg').'.',
                            'stat_notif'    => 0,
                            'pages'         => 'approval',
                            'date'          => date("m/d/Y")
                        );

                        $data3 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $this->input->post('plt'),
                            'notif_en'      => $this->input->post('research_name_peg').' has delegated his duties to you.',
                            'notif_id'      => $this->input->post('research_name_peg').' telah mendelegasikan tugasnya kepada Anda.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );

                        $ex = $this->m_crud->create_trans_notif('tb_dtl_research', 'tb_notif', $data1, $data2, $data3);
                        if ($ex === TRUE) {
                            $error      = array('code' => true, 'id_research' => $data1['id_research']);
                            // $this->mail('New General Duty Submmision', $data1['id_general'], 'aprrover');
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

        public function edit() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id = $this->input->post('id');

                    $res_cuti    = $this->m_crud->get_where('v_research', array('id_research' => $id));
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
                    if ($this->input->post('approver') === null || $this->input->post('approver') === '') {
                        $err_msg    = $this->session->bahasa === 'EN' ? "Sorry you cannot add submission! <br><br> <b>Note : </b>You dont have any approver in your unit, Please contact the Administrator for Adding some aprrover in your unit." : "Maaf Anda tidak dapat menambahkan pengajuan! <br><br> <b>Keterangan :</b> Anda tidak memiliki approver pada unit Anda! Tolong hubungi Administrator untuk menambahkan aprrover pada unit Anda.";
                        $error      = array('code' => false, 'error' => $err_msg);
                        echo json_encode($error);
                    } else {
                        $akses 	    = $this->encryption->decrypt($decodedToken->id_akses);
                        $date_range = explode("-", $this->input->post('date_range'));
                        $date_ra    = date_create($date_range[0]);
                        $date_rb    = date_create($date_range[1]);
                        $id         = $this->input->post('id_research_edit');
                        $svp        = $this->input->post('approver');
                        $dana       = $this->input->post('sof') === 3 || $this->input->post('sof') === '3' ? $this->input->post('osof') : $this->input->post('sof');
                        
                        
                        $old_plt    = null;
                        $new_plt    = $this->input->post('plt');
                        
                        $res_peg_res = $this->m_crud->get_where('v_research', array('id_research' => $id));
                        if ($res_peg_res->num_rows() > 0) {
                            foreach ($res_peg_res->result() as $tmps) {
                                $old_plt    = $tmps->id_plt;
                            }
                        }

                        $data  = array (
                            'date_submission'   => $this->input->post('sub_date'),
                            'id_peg'            => $this->input->post('id_peg'),
                            'id_spv'            => $akses === 2 || $akses === '2' ? 1 : $this->input->post('approver'),
                            'id_plt'            => $akses === 2 || $akses === '2' ? 1 : $this->input->post('plt'),
                            'start_date'        => date_format($date_ra , "Y-m-d"),
                            'end_date'          => date_format($date_rb , "Y-m-d"),
                            'nama_research'     => $this->input->post('p_name'),
                            'jabatan'           => $this->input->post('position'),
                            'picopi'            => $this->input->post('picopi'),
                            'sponsor'           => $this->input->post('sponsor'),
                            'jenis_keg'         => $this->input->post('toa'),
                            'jenis_keg_lain'    => $this->input->post('oat'),
                            'sumber_dana'       => $dana,
                            'lama_hari'         => $this->input->post('count_day'),
                            'tgl_mou'           => $this->input->post('date_mou'),
                            'tgl_research'      => $this->input->post('proposal'),                        
                            'tgl_buget'         => $this->input->post('budget'),
                            'tgl_ethic'         => $this->input->post('e_approval'),
                            'tgl_installment'   => $this->input->post('installment'),
                            'tgl_izin_riset'    => $this->input->post('date_permission'),
                            'lokasi'            => $this->input->post('location'),
                            'ket'               => $this->input->post('statement'),
                            'year'              => date("Y")
                        );

                        $notif1 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $svp,
                            'notif_en'      => $this->input->post('research_name_peg').' has changed the Research leave submission data with ID '.$id.'.',
                            'notif_id'      => $this->input->post('research_name_peg').' telah merubah data pengajuan izin riset dengan ID '.$id.'.',
                            'stat_notif'    => 0,
                            'pages'         => 'approval',
                            'date'          => date("m/d/Y")
                        );

                        $notif2 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $old_plt,
                            'notif_en'      => $this->input->post('research_name_peg').' has changed his delegated.',
                            'notif_id'      => $this->input->post('research_name_peg').' telah merubah delegasinya.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );

                        $notif3 = array (
                            'id_notif'      => uniqid(),
                            'id_peg'        => $akses === 2 || $akses === '2' ? 1 : $new_plt,
                            'notif_en'      => $this->input->post('research_name_peg').' has delegated his duties to you.',
                            'notif_id'      => $this->input->post('research_name_peg').' telah mendelegasikan tugasnya kepada Anda.',
                            'stat_notif'    => 0,
                            'date'          => date("m/d/Y")
                        );

                        if ($old_plt === $new_plt) {
                            $ex = $this->m_crud->create('tb_notif', $notif1);
                            if($ex['code'] === 0) {
                                $this->m_crud->set_data('tb_dtl_research', 'id_research', $id, $data);
                                // $this->mail('RE: New Leave Submmision', $id, 'aprrover');
                                $error      = array('code' => true, 'id_research' => $id);
                                echo json_encode($error);
                            } else {
                                $error      = array('code' => false, 'error' => $ex['message']);
                                echo json_encode($error);
                            }
                            
                        } else { 
                            // $this->m_crud->set_data('tb_dtl_cuti', 'id_cuti', $id, $data);
                            $ex = $this->m_crud->create_trans_notif('tb_notif', 'tb_notif', $notif1, $notif2, $notif3);
                            if($ex === TRUE) {
                                $this->m_crud->set_data('tb_dtl_research', 'id_research', $id, $data);
                                $error      = array('code' => true, 'id_research' => $id);
                                echo json_encode($error);
                            } else {
                                $error      = array('code' => false, 'error' => 'Database Error!');
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
        
        public function delete() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    $id     = $this->input->post('id');
                    $nama   = null;
                    $plt    = null;
                    $spv    = null;

                    $res_general = $this->m_crud->get_where('v_research', array('id_research' => $id));
                    if ($res_general->num_rows() > 0) {
                        foreach ($res_general->result() as $get) {                            
                            $nama   = $get->nama;
                            $spv    = $get->id_spv;
                            $plt    = $get->id_plt;
                        } 
                    } else {
                        $code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Delete Error. Data Not Found!" : 'Hapus Gagal. Data tidak ditemukan!');
                        echo json_encode($code);
                    }

                    $notif1 = array (
                        'id_notif'      => uniqid(),
                        'id_peg'        => $spv,
                        'notif_en'      => $nama.' has cenceled the Research Leave submission data with ID '.$id.'.',
                        'notif_id'      => $nama.' telah membatalkan data pengajuan cuti riset dengan ID '.$id.'.',
                        'stat_notif'    => 0,
                        'pages'         => 'approval',
                        'date'          => date("m/d/Y")
                    );

                    $notif2 = array (
                        'id_notif'      => uniqid(),
                        'id_peg'        => $plt,
                        'notif_en'      => $nama.' has cenceled his delegated to you.',
                        'notif_id'      => $nama.' telah membatalkan delegasinya kepada Anda.'.$this->input->post('leave_name_peg_edit').'.',
                        'stat_notif'    => 0,
                        'pages'         => 'approval',
                        'date'          => date("m/d/Y")
                    );
                    
                    $del = $this->m_crud->delete('tb_dtl_research', array('id_research' => $id));

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