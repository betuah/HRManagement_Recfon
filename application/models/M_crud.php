<?php
    class M_crud extends CI_Model
    {
        function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function sum_data($req, $data, $tbl) {
            $this->db->select_sum($req);
            $this->db->where($data);
            $query = $this->db->get($tbl);

            return $query->result();
        }

        public function count_where_data($req1, $val1, $req2, $val2, $tbl) {
            $this->db->like($req1 , $val1);
            $this->db->like($req2 , $val2);
            $this->db->from($tbl);
            // $query = $this->db->count_all_results();

            return $this->db->count_all_results();
        }

        public function count_leave($val1, $val2, $val3, $year) {
            $this->db->select_sum('lama_hari');
            $this->db->like('id_peg' , $val1);
            $this->db->like('tipe_cuti' , $val2);
            $this->db->like('approval' , $val3);
            $this->db->like('year' , $year);
            $this->db->from('v_cuti');
            $query = $this->db->get();

            return $query->result();
        }

        public function query($query) {
            $query =$this->db->query($query);
            return $query->result();
        }

        public function get_data_distinct($req, $select, $tbl, $data) {
            $this->db->select("DISTINCT($req),$select");
            $query = $this->db->get_where($tbl , $data);

            return $query->result();
        }


        public function get_all($tbl) {
            $query = $this->db->get($tbl);
            return $query->result();
        }

        public function dis_get_where($col, $tb, $data) {
            $this->db->distinct();
            $this->db->group_by($col);
            $query = $this->db->get_where($tb , $data);
            return $query;
        }

        public function get_where($tbl, $data, $req = null, $sort = null) {
            if ($req != null && $sort != null) {
                $this->db->order_by($req, $sort);
            }
            $query = $this->db->get_where($tbl , $data);
            return $query;
        }

        public function get_query ($qry) {
            $query = $this->db->query($qry);
            return $query;
        }

        public function get_between($tbl, $val, $start, $end, $req) {
            $this->db->where('"'.$val.'"'.' BETWEEN '.$start.' AND '.$end.' AND approval = 2');
            $this->db->group_by("$req");
            $query = $this->db->get($tbl);
            return $query;
        }

        public function get_where_limit($limit, $tbl, $data, $req = null, $sort = null) {
            $this->db->limit($limit);
            if ($req != null && $sort != null) {
                $this->db->order_by($req, $sort);
            }
            $query = $this->db->get_where($tbl , $data);
            return $query;
        }

        public function create_trans($tbl1, $tbl2, $data1, $data2) {
            $this->db->trans_start();
            $this->db->insert($tbl1, $data1);
            $this->db->insert($tbl2, $data2);
            $this->db->trans_complete();
 
            return $this->db->trans_status();
        }

        public function create_trans_notif($tbl1, $tbl2, $data1, $data2, $data3) {
            $this->db->trans_start();
            $this->db->insert($tbl1, $data1);
            $this->db->insert($tbl2, $data2);
            $this->db->insert($tbl2, $data3);
            $this->db->trans_complete(); 
 
            return $this->db->trans_status();
        }

        public function create($tbl, $data) {
            $query = $this->db->insert($tbl , $data);

            return $this->db->error();
        }

        public function set_data($tbl, $req, $id, $data) {
            $this->db->where($req, $id);
            $this->db->update($tbl, $data);
        }

        public function delete($tbl, $data) {
            $query = $this->db->delete($tbl, $data);
            return $query;
        }
    }
?>
