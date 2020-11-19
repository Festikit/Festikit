<?php
require_once File::build_path(array("model", "Model.php"));

class ModelLieu extends Model
{
  private $lieu_id;
  private $nom_lieu;
  private $festival_id;
  

  protected static $object_table = 'lieu';
  protected static $object_model = 'lieu';
  protected static $primary= 'lieu_id';

  public function __construct($id = NULL, $nom_lieu = NULL, $festival_id = NULL)
  {
    if (!is_null($id) && !is_null($nom_lieu) && !is_null($festival_id)) {
      $this->lieu_id = $id;
      $this->nom_lieu = $nom_lieu;
      $this->festival_id = $festival_id;
    }
  }

  // Getter et Setter: lieu_id
  public function getLieuId()
  {
    return $this->lieu_id;
  }
  public function setLieuId($lieu_id2)
  {
    $this->lieu_id = $lieu_id2;
  }

  // Getter et Setter : nom_lieu
  public function getNomLieu()
  {
    return $this->nom_lieu;
  }
  public function setNomLieu($nom_lieu2)
  {
    $this->nom_lieu = $nom_lieu2;
  }

  public static function getAllLieu()
  {
    try {
      $sql = "SELECT * from lieu";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelLieu');
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