<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Notif extends CI_Controller {

		public function __construct() {
			parent::__construct();
		}

		public function count($stat, $id) {
			$res =  $this->m_crud->count_where_data('stat_notif', $stat, 'id_peg', $id, 'tb_notif');
			return $res;
		}

		public function read($id) {
			$data = array (
				'stat_notif'  => 1
			);

			$this->m_crud->set_data('tb_notif', 'id_notif', $id, $data);

			$res_notif = $this->m_crud->get_where('tb_notif', array('id_notif' => $id));
			if ($res_notif->num_rows() > 0) {
				foreach ($res_notif->result() as $get) {
					$res = array('pages' => $get->pages);
					echo json_encode($res);
				}
			}
		}

		public function get($id) {
			$data['notif_all'] =  $this->m_crud->get_where('tb_notif', array('id_peg' => $id), 'timestamp','DESC')->result();

			$this->load->view('apps/ext_content/notif_view_all', $data);
		}

		public function get_limit($id) {
			$data['notif'] 	= $this->m_crud->get_where_limit('10','tb_notif', array('id_peg' => $id),'timestamp','DESC')->result();
			$data['count'] 	= $this->count('0', $id);
			$data['id_peg'] = $id;
	
			$this->load->view('apps/ext_content/notif', $data);
		}
}