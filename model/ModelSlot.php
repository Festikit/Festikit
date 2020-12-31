<?php
require_once File::build_path(array("model", "Model.php"));

class ModelSlot extends Model
{
  private $slot_id;
  private $slot_capacity;
  private $poste_id;
  private $crenau_id;
  private $lieu_id;

  protected static $object_table = 'slot';
  protected static $object_model = 'slot';
  protected static $primary = 'slot_id';

  public function __construct($id = NULL, $slot_capacity = NULL, $poste_id = NULL, $crenau_id = NULL, $lieu_id = NULL)
  {
    if (!is_null($id) && !is_null($slot_capacity) && !is_null($poste_id) && !is_null($crenau_id) && !is_null($lieu_id)) {
      $this->slot_id = $id;
      $this->slot_capacity = $slot_capacity;
      $this->poste_id = $poste_id;
      $this->crenau_id = $crenau_id;
      $this->lieu_id = $lieu_id;
    }
  }

  // Getter et Setter: slot_id
  public function getSlotId()
  {
    return $this->slot_id;
  }
  public function setPostulerId($slot_id2)
  {
    $this->slot_id = $slot_id2;
  }

  /*public static function getAllSlot()
  {
    try {
      $sql = "SELECT * from slot";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelSlot');
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
