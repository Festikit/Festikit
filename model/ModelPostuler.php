<?php
require_once File::build_path(array("model", "Model.php"));

class ModelPostuler extends Model
{
  private $postuler_id;
  private $user_id;
  private $festival_id;
  private $postuler_accepted;
  private $venir_avec_vehicule;
  private $besoin_hebergement;
  private $peut_heberger;
  private $configuration_couchage;
  private $arrivee_festival;
  private $depart_festival;
  private $autres_dispos;
  private $experience;


  protected static $object_table = 'postuler';
  protected static $object_model = 'postuler';
  protected static $primary= 'postuler_id';

  public function __construct($id = NULL, $user_id = NULL, $festival_id = NULL, $postuler_accepted = NULL)
  {
    if (!is_null($id) && !is_null($user_id) && !is_null($festival_id) && !is_null($postuler_accepted)) {
      $this->postuler_id = $id;
      $this->user_id = $user_id;
      $this->festival_id = $festival_id;
      $this->postuler_accepted = $postuler_accepted;
    }
  }

  // Getter et Setter: poste_id
  public function getPostulerId()
  {
    return $this->postuler_id;
  }
  public function setPostulerId($postuler_id2)
  {
    $this->postuler_id = $postuler_id2;
  }

  /*
  public static function getAllPostuler()
  {
    try {
      $sql = "SELECT * from postuler";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPostuler');
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

  public static function getPostulerByUserAndFestival($user_id, $festival_id)
  {
    try {
      $sql = "SELECT * from postuler WHERE user_id=:user_id  AND festival_id=:festival_id";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "user_id" => $user_id,
        "festival_id" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPostuler');
      $tab_postuler = $req_prep->fetchAll();

      if (empty($tab_postuler)) return false;
      return $tab_postuler;
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