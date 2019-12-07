<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Ajax extends CI_Controller {
 
		public function __construct() {
			parent::__construct();
		}

		public function global_data ($req) {
			switch ($req) {
				case 'leave_en_type':
					$data = array(
						"0" => (object) array ('id_jen_cuti' => '1', 'nama_jen_cut' => 'Annual Leave'),
						"1" => (object) array ('id_jen_cuti' => '2', 'nama_jen_cut' => 'Sick Leave'),
						"2" => (object) array ('id_jen_cuti' => '3', 'nama_jen_cut' => 'Maternity Leave'),
						"3" => (object) array ('id_jen_cuti' => '4', 'nama_jen_cut' => 'Menstruation Leave'),
						"4" => (object) array ('id_jen_cuti' => '5', 'nama_jen_cut' => 'Wedding Leave'),
						"5" => (object) array ('id_jen_cuti' => '6', 'nama_jen_cut' => 'Sabbatical Leave'),
						"6" => (object) array ('id_jen_cuti' => '7', 'nama_jen_cut' => 'Family Leave'),
						"7" => (object) array ('id_jen_cuti' => '8', 'nama_jen_cut' => 'Unpaid Leave'),
						"8" => (object) array ('id_jen_cuti' => '9', 'nama_jen_cut' => 'Others'),
					);
					break;
			}
			return $data;
		}

		public function language ($lang) {
			$headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$id = $decodedToken->id_peg;
							
					$data = array (
						'bahasa'        => $lang
					);

					$this->session->set_userdata('bahasa', $lang);

					$this->m_crud->set_data('tb_peg', 'id_peg', $id, $data);

					$error = array("code" => true);

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

		public function view($page){
			$headers = $this->input->request_headers();

			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					
					switch ($page) {
						case 'home':
							$akses = $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$res_peg = $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg->num_rows() > 0) {
								foreach ($res_peg->result() as $tmp) {		
									$data['nama'] 		= $tmp->nama != null && $tmp->nama != '' ? $tmp->nama : '-';
									$data['email'] 		= $tmp->email != null && $tmp->email != '' ? $tmp->email : '-';
									$data['jab']		= $tmp->ket != null && $tmp->ket != '' ? $tmp->ket : '-';
									$data['pics'] 		= $tmp->pic != null && $tmp->ket != ''? base_url().$tmp->pic : $decodedToken->pic;
									$data['unit'] 		= $tmp->nama_unit != null && $tmp->nama_unit != '' ? $tmp->nama_unit : '-';
									$data['tgl_lahir'] 	= $tmp->tgl_lahir != null && $tmp->tgl_lahir != '' ? $tmp->tgl_lahir : '-';
									$data['tempat'] 	= $tmp->tempat_lahir != null && $tmp->tempat_lahir != '' ? $tmp->tempat_lahir : '-';
									$data['alamat'] 	= $tmp->alamat != null && $tmp->alamat != '' ? $tmp->alamat : '-';
									$data['jekel'] 		= $tmp->jekel != null && $tmp->jekel != '' ? $tmp->jekel : '-';
									$data['nik'] 		= $tmp->nik_peg != null && $tmp->nik_peg != '' ? $tmp->nik_peg : '-';

									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$c_date					= date("Y-m-d");
									$year 					= date("Y");

									$qry					= 'SELECT * FROM v_available HAVING ("'.$c_date.'" >= sdate_cuti AND "'.$c_date.'" <= ndate_cuti AND approval_cuti = 2) OR ("'.$c_date.'" >= sdate_general AND "'.$c_date.'" <= ndate_general AND approval_general = 2) OR ("'.$c_date.'" >= sdate_research AND "'.$c_date.'" <= ndate_research AND approval_research = 2)';
									
									// Available 
									$data['get_peg']		= $this->m_crud->get_all('v_pegawai');
									$data['get_available']	= $this->m_crud->get_query($qry)->result();

									// Remaining Days
									$data['get_r_days']		= $this->m_crud->get_where('tbl_jen_cuti', array('quota !=' => null))->result();

									// Research
									$data['get_research']	= $this->m_crud->get_between('v_research', $c_date, 'start_date', 'end_date', 'id_peg')->result();
									$data['count_research'] = $this->m_crud->sum_data('lama_hari', array('id_peg' => $tmp->id_peg, 'approval' => 2, 'year' => $year), 'tb_dtl_research');

									// General
									$data['get_general']	= $this->m_crud->get_between('v_general', $c_date, 'start_date', 'end_date', 'id_peg')->result();
									$data['count_general'] 	= $this->m_crud->sum_data('lama_hari', array('id_peg' => $tmp->id_peg, 'approval' => 2, 'year' => $year), 'tb_dtl_umum');

									// Leave
									$data['get_cuti']		= $this->m_crud->get_between('v_cuti', $c_date, 'start_date', 'end_date', 'id_peg')->result();
									$data['count_leave'] 	= $this->m_crud->sum_data('lama_hari', array('id_peg' => $tmp->id_peg, 'approval' => 2, 'year' => $year), 'tb_dtl_cuti');
									
									// Overtime
									$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('date_overtime' => date("d-m-Y")))->result();
									$data['count_overtime']	= $this->m_crud->sum_data('time_total', array('id_peg' => $tmp->id_peg, 'status' => 2, 'year' => $year), 'tb_dtl_lembur');

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
	
									
									if ( isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['supervisor'] 	= '-';
									}
								}
							}
						break;

						case 'profile':
							$akses 		= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$res_peg 	= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg->num_rows() > 0) {
								foreach ($res_peg->result() as $tmp) {		
									$data['nama'] 		= $tmp->nama != null && $tmp->nama != '' ? $tmp->nama : '-';
									$data['email'] 		= $tmp->email != null && $tmp->email != '' ? $tmp->email : '-';
									$data['jab']		= $tmp->ket != null && $tmp->ket != '' ? $tmp->ket : '-';
									$data['pics'] 		= $tmp->pic != null && $tmp->ket != ''? base_url().$tmp->pic : $decodedToken->pic;
									$data['unit'] 		= $tmp->nama_unit != null && $tmp->nama_unit != '' ? $tmp->nama_unit : '-';
									$data['tgl_lahir'] 	= $tmp->tgl_lahir != null && $tmp->tgl_lahir != '' ? $tmp->tgl_lahir : '-';
									$data['tempat'] 	= $tmp->tempat_lahir != null && $tmp->tempat_lahir != '' ? $tmp->tempat_lahir : '-';
									$data['alamat'] 	= $tmp->alamat != null && $tmp->alamat != '' ? $tmp->alamat : '-';
									$data['jekel'] 		= $tmp->jekel != null && $tmp->jekel != '' ? $tmp->jekel : '-';
									$data['nik'] 		= $tmp->nik_peg != null && $tmp->nik_peg != '' ? $tmp->nik_peg : '-';
									$data['token'] 		= $headers['Authorization'];
								}

								// $res_spr = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses));

								// if ($res_spr->num_rows() > 0) {
								// 	foreach ($res_spr->result() as $tmpsec) {
								// 		$data['supervisor'] 	= $tmpsec->nama;
								// 	}
								// }

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

								if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
									foreach ($res_spr_leave->result() as $tmpsec) {
										$data['supervisor'] 	= $tmpsec->nama;
										$data['approver'] 		= $tmpsec->id_peg;
									}
								} else {
									$data['supervisor'] 	= '-';
								}
							}
						break;

						case 'research':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['jekel'] 			= $tmp->jekel;
									$data['cdate']			= date("m/d/Y"); 
									$data['type']			= $this->m_crud->get_all('tb_type_research');
									$data['get_general']	= $this->m_crud->get_where('v_research', array('id_peg' => $decodedToken->id_peg))->result();

									switch ($akses_supervisor) {
										case '2':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('nama_dir' => $tmp->nama_dir, 'id_akses' => $akses_supervisor));
											break;
										case '3':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('nama_dd' => $tmp->nama_dd, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
									}

									if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['approver'] 		= '1';
										$data['supervisor'] 	= '1';
									}

									$res_plt = $this->m_crud->get_where('v_pegawai', array('id_akses <=' => $akses));
									if ($res_plt->num_rows() > 0) {
										$data['plts'] = $res_plt->result();
									}
								}
							}
						break;

						case 'general':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['jekel'] 			= $tmp->jekel;
									$data['cdate']			= date("m/d/Y"); 
									$data['type']			= $this->m_crud->get_all('tb_duty_type');
									$data['get_general']	= $this->m_crud->get_where('v_general', array('id_peg' => $decodedToken->id_peg))->result();

									switch ($akses_supervisor) {
										case '2':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('nama_dir' => $tmp->nama_dir, 'id_akses' => $akses_supervisor));
											break;
										case '3':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('nama_dd' => $tmp->nama_dd, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
									}

									if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['approver'] 		= '1';
										$data['supervisor'] 	= '1';
									}

									$res_plt = $this->m_crud->get_where('v_pegawai', array('id_akses <=' => $akses));
									if ($res_plt->num_rows() > 0) {
										$data['plts'] = $res_plt->result();
									}
								}
							}
						break;

						case 'overtime':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_peg' => $decodedToken->id_peg))->result();

									switch ($akses_supervisor) {
										case '2':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('nama_dir' => $tmp->nama_dir, 'id_akses' => $akses_supervisor));
											break;
										case '3':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('nama_dd' => $tmp->nama_dd, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
									}

									
									if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['approver'] 		= '1';
										$data['supervisor'] 	= '1';
									}
								}
							}
						break;

						case 'leave':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['jekel'] 			= $tmp->jekel;
									$data['cdate']			= date("m/d/Y"); 
									$data['type']			= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
									$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('id_peg' => $decodedToken->id_peg))->result();

									switch ($akses_supervisor) {
										case '2':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dir' => $tmp->id_dir, 'id_akses' => $akses_supervisor));
											break;
										case '3':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dd' => $tmp->id_dd, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
										case '4':
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
									}

									if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['approver'] 		= '1';
										$data['supervisor'] 	= '1';
									}

									$res_plt = $this->m_crud->get_where('v_pegawai', array('id_akses <=' => $akses));
									if ($res_plt->num_rows() > 0) {
										$data['plts'] = $res_plt->result();
									}
								}
							}
						break;

						case 'approval':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['jekel'] 			= $tmp->jekel;
									$data['cdate']			= date("m/d/Y");

									switch ($akses) {
										case '1':
											// Research
											$data['type_research']	= $this->m_crud->get_all('tb_type_research');
											$data['get_reseach']	= $this->m_crud->get_all('v_research');

											// General
											$data['type_general']	= $this->m_crud->get_all('tb_duty_type');
											$data['get_general']	= $this->m_crud->get_all('v_general');

											// Leave
											$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
											$data['get_cuti']		= $this->m_crud->get_all('v_cuti');

											// Overtime
											$data['get_overtime']	= $this->m_crud->get_all('v_overtime');

											break;
										case '2':
											// Research
											$data['type_research']	= $this->m_crud->get_all('tb_type_research');
											$data['get_reseach']	= $this->m_crud->get_where('v_research', array('id_spv' => $decodedToken->id_peg, 'id_dir' => $tmp->id_dir))->result();

											// General
											$data['type_general']	= $this->m_crud->get_all('tb_duty_type');
											$data['get_general']	= $this->m_crud->get_where('v_general', array('id_spv' => $decodedToken->id_peg, 'id_dir' => $tmp->id_dir))->result();

											// Leave
											$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
											$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('supervisor' => $decodedToken->id_peg, 'id_dir' => $tmp->id_dir), 'tgl_cuti','DESC')->result();

											// Overtime
											$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_spv' => $decodedToken->id_peg, 'id_dir' => $tmp->id_dir))->result();

											break;
										case '3':
											// Research
											$data['type_research']	= $this->m_crud->get_all('tb_type_research');
											$data['get_reseach']	= $this->m_crud->get_where('v_research', array('id_spv' => $decodedToken->id_peg, 'id_dd' => $tmp->id_dd))->result();

											// General
											$data['type_general']	= $this->m_crud->get_all('tb_duty_type');
											$data['get_general']	= $this->m_crud->get_where('v_general', array('id_spv' => $decodedToken->id_peg, 'id_dd' => $tmp->id_dd))->result();

											// Leave
											$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
											$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('supervisor' => $decodedToken->id_peg, 'id_dd' => $tmp->id_dd), 'tgl_cuti','DESC')->result();

											// Overtime
											$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_spv' => $decodedToken->id_peg, 'id_dd' => $tmp->id_dd))->result();

											break;
										case '4':
											// Research
											$data['type_research']	= $this->m_crud->get_all('tb_type_research');
											$data['get_reseach']	= $this->m_crud->get_where('v_research', array('id_spv' => $decodedToken->id_peg, 'id_div' => $tmp->id_div))->result();

											// General
											$data['type_general']	= $this->m_crud->get_all('tb_duty_type');
											$data['get_general']	= $this->m_crud->get_where('v_general', array('id_spv' => $decodedToken->id_peg, 'id_div' => $tmp->id_div))->result();

											// Leave
											$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
											$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('supervisor' => $decodedToken->id_peg, 'id_div' => $tmp->id_div), 'tgl_cuti','DESC')->result();

											// Overtime
											$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_spv' => $decodedToken->id_peg, 'id_div' => $tmp->id_div))->result();
											
											break;
									}

									switch ($akses_supervisor) {
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

									
									if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['supervisor'] 	= null;
									}

									$res_plt = $this->m_crud->get_where('v_pegawai', array('id_akses <=' => $akses));
									if ($res_plt->num_rows() > 0) {
										$data['plts'] = $res_plt->result();
									}
								}
							}
						break;

						case 'summary':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['jekel'] 			= $tmp->jekel;
									$data['cdate']			= date("m/d/Y");
									$year 					= date("Y");

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

									$data['qty']			= array(
																'0' => (object)['id' => '1', 'qty' => $r_tahun], 
																'1' => (object)['id' => '3','qty' => $r_bersalin], 
																'2' => (object)['id' => '4', 'qty' => $r_haid],
																'3' => (object)['id' => '5','qty' => $r_nikah],
																'4' => (object)['id' => '7','qty' => $r_keluarga]);

									// Remaining Days
									$data['type_research']	= $this->m_crud->get_all('tb_type_research');
									$data['get_r_days']		= $this->m_crud->get_where('tbl_jen_cuti', array('quota !=' => null))->result();

									// Research		
									$data['type_general']	= $this->m_crud->get_all('tb_duty_type');					
									$data['get_reseach']	= $this->m_crud->get_where('v_research', array('id_peg' => $decodedToken->id_peg, 'id_div' => $tmp->id_div, 'year' => $year))->result();

									// General							
									$data['get_general']	= $this->m_crud->get_where('v_general', array('id_peg' => $decodedToken->id_peg, 'id_div' => $tmp->id_div, 'year' => $year))->result();

									// Leave		
									$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');							
									$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('id_peg' => $decodedToken->id_peg, 'id_div' => $tmp->id_div, 'year' => $year), 'tgl_cuti','DESC')->result();

									// Overtime
									$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_peg' => $decodedToken->id_peg, 'id_div' => $tmp->id_div, 'year' => $year))->result();
									
									// $res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));

									// if ($res_spr_leave->num_rows() > 0) {
									// 	foreach ($res_spr_leave->result() as $tmpsec) {
									// 		$data['supervisor'] 	= $tmpsec->nama;
									// 		$data['approver'] 		= $tmpsec->id_peg;
									// 	}
									// }

									switch ($akses_supervisor) {
										case '2':								

											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dir' => $tmp->id_dir, 'id_akses' => $akses_supervisor));
											break;
										case '3':
											
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_dd' => $tmp->id_dd, 'id_akses' => $akses_supervisor));
											break;
										case '4':
																						
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
										case '5':
											
											$res_spr_leave = $this->m_crud->get_where('v_supervisor', array('id_div' => $tmp->id_div, 'id_akses' => $akses_supervisor));
											break;
									}

									
									if (isset($res_spr_leave) && $res_spr_leave->num_rows() > 0) {
										foreach ($res_spr_leave->result() as $tmpsec) {
											$data['supervisor'] 	= $tmpsec->nama;
											$data['approver'] 		= $tmpsec->id_peg;
										}
									} else {
										$data['supervisor'] 	= '-';
									}

									$res_plt = $this->m_crud->get_where('v_pegawai', array('id_akses <=' => $akses));
									if ($res_plt->num_rows() > 0) {
										$data['plts'] = $res_plt->result();
									}
								}
							}
						break;

						case 'recfontoday':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['id_peg']			= $tmp->id_peg;
									$data['name'] 			= $tmp->nama;
									$data['jekel'] 			= $tmp->jekel;
									$c_date					= date("Y-m-d");

									$qry					= 'SELECT * FROM v_available GROUP BY id_peg HAVING ("'.$c_date.'" >= sdate_cuti AND "'.$c_date.'" <= ndate_cuti AND approval_cuti = 2) OR ("'.$c_date.'" >= sdate_general AND "'.$c_date.'" <= ndate_general AND approval_general = 2) OR ("'.$c_date.'" >= sdate_research AND "'.$c_date.'" <= ndate_research AND approval_research = 2)';
									
									// Available 
									$data['get_peg']		= $this->m_crud->get_all('v_pegawai');
									$data['get_available']	= $this->m_crud->get_query($qry)->result();

									// Remaining Days
									$data['get_r_days']		= $this->m_crud->get_where('tbl_jen_cuti', array('quota !=' => null))->result();

									// Research
									$data['get_reseach']	= $this->m_crud->get_between('v_research', $c_date, 'start_date', 'end_date', 'id_peg')->result();

									// General
									$data['get_general']	= $this->m_crud->get_between('v_general', $c_date, 'start_date', 'end_date', 'id_peg')->result();

									// Leave
									$data['get_cuti']		= $this->m_crud->get_between('v_cuti', $c_date, 'start_date', 'end_date', 'id_peg')->result();
									
									// Overtime
									$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('date_overtime' => date("d-m-Y")))->result();
								}
							}
						break;

						case 'employees':
							$akses_supervisor	= $this->encryption->decrypt($decodedToken->id_akses) === 1 || $this->encryption->decrypt($decodedToken->id_akses) === '1' ? '1' : (int) $this->encryption->decrypt($decodedToken->id_akses) - 1;
							$akses 				= $this->encryption->decrypt($decodedToken->id_akses);
							$res_peg_leave 		= $this->m_crud->get_where('v_pegawai', array('id_user' => $decodedToken->id_user));
							if ($res_peg_leave->num_rows() > 0) {
								foreach ($res_peg_leave->result() as $tmp) {
									
									$data['token'] 			= $headers['Authorization'];
									$data['get_peg']		= $this->m_crud->get_all('v_pegawai');
									$data['level']			= $this->m_crud->get_all('tb_akses');
									$data['akses']			= $this->m_crud->get_all('tb_akses');
									$data['get_div']		= $this->m_crud->get_all('tb_divisi');
								}
							}
						break;

						default:
							$data = '<h1>'.$page.'</h1>';
					}
					
					switch ($this->encryption->decrypt($decodedToken->id_akses)) {
						case '1':
							$page_allowed = ['home','profile','approval','summary','recfontoday','employees'];
							foreach($page_allowed as $pages) {
								if($page === $pages) {
									$this->load->view('apps/content/'.$page, $data);
								}
							}
							break;
						case '2':
							$page_allowed = ['home','profile','approval','la','research','general','overtime','leave','summary','recfontoday'];
							foreach($page_allowed as $pages) {
								if($page === $pages) {
									$this->load->view('apps/content/'.$page, $data);
								}
							}
							break;
						case '3':
							$page_allowed = ['home','profile','approval','la','research','general','overtime','leave','summary','recfontoday'];
							foreach($page_allowed as $pages) {
								if($page === $pages) {
									$this->load->view('apps/content/'.$page, $data);
								}
							}
							break;
						case '4':
							$page_allowed = ['home','profile','approval','la','research','general','overtime','leave','summary','recfontoday'];
							foreach($page_allowed as $pages) {
								if($page === $pages) {
									$this->load->view('apps/content/'.$page, $data);
								}
							}
							break;
						
						case '5':
							$page_allowed = ['home','profile','la','research','general','overtime','leave','summary','recfontoday'];
							foreach($page_allowed as $pages) {
								if($page === $pages) {
									$this->load->view('apps/content/'.$page, $data);
								}
							}
							break;
					}
				
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Unauthorized!" : "Maaf, Anda Tidak Diizinkan!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$this->load->view('errors/unautorized');
			}
		}

		public function menu() {
			$headers = $this->input->request_headers();

			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					switch ($this->encryption->decrypt($decodedToken->id_akses)) {
						case '1':
							$data = array ([ 
								'allowed' 	=> ['home','profile','approval','today','employees'],
								'denied' 	=> []
							]);

							echo json_encode($data);
							break;
						case '2':
							$data = array ([ 
								'allowed' 	=> ['home','profile','approval','la','lresearch','lgeneral','overtime','leave','summary','today'],
								'denied' 	=> []
							]);

							echo json_encode($data);
							break;
						case '3':
							$data = array ([ 
								'allowed' 	=> ['home','profile','approval','la','lresearch','lgeneral','overtime','leave','summary','today'],
								'denied' 	=> []
							]);

							echo json_encode($data);
							break;
						case '4':
							$data = array ([ 
								'allowed' 	=> ['home','profile','approval','la','lresearch','lgeneral','overtime','leave','summary','today'],
								'denied' 	=> []
							]);

							echo json_encode($data);
							break;
						
						case '5':
							$data = array ([ 
								'allowed' 	=> ['home','profile','la','lresearch','lgeneral','overtime','leave','summary','today'],
								'denied' 	=> ['approval']
							]);

							echo json_encode($data);
							break;
						
						default :
							
						break;
					}
				} else {
					$code = array("code" => false, "err" => "Unauthorized! asd");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$code = array("code" => false, "err" => "Header Not Set!");
				echo json_encode($code, JSON_PRETTY_PRINT);
			}
		}

		public function tables ($tb) {
			$headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$akses 				= $this->encryption->decrypt($decodedToken->id_akses);

					switch ($tb) {
						case 'tb_employees':
							$data['get_peg']		= $this->m_crud->get_all('v_pegawai');
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;
						case 'tb_leave':
							$data['type']			= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
							$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('id_peg' => $decodedToken->id_peg), 'tgl_cuti','DESC')->result();
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;
						case 'tb_ap_leave':
							if ($akses === '1') {
								// Leave
								$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
								$data['get_cuti']		= $this->m_crud->get_all('v_cuti');
							} else {
								$data['type_leave']		= $this->session->bahasa === 'ID' ? $this->m_crud->get_all('tbl_jen_cuti') : $this->global_data('leave_en_type');
								$data['get_cuti']		= $this->m_crud->get_where('v_cuti', array('supervisor' => $decodedToken->id_peg), 'tgl_cuti','DESC')->result();
							}
							
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;

						case 'tb_overtime':
							$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_peg' => $decodedToken->id_peg))->result();
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;

						case 'tb_ap_overtime':
							if ($akses === '1') {
								$data['get_overtime']	= $this->m_crud->get_all('v_overtime');
							} else {
								$data['get_overtime']	= $this->m_crud->get_where('v_overtime', array('id_spv' => $decodedToken->id_peg))->result();
							}
							
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;
							
						case 'tb_general':

							$data['get_general']	= $this->m_crud->get_where('v_general', array('id_peg' => $decodedToken->id_peg))->result();
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;
						
						case 'tb_ap_general':
							if ($akses === '1') {
								// General
								$data['type_general']	= $this->m_crud->get_all('tb_duty_type');
								$data['get_general']	= $this->m_crud->get_all('v_general');
							} else {
								$data['type_general']	= $this->m_crud->get_all('tb_duty_type');
								$data['get_general']	= $this->m_crud->get_where('v_general', array('id_spv' => $decodedToken->id_peg))->result();
							}

							$this->load->view('apps/content/tables/'.$tb, $data);

							break;
						
						case 'tb_research':
							$data['get_general']	= $this->m_crud->get_where('v_research', array('id_peg' => $decodedToken->id_peg))->result();
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;

						case 'tb_ap_research':
							if ($akses === '1') {
								// Research
								$data['type_research']	= $this->m_crud->get_all('tb_type_research');
								$data['get_general']	= $this->m_crud->get_all('v_research');
							} else {
								$data['type_research']	= $this->m_crud->get_all('tb_type_research');
								$data['get_reseach']	= $this->m_crud->get_where('v_research', array('id_spv' => $decodedToken->id_peg))->result();
							}
							
							$this->load->view('apps/content/tables/'.$tb, $data);

							break;
							
						default:
							$this->load->view('Hello world');
							break;
					}
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$this->load->view('errors/unautorized');
			}
		}

		public function unit ($pages, $req) {
			$headers = $this->input->request_headers();
           
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$data['req'] 		= $req;
					$data['get_div']	= $this->m_crud->get_all('tb_divisi');

					$this->load->view('apps/ext_content/'.$pages, $data);
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah!");
					echo json_encode($code, JSON_PRETTY_PRINT);
				}
			} else {
				$this->load->view('errors/unautorized');
			}
		}
}