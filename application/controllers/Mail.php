<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// Initialize REST_Controller
	require APPPATH . '/libraries/REST_Controller.php';

	class Mail extends CI_Controller {

		public function __construct() {
			parent::__construct();
 
			$this->load->library('email', $this->config->item('mail_config'));
		}

		public function mail_test() {
			// print_r($this->config->item('mail_config'));
		}

		public function send() {

			$data['title'] = '';
			$data['name'] = '';
			$data['msg_tittle'] = '';
			$data['msg'] = '';
			$data['link'] = '';

			$mail_content = $this->load->view('mail/test',$data,true);

			$to_mail = 'betuah@seamolec.org';
			
			$this->email->from('no-reply@seameo-recfon.org', 'Notification');
			$this->email->to($to_mail); 
			$this->email->subject('Notification');
			$this->email->message($mail_content);
	
			// Tampilkan pesan sukses atau error
			if ($this->email->send()) {
				echo 'Sukses! email berhasil dikirim.';
			} else {
				echo 'Error! email tidak dapat dikirim.';
			}
		}
}