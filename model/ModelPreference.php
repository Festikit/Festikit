<?php
require_once File::build_path(array("model", "Model.php"));

class ModelPreference extends Model
{
  private $preference_id;
  private $user_id;
  private $poste_id;
  private $rang;

  protected static $object_table = 'preference';
  protected static $object_model = 'preference';
  protected static $primary = 'preference_id';

  public function __construct($id = NULL, $user_id = NULL, $poste_id = NULL, $rang = NULL)
  {
    if (!is_null($id) && !is_null($user_id) && !is_null($poste_id) && !is_null($rang)) {
      $this->lieu_id = $id;
      $this->user_id = $user_id;
      $this->poste_id = $poste_id;
      $this->rang = $rang;
    }
  }

  // Getter et Setter: preference_id
  public function getPreferenceId()
  {
    return $this->preference_id;
  }
  public function setPreferenceId($preference_id2)
  {
    $this->preference_id = $preference_id2;
  }

  // Getter : user_id
  public function getUserId()
  {
    return $this->user_id;
  }


  // Getter : poste_id
  public function getPosteId()
  {
    return $this->poste_id;
  }


  // Getter et Setter : rang
  public function getRang()
  {
    return $this->rang;
  }
  public function setRang($rang2)
  {
    $this->rang = $rang2;
  }

  /*
  public static function getAllPreference()
  {
    try {
      $sql = "SELECT * from preference";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPreference');
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

  public static function getPreferenceByUserAndFestival($user_id, $festival_id)
  {
    try {
      $sql = "SELECT * from preference p JOIN poste po ON p.poste_id=po.poste_id WHERE user_id=:user_id  AND festival_id=:festival_id";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "user_id" => $user_id,
        "festival_id" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPreference');
      $tab_preference = $req_prep->fetchAll();

      if (empty($tab_preference)) return false;
      return $tab_preference;
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
