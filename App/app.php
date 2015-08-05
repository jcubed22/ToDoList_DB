<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    //_SESSION - Stores cookies
    session_start();

    if (empty($_SESSION['list_of_tasks'])) {
      $_SESSION['list_of_tasks'] = array();
    }

    $app = new Silex\Application();

    //Twig Path
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    //Route and Controller
    $app->get("/", function() use ($app) {

      $all_tasks = Task::getAll();

      return $app['twig']->render('tasks.html.twig', array('tasks' => $all_tasks));

    });

    //tasks POST
    $app->post("/tasks", function() use ($app) {
      $task = new Task($_POST['description']);
      $task->save();
      return $app['twig']->render('create_task.html.twig', array('newtask' => $task));

    });
    //tasks POST delete
    $app->post("/delete_tasks", function() use ($app) {

        Task::deleteAll();

        return $app['twig']->render('delete_tasks.html.twig');
    });

    return $app;
?>
