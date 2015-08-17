<?php


    class Task
    {
    private $description;

    //Constructor
    function __construct($description)
    {
      $this->description = $description;
    }

    //Setter
    function setDescription($new_description)
    {
      $this->description = (string) $new_description;
    }

    //Getter
    function getDescription()
    {
      return $this->description;
    }

    //Calls a save method
    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}');");
    }

    //Getter - Static method
    static function getAll()
    {
      return $_SESSION['list_of_tasks'];
    }

    //Static Method - Deletes Tasks
    static function deleteAll()
    {
        $_SESSION['list_of_tasks'] = array();
    }

    }
  ?>
