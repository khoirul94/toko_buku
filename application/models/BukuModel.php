<?php 
/**
 * 
 */
class BukuModel extends CI_Model{
	//fungsi untuk menampilkan semua data buku
	function view(){
		return $this->db->get('buku')->result();
	}
}
?>