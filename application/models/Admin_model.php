<?php
class Admin_model extends CI_Model{

	public function insert($data){
			$query = $this->db->insert('user_tbl',$data);
			if ($query) {
				return true;
			}
	}

	public function select_all(){
		$query = $this->db->get('user_tbl');
		 return $query->result();
	}

	public function select_where($table,$where){
		$query = $this->db->
					select('*')
					->where($where)
					->get($table);
					return $query->result();
	}


	public function update($table,$data,$where){
		$query = $this->db->set($data)
							->where($where)
							->update($table);
							return TRUE;				
	}


	public function delete($table, $where){
		$query = $this->db->where($where)->delete($table);
		if ($query) {
			return true;
		}
	}
}













