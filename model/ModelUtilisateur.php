<?php
require_once File::build_path(array("model", "Model.php"));
//require 'vendor/autoload.php';

use Mailgun\Mailgun;

class ModelUtilisateur extends Model
{

  protected static $object_table = 'user';
  protected static $object_model = 'Utilisateur';
  protected static $primary = 'user_id';


  private $user_id;
  private $user_firstname;
  private $user_lastname;
  private $user_mail;
  private $user_phone;
  private $user_birthdate;
  private $user_picture;
  private $user_postal_code;
  private $user_driving_license;
  private $user_password;
  private $admin;


  public function __construct($id = NULL, $firstname = NULL, $lastname = NULL, $mail = NULL, $phone = NULL, $birthdate = NULL, $picture = NULL, $postal_code = NULL, $driving_license = NULL, $password = NULL, $admin = NULL)
  {
    if (!is_null($id) && !is_null($firstname) && !is_null($lastname) && !is_null($mail) && !is_null($phone) && !is_null($birthdate) && !is_null($picture) && !is_null($postal_code) && !is_null($driving_license) && !is_null($password) && !is_null($admin)) {
      $this->user_id = $id;
      $this->user_firstname = $firstname;
      $this->user_lastname = $lastname;
      $this->user_mail = $mail;
      $this->user_phone = $phone;
      $this->user_birthdate = $birthdate;
      $this->user_picture = $picture;
      $this->user_postal_code = $postal_code;
      $this->user_driving_license = $driving_license;
      $this->user_password = $password;
      $this->admin = $admin;
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

  public function getAdmin()
  {
    return $this->admin;
  }

  public static function envoyerEmailVerfification($user_mail)
  {
    $mgClient = Mailgun::create('f0fe14b78df21c891f0c59e428d56dfc-e5da0167-a189ce96', 'https://api.eu.mailgun.net');
    $domain = "sandboxb45e2bee9dca45d49a719b980ca80ef7.mailgun.org";
    $params = array(
      'from'    => 'postmaster@sandboxb45e2bee9dca45d49a719b980ca80ef7.mailgun.org',
      'to'      => $user_mail,
      'subject' => 'Hello',
      'text'    => 'Testing some Mailgun awesomness!'
    );

    $mgClient->messages()->send($domain, $params);
  }

  public function validerEmail($codeSecretDeValidation)
  {
    // if($this->codeSecretDeValidation == $codeSecretDeValidation){
    //   $this->mailValide = true;
    // }
  }

  public static function getUserByMail($user_mail)
  {
    try {
      $sql = "SELECT * from user WHERE user_mail=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $user_mail,
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

  public static function checkPassword($user_mail, $mot_de_passe_chiffre)
  {
    try {
      $sql = "SELECT user_mail,user_password FROM user WHERE user_mail=:user_mail AND user_password=:mot_de_passe_chiffre";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "user_mail" => $user_mail,
        "mot_de_passe_chiffre" => $mot_de_passe_chiffre
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_utilisateur = $req_prep->fetchAll();

      if (!empty($tab_utilisateur)) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public static function getIdByMail($user_mail)
  {
    try {
      $sql = "SELECT user_id from user WHERE user_mail=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $user_mail,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_user_id = $req_prep->fetchAll();

      if (empty($tab_user_id))
        return false;
      return $tab_user_id[0];
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function boolAdminByUserId($user_id)
  {
    try {
      $sql = "SELECT admin from user WHERE user_id=:nom_tag";
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

  public static function estResponsable($user_id, $festival_id)
  {
    try {
      $sql = "SELECT * FROM responsable WHERE user_id=:user_id AND festival_id=:festival_id";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "user_id" => $user_id,
        "festival_id" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelResponsable');
      $estResponsable = $req_prep->fetchAll();
      if (empty($estResponsable)) {
        return false;
      } else {
        return true;
      }
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function estCandidatOuBenevole($user_id, $festival_id)
  {
    try {
      $sql = "SELECT p.user_id FROM postuler p JOIN festival f ON p.festival_id=f.festival_id WHERE p.user_id=:id_tag AND f.festival_id=:festival_id_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "id_tag" => $user_id,
        "festival_id_tag" => $festival_id,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPostuler');
      $estCandidatOuBenevole = $req_prep->fetchAll();
      if (empty($estCandidatOuBenevole)) {
        return false;
      } else {
        return true;
      }
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function mailExiste($user_mail)
  {
    try {
      $sql = "SELECT * from user WHERE user_mail=:nom_tag";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "nom_tag" => $user_mail,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_mail = $req_prep->fetchAll();
      if (!empty($tab_mail)) //le mail n'existe pas
      {
        return true;
      } else //le mail existe deja
      {
        return false;
      }
      return $tab_mail[0];
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
