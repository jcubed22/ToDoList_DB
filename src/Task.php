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
      $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
      $tasks = array();

      foreach($returned_tasks as $task) {
          $description = $task['description'];
          $new_task = new Task($description);
          array_push($tasks, $new_task);
      }
      return $tasks;
    }

    //Static Method - Deletes Tasks
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }

    }
  ?>
