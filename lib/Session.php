<?php
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_admin() {
    	return (!empty($_SESSION['admin']) && $_SESSION['admin']);
    }
    
    public static function is_responsable() {
    	return (!empty($_SESSION['responsable']) && $_SESSION['responsable']);
	}
}