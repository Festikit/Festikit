<?php
require_once File::build_path(array("model", "Model.php"));

class ModelDisponible extends Model
{
  private $disponible_id;
  private $user_id;
  private $creneau_id;
  

  protected static $object_table = 'disponible';
  protected static $object_model = 'disponible';
  protected static $primary= 'disponible_id';

  public function __construct($id = NULL, $user_id = NULL, $creneau_id = NULL)
  {
    if (!is_null($id) && !is_null($user_id) && !is_null($creneau_id)) {
      $this->affectation_id = $id;
      $this->user_id = $user_id;
      $this->creneau_id = $creneau_id;
    }
  }

  // Getter et Setter: affectation_id
  public function getDisponibleId()
  {
    return $this->disponible_id;
  }
  public function setDisponibleId($disponible_id2)
  {
    $this->disponible_id = $disponible_id2;
  }

  /*
  public static function getAllDisponible()
  {
    try {
      $sql = "SELECT * from disponible";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponible');
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