<?php

require_once File::build_path(array("model","ModelSlot.php"));

class ControllerSlot {

    public static function readAll() {
        $tab_s = ModelSlot::getAllSlot();

        $pagetitle = 'Liste slots';
        $controller = 'slot';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>
