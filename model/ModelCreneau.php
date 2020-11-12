<?php
require_once File::build_path(array("model", "Model.php"));

class ModelCreneau /*extends Model*/
{
  private $creneau_id;
  private $creneau_startdate;
  private $creneau_enddate;
  private $festival_id;
  private $poste_id;

  //protected static $object = 'creneau';
  //protected static $primary= 'creneau_id';

  public function __construct($id = NULL, $startdate = NULL, $enddate = NULL, $festival_id = NULL, $poste_id = NULL)
  {
    if (!is_null($id) && !is_null($startdate) && !is_null($enddate) && !is_null($festival_id) && !is_null($poste_id)) {
      $this->creneau_id = $id;
      $this->creneau_startdate = $startdate;
      $this->creneau_enddate = $description;
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

  public static function getAllCreneaux()
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
}