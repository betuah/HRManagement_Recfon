<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Home extends CI_Controller {

		public function __construct() {
            parent::__construct();
        }

        public function search() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                        $c_date					= $this->input->post('date');

                        $qry					= 'SELECT * FROM v_available HAVING ("'.$c_date.'" >= sdate_cuti AND "'.$c_date.'" <= ndate_cuti AND approval_cuti = 2) OR ("'.$c_date.'" >= sdate_general AND "'.$c_date.'" <= ndate_general AND approval_general = 2) OR ("'.$c_date.'" >= sdate_research AND "'.$c_date.'" <= ndate_research AND approval_research = 2)';
                        
                        // Available 
                        $data['get_peg']		= $this->m_crud->get_all('v_pegawai');
                        $data['get_available']	= $this->m_crud->get_query($qry)->result();

                        // Remaining Days
                        $data['get_r_days']		= $this->m_crud->get_where('tbl_jen_cuti', array('quota !=' => null))->result();

                        // Research
                        $data['get_research']	= $this->m_crud->get_between('v_research', $c_date, 'start_date', 'end_date', 'id_peg')->result();

                        // General
                        $data['get_general']	= $this->m_crud->get_between('v_general', $c_date, 'start_date', 'end_date', 'id_peg')->result();

                        // Leave
                        $data['get_cuti']		= $this->m_crud->get_between('v_cuti', $c_date, 'start_date', 'end_date', 'id_peg')->result();
                        
                        // Overtime
                        $data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('date_overtime' => date("d-m-Y")))->result();

                        $this->load->view('apps/content/home/summary_home', $data);
                    
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
        }

        public function peg() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    
                    $id         = $this->input->post('id');

                    $res_peg 	= $this->m_crud->get_where('v_pegawai', array('id_peg' => $id));
                        if ($res_peg->num_rows() > 0) {
                            foreach ($res_peg->result() as $tmp) {	
                                $akses 		        = $tmp->id_akses === 1 || $tmp->id_akses === '1' ? '1' : (int) $tmp->id_akses - 1;
                                $data['name'] 		= $tmp->nama != null && $tmp->nama != '' ? $tmp->nama : '-';
                                $data['email'] 		= $tmp->email != null && $tmp->email != '' ? $tmp->email : '-';
                                $data['jab']		= $tmp->ket != null && $tmp->ket != '' ? $tmp->ket : '-';
                                $data['pics'] 		= $tmp->pic != null && $tmp->ket != ''? base_url().$tmp->pic : ($tmp->pic_google != '' || $tmp->pic_google != null ? $tmp->pic_google : base_url('assets/img/profile/avatar4.png'));
                                $data['unit'] 		= $tmp->nama_unit != null && $tmp->nama_unit != '' ? $tmp->nama_unit : '-';
                                $data['tgl_lahir'] 	= $tmp->tgl_lahir != null && $tmp->tgl_lahir != '' ? $tmp->tgl_lahir : '-';
                                
                                switch ($akses) {
									case '2':								

										$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dir' => $tmp->id_dir, 'id_akses' => $akses));
										break;
									case '3':
										
										$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dd' => $tmp->id_dd, 'id_akses' => $akses));
										break;
									case '4':
																					
										$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses));
										break;
									case '5':
										
										$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses));
										break;
                                }
                                
                                if (isset($res_spr_leave)) {
                                    if ($res_spr_leave->num_rows() > 0) {
                                        foreach ($res_spr_leave->result() as $tmpsec) {
                                            $data['supervisor'] 	= $tmpsec->nama;
                                        }
                                    }
                                } else {
                                    $data['supervisor'] 	= '-';
                                }
                                
                                echo json_encode($data);
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

        public function peg_leave() {
            $headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
                    
                    $id         = $this->input->post('id');
                    $req        = $this->input->post('req');

                    switch ($req) {
                        case '2':
                            $res_leave  = $this->m_crud->get_where('v_general', array('id_general' => $id));
                            break;
                        case '3':
                            $res_leave  = $this->m_crud->get_where('v_research', array('id_research' => $id));
                            break;
                        case '4':
                            $res_leave  = $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
                            break;
                        case '5':
                            $res_leave  = $this->m_crud->get_where('v_overtime', array('id_overtime' => $id));
                            break;
                    }
                    
                    if ($res_leave->num_rows() > 0) {
                        foreach ($res_leave->result() as $get_leave) {

                            switch ($req) {
                                case '2':
                                    $data['start_date'] = $get_leave->start_date;
                                    $data['end_date']   = $get_leave->end_date;
                                    $data['count_day']  = $get_leave->lama_hari;
                                    $data['type']       = $this->session->bahasa === 'EN' ? $get_leave->name_duty_type_en : $get_leave->name_duty_type_id;

                                    break;
                                case '3':
                                    $data['start_date'] = $get_leave->start_date;
                                    $data['end_date']   = $get_leave->end_date;
                                    $data['count_day']  = $get_leave->lama_hari;
                                    $data['type']       = $this->session->bahasa === 'EN' ? $get_leave->type_research_en : $get_leave->type_research_id;
                                    break;
                                case '4':
                                    $data['start_date'] = $get_leave->start_date;
                                    $data['end_date']   = $get_leave->end_date;
                                    $data['count_day']  = $get_leave->lama_hari;
                                    $data['type']       = $this->session->bahasa === 'EN' ? $get_leave->nama_jen_cut_en : $get_leave->nama_jen_cut;
                                    break;
                                case '5':
                                    $data['date']           = $get_leave->date_overtime;
                                    $data['from']           = $get_leave->time_start;
                                    $data['to']             = $get_leave->time_end;
                                    $data['time_count']     = $get_leave->time_total;
                                    
                                    $res_leave  = $this->m_crud->get_where('v_overtime', array('id_overtime' => $id));
                                    break;
                            }

                            $res_peg 	= $this->m_crud->get_where('v_pegawai', array('id_peg' => $get_leave->id_peg));
                            if ($res_peg->num_rows() > 0) {
                                foreach ($res_peg->result() as $tmp) {	
                                    $akses 		        = $tmp->id_akses === 1 || $tmp->id_akses === '1' ? '1' : (int) $tmp->id_akses - 1;
                                    $data['name'] 		= $tmp->nama != null && $tmp->nama != '' ? $tmp->nama : '-';
                                    $data['email'] 		= $tmp->email != null && $tmp->email != '' ? $tmp->email : '-';
                                    $data['jab']		= $tmp->ket != null && $tmp->ket != '' ? $tmp->ket : '-';
                                    $data['pics'] 		= $tmp->pic != null && $tmp->ket != ''? base_url().$tmp->pic : $tmp->pic_google;
                                    $data['unit'] 		= $tmp->nama_unit != null && $tmp->nama_unit != '' ? $tmp->nama_unit : '-';
                                    $data['tgl_lahir'] 	= $tmp->tgl_lahir != null && $tmp->tgl_lahir != '' ? $tmp->tgl_lahir : '-';
                                    
                                    switch ($akses) {
                                        case '2':								

                                            $res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dir' => $tmp->id_dir, 'id_akses' => $akses));
                                            break;
                                        case '3':
                                            
                                            $res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dd' => $tmp->id_dd, 'id_akses' => $akses));
                                            break;
                                        case '4':
                                                                                        
                                            $res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses));
                                            break;
                                        case '5':
                                            
                                            $res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses));
                                            break;
                                    }
                                    
                                    if (isset($res_spr_leave)) {
                                        if ($res_spr_leave->num_rows() > 0) {
                                            foreach ($res_spr_leave->result() as $tmpsec) {
                                                $data['supervisor'] 	= $tmpsec->nama;
                                            }
                                        }
                                    } else {
                                        $data['supervisor'] 	= '-';
                                    }
                                    
                                    echo json_encode($data);
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

}