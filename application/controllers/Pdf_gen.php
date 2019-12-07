<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pdf_gen extends CI_Controller {
 
	public function report($req, $id, $token)
	{
		
		$this->load->library('pdf');

		$headers = $token;
		
		if ($headers && !empty($headers)) {
			$decodedToken = AUTHORIZATION::validateToken($headers);
			if ($decodedToken != false) {

				switch ($req) {
					case 'leave':
						$res   	= $this->m_crud->get_where('v_cuti', array('id_cuti' => $id));
						break;
					case 'general':
						$res   	= $this->m_crud->get_where('v_general', array('id_general' => $id));
						break;
					case 'research':
						$res   	= $this->m_crud->get_where('v_research', array('id_research' => $id));
						break;
				}

				$akses		= $this->m_crud->get_where('tb_akses', array('id_akses' => $this->encryption->decrypt($decodedToken->id_akses)))->result();
				$cuti		= $res->result();

				if ($res->num_rows() > 0) {
					$data['get_akses'] 	= $akses[0];
					$data['get_data'] 	= $cuti[0];

					$this->pdf->setPaper('A4', 'potrait');
					$this->pdf->filename = "submission_".$id.".pdf";
					$this->pdf->load_view('apps/report/R_'.$req, $data, true);
				} else {
					$code = array("code" => false, "error" => $this->session->bahasa === 'EN' ? "Invalid Token!" : "Maaf, Token tidak sah! cuy");
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