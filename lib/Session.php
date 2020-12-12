<?php
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_createur() {
    	return (!empty($_SESSION['createur']) && $_SESSION['createur']);
    }
    
    public static function is_responsable() {
    	return (!empty($_SESSION['responsable']) && $_SESSION['responsable']);
	}
}