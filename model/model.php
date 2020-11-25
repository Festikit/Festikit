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
}

Model::Init();
