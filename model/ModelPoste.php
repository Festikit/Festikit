<?php
require_once File::build_path(array("model", "Model.php"));

class ModelPoste extends Model
{

  protected static $object_table = 'poste';
  protected static $object_model = 'poste';
  protected static $primary = 'poste_id';


  private $poste_id;
  private $poste_name;
  private $poste_description;
  private $festival_id;



  public function __construct($id = NULL, $name = NULL, $description = NULL, $festival_id = NULL)
  {
    if (!is_null($id) && !is_null($name) && !is_null($description) && !is_null($festival_id)) {
      $this->poste_id = $id;
      $this->poste_name = $name;
      $this->poste_description = $description;
      $this->festival_id = $festival_id;
    }
  }

  // Getter et Setter: poste_id
  public function getPosteId()
  {
    return $this->poste_id;
  }
  public function setPosteId($poste_id2)
  {
    $this->poste_id = $poste_id2;
  }

  // Getter et Setter: poste_name
  public function getPosteName()
  {
    return $this->poste_name;
  }
  public function setPosteName($poste_name2)
  {
    $this->poste_name = $poste_name2;
  }

  // Getter et Setter: poste_description
  public function getPosteDescription()
  {
    return $this->poste_description;
  }
  public function setPosteDescription($poste_description2)
  {
    $this->poste_description = $poste_description2;
  }

  // Getter et Setter: festival_id
  public function getFestivalId()
  {
    return $this->festival_id;
  }
  public function setFestivalId($id2)
  {
    $this->festival_id = $id2;
  }

   // Getter générique
   public function get($nom_attribut)
   {
     if (property_exists($this, $nom_attribut))
       return $this->$nom_attribut;
     return false;
   }
   // Setter générique
   public function set($nom_attribut, $valeur)
   {
     if (property_exists($this, $nom_attribut))
       $this->$nom_attribut = $valeur;
     return false;
   }

  /*
  public static function getAllPostes()
  {
    try {
      $sql = "SELECT * from poste";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
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

  //SELECT poste_id FROM poste WHERE festival_id = 6 AND poste_name = 'Generique'
  public static function getPosteIdGenByFestival($festival_id)
  {
    try {
      $sql = "SELECT poste_id FROM poste WHERE festival_id=:nom_tag AND poste_name = 'Generique'";      
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
      $tab_poste = $req_prep->fetchAll();
      if(empty($tab_poste))
        return false;
      return $tab_poste[0];
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  
  public static function getPosteById($poste_id)
  {
    try {
      $sql = "SELECT * from poste WHERE poste_id=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $poste_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
      $tab_poste = $req_prep->fetchAll();

      if (empty($tab_poste))
        return false;
      return $tab_poste[0];
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }
  


  /*
  public function update($data)
  {
    try {
      $sql = "UPDATE poste SET poste_name = :poste_name, poste_description = :poste_description WHERE poste_id = :poste_id";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
        "poste_id" => $data['poste_id'],
        "poste_name" => $data['poste_name'],
        "poste_description" => $data['poste_description'],
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
  */

  //>>>>>>> 1211c2969b661d33b0047d0e4f0921ac8612e8b2
}
