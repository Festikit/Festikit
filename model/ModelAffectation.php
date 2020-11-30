<?php
require_once File::build_path(array("model", "Model.php"));

class ModelAffectation extends Model
{
  private $affectation_id;
  private $slot_id;
  private $user_id;
  

  protected static $object_table = 'affectation';
  protected static $object_model = 'affectation';
  protected static $primary= 'affectation_id';

  public function __construct($id = NULL, $slot_id = NULL, $user_id = NULL)
  {
    if (!is_null($id) && !is_null($slot_id) && !is_null($user_id)) {
      $this->affectation_id = $id;
      $this->slot_id = $slot_id;
      $this->user_id = $user_id;
    }
  }

  // Getter et Setter: affectation_id
  public function getAffectationId()
  {
    return $this->affectation_id;
  }
  public function setAffectationId($affectation_id2)
  {
    $this->affectation_id = $affectation_id2;
  }

  /*
  public static function getAllAffectation()
  {
    try {
      $sql = "SELECT * from affectation";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelAffectation');
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
}