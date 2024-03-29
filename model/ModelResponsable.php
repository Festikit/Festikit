<?php
require_once File::build_path(array("model", "Model.php"));

class ModelResponsable extends ModelUtilisateur
{

    protected static $object_table = 'responsable';
    protected static $object_model = 'responsable';
    protected static $primary = 'responsable_id';

    private $responsable_id;
    private $user_id;
    private $festival_id;

    public function __construct($responsable = NULL, $user = NULL, $festival = NULL)
    {
        if (!is_null($responsable) && !is_null($user) && !is_null($festival)) {
            $this->responsable_id = $responsable;
            $this->user_id = $user;
            $this->festival_id = $festival;
        }
    }

    // Getter et Setter: responsable_id
    public function getResponsableId()
    {
        return $this->responsable_id;
    }
    public function setResponsableId($id2)
    {
        $this->responsable_id = $id2;
    }

    // Getter et Setter: user_id
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($userId2)
    {
        $this->user_id = $userId2;
    }

    // Getter et Setter: festival_id
    public function getFestivalId()
    {
        return $this->festival_id;
    }
    public function setFestivalId($festivalId2)
    {
        $this->festival_id = $festivalId2;
    }

    public static function getNomResponsable()
    {
        try {
            $sql = "SELECT u.user_firstname, u.user_lastname, responsable_id from user u JOIN responsable r ON  u.user_id = r.user_id";
            $rep = Model::$pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllResponsable()
    {
        try {
            $sql = "SELECT u.user_id, user_firstname, user_lastname, u.user_picture from user u JOIN responsable r ON u.user_id = r.user_id";
            $rep = Model::$pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getResponsableByFestival($festival_id)
    {
        try {
            $sql = "SELECT u.user_id, u.user_firstname, u.user_lastname, u.user_picture, responsable_id from user u JOIN responsable r ON u.user_id = r.user_id WHERE festival_id=:festival_id";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "festival_id" => $festival_id,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_responsable = $req_prep->fetchAll();

            if (empty($tab_responsable))
                return false;
            return $tab_responsable;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getResponsableByFestivalAndUser($festival_id, $user_id)
    {
        try {
            $sql = "SELECT * from responsable WHERE festival_id=:festival_id AND user_id=:user_id";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "festival_id" => $festival_id,
                "user_id" => $user_id,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelResponsable');
            $tab_responsable = $req_prep->fetchAll();

            if (empty($tab_responsable))
                return false;
            return $tab_responsable[0];
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function boolResponsableByUserId($user_id)
    {
        try {
            $sql = "SELECT * from responsable WHERE user_id=:nom_tag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "nom_tag" => $user_id,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelResponsable');
            $tab_responsable = $req_prep->fetchAll();

            if (empty($tab_responsable))
                return false;
            return true;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getResponsableByUser($user_id)
    {
        try {
            $sql = "SELECT * from responsable WHERE user_id=:nom_tag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "nom_tag" => $user_id,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelResponsable');
            $responsable = $req_prep->fetchAll();

            if (empty($responsable))
                return false;
            return $responsable[0];
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
