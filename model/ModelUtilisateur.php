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

  //protected static $object = 'utilisateur';
  //protected static $primary= 'user_id';

  public function __construct($id = NULL, $firstname = NULL, $lastname = NULL, $mail = NULL, $phone = NULL, $birthdate = NULL, $picture = NULL)
  {
    if (!is_null($id) && !is_null($firstname) && !is_null($lastname) && !is_null($mail) && !is_null($phone) && !is_null($birthdate) && !is_null($picture)) {
      $this->user_id = $id;
      $this->user_firstname = $firstname;
      $this->user_lastname = $lastname;
      $this->user_mail = $mail;
      $this->user_phone = $phone;
      $this->user_birthdate = $birthdate;
      $this->user_lastname = $picture;
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
    try{
    $sql = "DELETE FROM user WHERE user_id =:nom_tag";
    $req_prep = Model::$pdo->prepare($sql);
    $values = array(
      "nom_tag" => $id,
    );
    $req_prep->execute($values);
  }
  catch (PDOException $e){
    if (Conf::getDebug()){
      echo $e->getMessage();
    }
    else echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
    die();  
    }
  }

  public function update($data)
    {
        try {
            $sql = "UPDATE user SET user_firstname = :user_firstname, user_lastname = :user_lastname, user_mail = :user_mail, 
             user_phone = :user_phone, user_birthdate = :user_birthdate WHERE user_id = :user_id";

            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "user_id" => $data['user_id'],
                "user_firstname" => $data['user_firstname'],
                "user_lastname" => $data['user_lastname'],
                "user_mail" => $data['user_mail'],
                "user_phone" => $data['user_phone'],
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

    // postuler_accepted = true dans la table "postuler"
  public static function getBenevoleAcceptedByFestival($festival_id) {
    try {
      $sql = "SELECT p.user_id FROM postuler p JOIN festival f ON p.festival_id=f.festival_id WHERE f.festival_id=:id_tag AND postuler_accepted=:accepted_tag";
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
}
