<?php
require_once File::build_path(array("config", "Conf.php"));

class Model
{

  public static $pdo;

  public static function Init()
  {
    $host = Conf::getHostname();
    $dbname = Conf::getDatabase();
    $login = Conf::getLogin();
    $pass = Conf::getPassword();

    try {
      self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }

  public static function selectAll()
  {
    $table_name = static::$object_table;
    $model_name = static::$object_model;
    $class_name = 'Model' . ucfirst($model_name);
    $pdo = Model::$pdo;
    $sql = "SELECT * from " . $table_name;
    $rep = $pdo->query($sql);
    $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
    return $rep->fetchAll();
  }

  public static function select($primary) {
    try {
        $table_name = static::$object_table;
        $model_name = static::$object_model;
        $class_name = 'Model' . ucfirst($model_name);
        $primary_key = static::$primary;
        $sql = "SELECT * from $table_name WHERE $primary_key=:primary";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "primary" => $primary
        );
        // On donne les valeurs et on exécute la requête	 
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_results = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_results))
            return false;
        return $tab_results[0];
    } catch (PDOException $e) {
        if (Conf::getDebug()) {
            echo $e->getMessage(); // affiche un message d'erreur
        } else {
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
    }
  }

  public static function delete($primary) {
    try {
        $table_name = static::$object_table;
        $primary_key = static::$primary;
        $sql = "DELETE FROM $table_name WHERE $primary_key=:primary;";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "primary" => $primary
        );
        // On donne les valeurs et on exécute la requête	 
        return $req_prep->execute($values);
    } catch (PDOException $e) {
        if (Conf::getDebug()) {
            echo $e->getMessage(); // affiche un message d'erreur
        } else {
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
    }
  }

  public static function update($data) {
    try {
        $table_name = static::$object_table;
        $primary_key = static::$primary;
        $set_parts = array();
        foreach ($data as $key => $value) {
            $set_parts[] = "$key=:$key";
        }
        $set_string = join(',', $set_parts);
        $sql = "UPDATE $table_name SET $set_string WHERE $primary_key=:$primary_key";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        // On donne les valeurs et on exécute la requête	 
        return $req_prep->execute($data);
    } catch (PDOException $e) {
        if (Conf::getDebug()) {
            echo $e->getMessage(); // affiche un message d'erreur
        } else {
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
    }
}


  

public static function save($data)
  {
    $table_name = static::$object_table;
    $primary_key = static::$primary;

    try {
      $sql = "INSERT INTO $table_name ( ";
      foreach ($data as $name => $value) {
        $sql = $sql . "$name";
        if ($name != array_key_last($data)) {
          $sql = $sql . ", ";
        }
      }
      $sql = $sql . ") VALUES (";
      foreach ($data as $name => $value) {
        $sql = $sql . ":$name";
        if ($name != array_key_last($data)) {
          $sql = $sql . ", ";
        }
      }
      $sql = $sql . ")";

      //echo $sql;

      $rep_prep = Model::$pdo->prepare($sql);
      $rep_prep->execute($data);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage();
      }
      return false;
    }
  }
  

  /*public function save() {
    try {
        $table_name = static::$object_table;
        
        // ReflectionClass ou écrire les attributs en dur // >> La classe ReflectionClass rapporte des informations sur une classe.
        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PRIVATE); // >> Récupère les propriétés
        
        $attributes = array();
        $data = array();
        
        foreach ($props as $prop) {
            $attributes[] = $prop->getName();
            $data[$prop->getName()] = $this->get($prop->getName());
        }
        $into_string = '(' . join(',',$attributes) . ')';
        
        // Rajoute ":" avant les attributs
        function my_prepend($s) { 
            return ":" . $s;                
        }
        $values_string = '(' . join(',', array_map("my_prepend",$attributes)) . ')'; // array_map — Applique une fonction sur les éléments d'un tableau           
        
        $sql = "INSERT INTO $table_name $into_string VALUES $values_string";
        
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        
        // On donne les valeurs et on exécute la requête	 
        return $req_prep->execute($data);
    } catch (PDOException $e) {
        if (Conf::getDebug()) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry
                return false;
            }
            echo $e->getMessage(); // affiche un message d'erreur
        } else {
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
    }
  }
  */
}

Model::Init();
