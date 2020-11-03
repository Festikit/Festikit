<?php
require_once File::build_path(array("model", "Model.php"));

class ModelFestival /*extends Model*/
{

  private $festival_id;
  private $festival_name;
  private $festival_startdate;
  private $festival_enddate;
  private $festival_description;
  private $city;

  //protected static $object = 'utilisateur';
  //protected static $primary= 'user_id';

  public function __construct($id = NULL, $name = NULL, $startdate = NULL, $enddate = NULL, $description = NULL, $city = NULL)
  {
    if (!is_null($id) && !is_null($name) && !is_null($startdate) && !is_null($enddate) && !is_null($description) && !is_null($city)) {
      $this->festival_id = $id;
      $this->festival_name = $name;
      $this->festival_startdate = $startdate;
      $this->festival_enddate = $enddate;
      $this->festival_description = $description;
      $this->city = $city;
    }
  }

  // Getter et Setter: festival_id
  public function getId()
  {
    return $this->festival_id;
  }
  public function setId($id2)
  {
    $this->festival_id = $id2;
  }

  /* TODO GETTER/SETTER */

  public static function getAllFestivals() {
    try {
      $sql = "SELECT * from festival";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
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

  public static function getFestivalById($festival_id) {
    try {
      $sql = "SELECT * from festival WHERE festival_id=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
      $tab_festival = $req_prep->fetchAll();

      if (empty($tab_festival))
        return false;
      return $tab_festival[0];
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
