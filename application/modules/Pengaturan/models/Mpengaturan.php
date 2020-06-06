<?php

class Mpengaturan extends CI_Model {

	function get_data() {
		$this->db->order_by('id', 'ASC');
		return $this->db->get('admin')->result();
	}

	function insert_data($data) {
		return $this->db->insert('admin', $data);
	}

	function get_provinsi(){
		$this->db->order_by('id_prov', 'ASC');
		return $this->db->get('provinsi')->result();

	}
	function get_kabupaten($id){
		$this->db->order_by('id_kab', 'ASC');
		$this->db->where('id_prov', $id);
		return $this->db->get('kabupaten')->result();

	}

	function cek_data($id) {
		$this->db->where('id', $id);
		return $this->db->get('admin')->row();
	}

	function update_data($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update('admin', $data);
	}

	function delete_data($id) {
		$this->db->where('id', $id);
		return $this->db->delete('admin');
	}

	function make_query()
	{
		$this->db->select('admin.*')
				 ->from("admin")
				 ->where('admin.hak_akses !=', 0);
			 if(isset($_POST["search"]["value"]))
			 {
						$this->db->like("admin.nama", $_POST["search"]["value"]);
						// $this->db->or_like("date", $_POST["search"]["value"]);
			 }
			 if(isset($_POST["order"]))
			 {
						$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
			 }
			 else
			 {
						$this->db->order_by('admin.id', 'DESC');
			 }
	}

	function make_datatables(){
			 $this->make_query();
			 if($_POST["length"] != -1)
			 {
						$this->db->limit($_POST['length'], $_POST['start']);
			 }
			 $query = $this->db->get();
			 return $query->result();
	}

	function get_filtered_data(){
			 $this->make_query();
			 $query = $this->db->get();
			 return $query->num_rows();
	}

	function get_all_data()
	{
			 $this->db->select("*");
			 $this->db->from("admin");
			 return $this->db->count_all_results();
	}


}
