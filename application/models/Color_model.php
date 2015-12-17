<?php

class Color_model extends CI_Model {

	public function sample ($id, $image_url) {

		$upload_path = 'public/uploads/' . $id . '.jpg';

		copy($image_url, $upload_path); // Copy file

		$this->load->library('colorthief');

		$rgb = colorthief::getColor($upload_path, 8); // Get color
		$hex = "#";

		$hex .= str_pad(dechex($rgb[0]), 2, '0', STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[1]), 2, '0', STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[2]), 2, '0', STR_PAD_LEFT);

		return $hex;

	 }
}