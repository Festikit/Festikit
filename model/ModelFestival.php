<?php
require_once File::build_path(array("model", "Model.php"));

class ModelFestival extends Model
{

  protected static $object_table = 'festival';
  protected static $object_model = 'festival';
  protected static $primary = 'festival_id';


  private $festival_id;
  private $festival_name;
  private $festival_startdate;
  private $festival_enddate;
  private $festival_description;
  private $city;
  private $user_id;



  public function __construct($id = NULL, $name = NULL, $startdate = NULL, $enddate = NULL, $description = NULL, $city = NULL, $user_id = NULL)
  {
    if (!is_null($id) && !is_null($name) && !is_null($startdate) && !is_null($enddate) && !is_null($description) && !is_null($city) && !is_null($user_id)) {
      $this->festival_id = $id;
      $this->festival_name = $name;
      $this->festival_startdate = $startdate;
      $this->festival_enddate = $enddate;
      $this->festival_description = $description;
      $this->city = $city;
      $this->user_id = $user_id;
    }
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

  // Getter et Setter: festival_name
  public function getFestivalName()
  {
    return $this->festival_name;
  }
  public function getFestivalDescription()
  {
    return $this->festival_description;
  }
  public function getFestivalStartDate()
  {
    return $this->festival_startdate;
  }
  public function getFestivalEndDate()
  {
    return $this->festival_enddate;
  }
  public function setFestivalName($name2)
  {
    $this->festival_name = $name2;
  }

  // Getter et Setter: city
  public function getFestivalCity()
  {
    return $this->city;
  }
  public function setFestivalCity($city2)
  {
    $this->city = $city2;
  }

  //Getter user_id
  public function getCreatorId(){
    return $this->user_id;
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



  /*public static function getAllFestivals()
  {
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
  */

  /*
  public static function getFestivalsById($festival_id)
  {
    try {
      $sql = "SELECT * from festival WHERE festival_id=:id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
      $tab_festival = $req_prep->fetchAll();

      if (empty($tab_festival)) return false;
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
  */


  // postuler_accepted = 1 dans la table "postuler"
  public static function getBenevolesAcceptedByFestival($festival_id)
  {
    try {
      $sql = "SELECT u.user_id, u.user_firstname, u.user_lastname FROM postuler p JOIN user u ON u.user_id=p.user_id WHERE festival_id=:id_tag AND postuler_accepted=:accepted_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
        "accepted_tag" => 1,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_benevoleAccepted = $req_prep->fetchAll();

      if (empty($tab_benevoleAccepted)) return false;
      return $tab_benevoleAccepted;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public function accepterUtilisateur($user_id)
  {
    try {
      $sql = "UPDATE postuler SET postuler_accepted = 1 WHERE user_id = :user_id AND festival_id = :festival_id";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "user_id" => $user_id,
        "festival_id" => $this->festival_id
      );

      $req_prep->execute($values);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue lors de l\'acceptation de l\'utilisateur';
      }
      die();
    }
  }

  public function refuserUtilisateur($user_id)
  {
    $festival_id = $_GET['festival_id'];    
      try {
        $sql = "UPDATE postuler SET postuler_accepted = 0 WHERE user_id = :user_id AND festival_id = :festival_id";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
          "user_id" => $user_id,
          "festival_id" => $this->festival_id
        );

        $req_prep->execute($values);
      } catch (PDOException $e) {
        if (Conf::getDebug()) {
          echo $e->getMessage(); // affiche un message d'erreur
        } else {
          echo 'Une erreur est survenue lors du refus de l\'utilisateur';
        }
        die();
      }
  }

  public function ajouterResponsable($user_id, $festival_id)
  {
    try {
      $sql = "INSERT INTO responsable(user_id,festival_id) VALUES ('$user_id','$festival_id')";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "user_id" => $user_id,
        "festival_id" => $festival_id
      );

      $req_prep->execute($values);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue lors de l\'ajout du responsable';
      }
      die();
    }
  }





  // postuler_accepted = 0 dans la table "postuler"
  public static function getCandidatsByFestival($festival_id)
  {
    try {
      $sql = "SELECT u.user_id, u.user_firstname, u.user_lastname FROM postuler p JOIN user u ON u.user_id=p.user_id WHERE festival_id=:id_tag AND postuler_accepted=:accepted_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
        "accepted_tag" => 0,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_candidature = $req_prep->fetchAll();

      if (empty($tab_candidature)) return false;
      return $tab_candidature;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }


  // Pour générer le formulaire dynamiquement
  // et afficher les postes par festival
  public static function getPostesByFestival($festival_id)
  {
    try {
      $sql = "SELECT p.poste_id, p.poste_name, p.poste_description FROM poste p WHERE festival_id=:id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
      $tab_poste = $req_prep->fetchAll();

      if (empty($tab_poste)) return false;
      return $tab_poste;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  // et afficher les créneaux par festival
  public static function getCreneauxByFestival($festival_id)
  {
    try {
      $sql = "SELECT creneau_id, creneau_startdate, creneau_enddate FROM creneau WHERE festival_id=:id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_creneau = $req_prep->fetchAll();

      if (empty($tab_creneau)) return false;
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

  // Pour générer le formulaire dynamiquement
  public static function getJoursByFestival($festival_id)
  {
    try {
      $sql = "SELECT DISTINCT CAST(creneau_startdate AS DATE) AS creneau_startdate FROM creneau WHERE festival_id=:id_tag ORDER BY creneau_startdate";

      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_date = $req_prep->fetchAll();

      if (empty($tab_date)) return false;

      //foreach ($tab_date as $date) {
      //$date = date_format($date,'l j F');
      //$date = DateTime::createFromFormat('Y-m-d', $date);
      //$date = date_create_from_format('j-M-Y',$date);
      //$date = date_format($date, 'd-m-Y');
      //$date = $date->format('d-m-Y');
      // }

      //$dateTime = DateTime::createFromFormat('Y-m-d', $date);
      //$dateTime = new DateTime($date);
      //$date = $dateTime->format('d-m-Y');


      return $tab_date;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }


  public static function getResponsableByFestival($festival_id)
  {
    try {
      $sql = "SELECT r.responsable_id, r.festival_id, u.user_id, u.user_firstname, u.user_lastname FROM responsable r JOIN user u ON u.user_id=r.user_id WHERE festival_id=:id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelResponsable');
      $tab_responsable = $req_prep->fetchAll();

      if (empty($tab_responsable)) return false;
      return $tab_responsable;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  // Pour générer le formulaire dynamiquement (disponible)
  public static function getCreneauxGeneriquesHeure($festival_id)
  {
    try {
      $sql = "SELECT DISTINCT CAST(creneau_startdate AS TIME) AS creneau_startdate , CAST(creneau_enddate AS TIME) AS creneau_enddate FROM creneau WHERE festival_id=:id_tag AND CAST(creneau_startdate AS DATE) <= DATE '2001-02-01'";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_creneaux_generique_heure = $req_prep->fetchAll();

      if (empty($tab_creneaux_generique_heure)) return false;

      return $tab_creneaux_generique_heure;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  //pour un tableau affichant chaques creneaux par jour
  public static function getCreneauxGeneriquesHeureByJour($festival_id,$jour)
  {
    try {
      $sql = "SELECT DISTINCT CAST(creneau_startdate AS TIME) AS creneau_startdate , CAST(creneau_enddate AS TIME) AS creneau_enddate 
      FROM creneau WHERE festival_id=:id_tag AND CAST(creneau_startdate AS DATE) = DATE '$jour'";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_creneaux_generique_heure = $req_prep->fetchAll();

      if (empty($tab_creneaux_generique_heure)) return false;

      return $tab_creneaux_generique_heure;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  // Pour générer le formulaire dynamiquement (disponible)
  public static function getCreneauxGeneriquesDate($festival_id)
  {
    try {
      $sql = "SELECT DISTINCT CAST(creneau_startdate AS DATE) AS creneau_startdate FROM creneau WHERE festival_id=:id_tag AND CAST(creneau_startdate AS DATE) <= DATE '2001-02-01'";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_creneaux_generique_date = $req_prep->fetchAll();

      if (empty($tab_creneaux_generique_date)) return false;

      return $tab_creneaux_generique_date;
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
  Penser a mettre les creneau des paramètres au format datetime pour pouvoir les comparer avec ceux de la bd
  */
  public static function getCreneauxIdByDateHeure($festival_id, $creneau_startdate, $creneau_enddate)
  {
    try {
      $sql = "SELECT creneau_id FROM creneau WHERE festival_id=:id_tag AND creneau_startdate=:creneau_startdate AND creneau_enddate=:creneau_enddate";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $festival_id,
        "creneau_startdate" => $creneau_startdate,
        "creneau_enddate" => $creneau_enddate,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCreneau');
      $tab_creneau_id = $req_prep->fetchAll();

      if (empty($tab_creneau_id)) return false;

      return $tab_creneau_id[0];
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function getFestivalByResponsable($user_id)
  {
    try {
      $sql = "SELECT * FROM festival f JOIN responsable r ON f.festival_id = r.festival_id WHERE r.user_id=:id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $user_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
      $tab_festival = $req_prep->fetchAll();

      if (empty($tab_festival)) return false;
      return $tab_festival;

    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function getCreatorByFestival($user_id)
  {
    try {
      $sql = "SELECT * FROM user u JOIN festival f ON u.user_id = f.user_id WHERE f.user_id=:id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $user_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
      $tab_festival = $req_prep->fetchAll();

      if (empty($tab_festival)) return false;
      return $tab_festival;

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
