<?php
require_once File::build_path(array("model", "Model.php"));

class ModelPoste /*extends Model*/
{

  private $poste_id;
  private $poste_name;
  private $poste_description;
  private $festival_id;

  //protected static $object = 'poste';
  //protected static $primary= 'poste_id';

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