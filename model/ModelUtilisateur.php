<?php
require_once File::build_path(array("model", "Model.php"));

class ModelUtilisateur /*extends Model*/
{

  private $user_id;
  private $user_firstname;
  private $user_lastname;
  private $user_mail;
  private $user_phone;
  private $user_birthdate;
  private $user_picture;
  private $user_postal_code;
  private $user_driving_license;

  //protected static $object = 'utilisateur';
  //protected static $primary= 'user_id';

  public function __construct($id = NULL, $firstname = NULL, $lastname = NULL, $mail = NULL, $phone = NULL, $birthdate = NULL, $picture = NULL, $postal_code = NULL, $driving_license = NULL)
  {
    if (!is_null($id) && !is_null($firstname) && !is_null($lastname) && !is_null($mail) && !is_null($phone) && !is_null($birthdate) && !is_null($picture) && !is_null($postal_code) && !is_null($picture)) {
      $this->user_id = $id;
      $this->user_firstname = $firstname;
      $this->user_lastname = $lastname;
      $this->user_mail = $mail;
      $this->user_phone = $phone;
      $this->user_birthdate = $birthdate;
      $this->user_picture = $picture;
      $this->user_postal_code = $postal_code;
      $this->user_driving_license = $driving_license;
    }
  }

  // Getter et Setter: user_id
  public function getId()
  {
    return $this->user_id;
  }
  public function setId($id2)
  {
    $this->user_id = $id2;
  }

  // Getter et Setter: user_firstname
  public function getFirstname()
  {
    return $this->user_firstname;
  }
  public function setFirstname($firstname2)
  {
    $this->user_firstname = $firstname2;
  }

  // Getter et Setter: user_lastname
  public function getLastname()
  {
    return $this->user_lastname;
  }
  public function setLastname($lastname2)
  {
    $this->user_lastname = $lastname2;
  }

  // Getter et Setter: user_mail
  public function getMail()
  {
    return $this->user_mail;
  }
  public function setMail($mail2)
  {
    $this->user_mail = $mail2;
  }

  // Getter et Setter: user_phone
  public function getPhone()
  {
    return $this->user_phone;
  }
  public function setPhone($phone2)
  {
    $this->user_phone = $phone2;
  }

  // Getter et Setter: user_birthdate
  public function getBirthdate()
  {
    return $this->user_birthdate;
  }
  public function setBirthdate($birthdate2)
  {
    $this->user_birthdate = $birthdate2;
  }

  // Getter et Setter: user_picture
  public function getPicture()
  {
    return $this->user_picture;
  }
  public function setPicture($picture2)
  {
    $this->user_picture = $picture2;
  }

  // Getter et Setter: user_postal_code
  public function getPostalCode()
  {
    return $this->user_postal_code;
  }
  public function setPostalCode($postal_code2)
  {
    $this->user_postal_code = $postal_code2;
  }

  // Getter et Setter: user_driving_license
  public function getDrivingLicense()
  {
    return $this->user_driving_license;
  }
  public function setDrivingLicense($driving_license2)
  {
    $this->user_driving_license = $driving_license2;
  }

  public static function getAllUtilisateurs()
  {
    try {
      $sql = "SELECT * from user";
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
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

  public static function getUtilisateurById($user_id)
  {
    try {
      $sql = "SELECT * from user WHERE user_id=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $user_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_user = $req_prep->fetchAll();

      if (empty($tab_user))
        return false;
      return $tab_user[0];
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function deleteById($id)
  {
    try {
      $sql = "DELETE FROM user WHERE user_id =:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $id,
      );
      $req_prep->execute($values);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      die();
    }
  }



  public function update($data)
  {
    try {
      $sql = "UPDATE user SET user_firstname = :user_firstname, user_lastname = :user_lastname, user_mail = :user_mail, 
             user_phone = :user_phone, user_birthdate = :user_birthdate, user_postal_code = :user_postal_code WHERE user_id = :user_id";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
        "user_id" => $data['user_id'],
        "user_firstname" => $data['user_firstname'],
        "user_lastname" => $data['user_lastname'],
        "user_mail" => $data['user_mail'],
        "user_phone" => $data['user_phone'],
        "user_postal_code" => $data['user_postal_code'],
        "user_birthdate" => $data['user_birthdate'],
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

  // postuler_accepted = 1 dans la table "postuler"
  public static function getFestivalWhereAccepted($user_id)
  {
    try {
      $sql = "SELECT f.festival_id, f.festival_name FROM postuler p JOIN festival f ON p.festival_id=f.festival_id WHERE p.user_id=:id_tag AND postuler_accepted=:accepted_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $user_id,
        "accepted_tag" => 1,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
      $tab_festivalWhereAccepted = $req_prep->fetchAll();

      if (empty($tab_festivalWhereAccepted)) return false;
      return $tab_festivalWhereAccepted;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }


  // postuler_accepted = 0 dans la table "postuler"
  public static function getFestivalWhereCandidat($user_id)
  {
    try {
      $sql = "SELECT f.festival_id, f.festival_name FROM postuler p JOIN festival f ON p.festival_id=f.festival_id WHERE p.user_id=:id_tag AND postuler_accepted=:accepted_tag";      
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $user_id,
        "accepted_tag" => 0,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFestival');
      $tab_festivalWhereCandidat = $req_prep->fetchAll();

      if (empty($tab_festivalWhereCandidat)) return false;
      return $tab_festivalWhereCandidat;
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public function saveUser(){
    try {
      $sql = "INSERT INTO user (user_id, user_firstname, user_lastname, user_mail, user_phone, user_birthdate, user_picture, user_postal_code, user_driving_license) VALUES (:user_id, :user_firstname, :user_lastname, :user_mail, :user_phone, :user_birthdate, :user_picture, :user_postal_code, :user_driving_license)";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
        "user_id" => $this->user_id,
        "user_firstname" => $this->user_firstname,
        "user_lastname" => $this->user_lastname,
        "user_mail" => $this->user_mail,
        "user_phone" => $this->user_phone,
        "user_picture" => $this->user_picture,
        "user_birthdate" => $this->user_birthdate,
        "user_postal_code" => $this->user_postal_code,
        "user_driving_license" => $this->user_driving_license,
        // TODO: Rajouter les champs manquant 
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

  /*
  public function savePostuler(){
    try{
      $sql = "INSERT INTO postuler(user_id, festival_id, postuler_accepted) VALUES (:user_id, :festival_id, :postuler_accepted)";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
        "user_id" => ,
        "festival_id" => ,
        "postuler_accepted" => 0,
      );
    }
    catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }

  }
  */
  /*
  public function saveDisponible(){
    try{
      $sql = "INSERT INTO disponible () VALUES ()";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array()

    }
    catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public function savePreference(){
    try{
      $sql = "INSERT INTO preference () VALUES ()";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array()

    }
    catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  } */
}
