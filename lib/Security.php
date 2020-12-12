<?php

class Security {

	private static $seed = '6bV51oV2X3';

	public static function hacher($texte_en_clair) {
		$texte_en_clair = self::$seed . $texte_en_clair;
		$texte_hache = hash('sha256', $texte_en_clair);
		return $texte_hache;
	}
}
?>