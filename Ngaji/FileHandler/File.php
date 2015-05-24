<?php namespace Ngaji\FileHandler;

class File {
	public static function upload($type='img', $name) {
		if (!empty($_FILES[$name]['name'])) {
			$foto = $_FILES[$name]['name'];
			$tmp = $_FILES[$name]['tmp_name'];
			$type = $_FILES[$name]['type'];
			$size = $_FILES[$name]['size'];
			$ubahfile = explode('.', $foto);
			$ubahfile2 = explode('php', $tmp);
			$jadi = $ubahfile2[1];
			$jadi2 = explode('.', $jadi);
			$jadi3 = $jadi2[0] . "." . $ubahfile[1];

			if ($size > 1000000) {
				echo "<i>ukuran file terlalu besar.</i>";
				return false;
			} else {
				if (('image/jpeg' == $type) or ('image/png' == $type) or ('' == $type)) {
					$tmp = $_FILES[$name]['tmp_name'];

					$folder = ABSPATH . "/assets/img/members/" . $jadi3;
					move_uploaded_file($tmp, $folder);

					return $jadi3;
				} else {
					echo "<i>File tidak support.</i>";
					return false;
				}
			}
		}
		return false;
	}
}