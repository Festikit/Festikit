<?php
require_once File::build_path(array("model", "Model.php"));

class ModelCreneau extends Model
{

  protected static $object_table = 'creneau';
  protected static $object_model = 'creneau';
  protected static $primary = 'creneau_id';

  private $creneau_id;
  private $creneau_startdate;
  private $creneau_enddate;
  private $festival_id;
  private $poste_id;



  public function __construct($id = NULL, $startdate = NULL, $enddate = NULL, $festival_id = NULL, $poste_id = NULL)
  {
    if (!is_null($id) && !is_null($startdate) && !is_null($enddate) && !is_null($festival_id) && !is_null($poste_id)) {
      $this->creneau_id = $id;
      $this->creneau_startdate = $startdate;
      $this->creneau_enddate = $enddate;
      $this->festival_id = $festival_id;
      $this->poste_id = $poste_id;
    }
  }

  // Getter et Setter: creneau_id
  public function getCreneauId()
  {
    return $this->creneau_id;
  }
  public function setCreneauId($creneau_id2)
  {
    $this->creneau_id = $creneau_id2;
  }

  // Getter et Setter: creneau_startdate
  public function getCreneauStart()
  {
    return $this->creneau_startdate;
  }
  public function setCreneauStart($creneau_startdate2)
  {
    $this->creneau_startdate = $creneau_startdate2;
  }

  // Getter et Setter: creneau_enddate
  public function getCreneauEnd()
  {
    return $this->creneau_enddate;
  }
  public function setCreneauEnd($creneau_enddate2)
  {
    $this->creneau_enddate = $creneau_enddate2;
  }

  // Getter et Setter: festival_id
  public function getFestivalId()
  {
    return $this->festival_id;
  }
  public function setFestivalId($festival_id2)
  {
    $this->festival_id = $festival_id2;
  }

  // Getter et Setter: festival_id
  public function getPosteId()
  {
    return $this->poste_id;
  }
  public function setPosteId($poste_id2)
  {
    $this->poste_id = $poste_id2;
  }

  /*public static function getAllCreneaux()
  {
    try {
      $sql = "SELECT * from creneau";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
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
  */

  public static function getAllCreneauxByPosteId($poste_id)
  {
    try {
      $sql = "SELECT * from creneau WHERE poste_id=:poste_id";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "poste_id" => $poste_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      return $req_prep->fetchAll();

      if (empty($tab_creneau))
        return false;
      return $tab_creneau;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function getCreneauById($creneau_id)
  {
    try {
      $sql = "SELECT * from creneau WHERE creneau_id=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $creneau_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_creneau = $req_prep->fetchAll();

      if (empty($tab_creneau))
        return false;
      return $tab_creneau[0];
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public function update($data)
  {
    try {
      $sql = "UPDATE creneau SET creneau_startdate = :creneau_startdate, creneau_enddate = :creneau_enddate,
      festival_id = :festival_id, poste_id = :poste_id WHERE creneau_id = :creneau_id";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
        "creneau_id" => $data['creneau_id'],
        "creneau_startdate" => $data['creneau_startdate'],
        "creneau_enddate" => $data['creneau_enddate'],
        "festival_id" => $data['festival_id'],
        "poste_id" => $data['poste_id'],
      );
      // On donne les valeurs et on exécute la requête    
      $req_prep->execute($values);
      // echo $sql;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function deleteById($id)
  {
    try {
      $sql = "DELETE FROM creneau WHERE creneau_id =:creneau_id";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "creneau_id" => $id
      );
      $req_prep->execute($values);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      die();
    }
  }
}
