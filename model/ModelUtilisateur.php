<?php
require_once File::build_path(array("model","Model.php"));

class ModelUtilisateur /*extends Model*/ {
   
  private $user_id;
  private $user_firstname;
  private $user_lastname;
  private $user_mail;
  private $user_phone;
  private $user_birthdate;
  private $user_picture;

  //protected static $object = 'utilisateur';
  //protected static $primary= 'user_id';

  public function __construct($id = NULL, $firstname = NULL, $lastname = NULL, $mail = NULL, $phone = NULL, $birthdate = NULL, $picture = NULL) {
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
  public function getId() {
    return $this->user_id;  
  }
  public function setId($id2) {
    $this->user_id = $id2;
  }

  // Getter et Setter: user_firstname
  public function getFirstname() {
    return $this->user_firstname;  
  } 
  public function setfirstname($firstname2) {
    $this->user_firstname = $firstname2;
  }

  // Getter et Setter: user_lastname
  public function getlastname() {
    return $this->user_lastname;  
  }  
  public function setlastname($lastname2) {
    $this->user_lastname = $lastname2;
  }

  // Getter et Setter: user_mail
  public function getmail() {
    return $this->user_mail;  
  }
  public function setmail($mail2) {
    $this->user_mail = $mail2;
  }

  // Getter et Setter: user_phone
  public function getphone() {
    return $this->user_phone;  
  }
  public function setphone($phone2) {
    $this->user_phone = $phone2;
  }

  // Getter et Setter: user_birthdate
  public function getbirthdate() {
    return $this->user_birthdate;  
  }
  public function setbirthdate($birthdate2) {
    $this->user_birthdate = $birthdate2;
  }

  // Getter et Setter: user_picture
  public function getpicture() {
    return $this->user_picture;  
  }
  public function setpicture($picture2) {
    $this->user_picture = $picture2;
  }

  public static function getAllUtilisateurs() {
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

  public static function getAllUtilisateurById($user_id) {
      try {
          $sql = "SELECT * from user WHERE user_id=:nom_tag";
          $req_prep = Model::$pdo->prepare($sql);
          $values = array(
              "nom_tag" => $user_id,
          );
          $req_prep->execute($values);
          $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
          $tab_voit = $req_prep->fetchAll();

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

}

?>