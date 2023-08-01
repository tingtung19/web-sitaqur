<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M__grafik extends CI_Model
{

	public function jml_kurban($tahun, $jenis, $id = '')
	{
		$in_lembaga = ($id != '') ? "AND NOTA.LEMBAGA_ID = " . $id . "
					GROUP BY NOTA.LEMBAGA_ID, NOTA.NOTA_NO, NOTA.NOTA_TGL_TERIMA;" : " GROUP BY NOTA.LEMBAGA_ID ,NOTA.NOTA_NO,NOTA.NOTA_TGL_TERIMA";
		$q = "SELECT NOTA.LEMBAGA_ID ,NOTA.NOTA_NO, sum(KERANJANG.KERANJANG_QTY) as jml, NOTA.NOTA_TGL_TERIMA
		FROM NOTA
		JOIN KERANJANG ON KERANJANG.NOTA_NO = NOTA.NOTA_NO
		JOIN HEWAN ON HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID
		WHERE HEWAN.HEWAN_JENIS = '" . $jenis . "' AND
		NOTA.NOTA_TGL_TERIMA LIKE '%" . $tahun . "%' 
		$in_lembaga ";

		$this->query = $this->db->query($q)->row()->jml;

		return ($this->query == NULL) ? 0 : $this->query;
	}
}

/* End of file M__grafik.php */
/* Location: ./application/models/M__grafik.php */