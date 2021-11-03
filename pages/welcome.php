<h2>Welcome to Task Manager!</h2>

<?php
  if($_SESSION['logged_in']){
    //Instantiate Database object
    $database = new Database;

    //Get logged in user
    $list_user = $_SESSION['username'];

    //Query
    $database->query('SELECT * FROM lists WHERE list_user=:list_user');
    $database->bind(':list_user',$list_user);
    $rows = $database->resultset();

    echo '<h3>Here are your current lists:</h3>';
    if($rows){
      echo '<ul class="items">';
      foreach($rows as $list){
        echo '<li><a href="?page=list&id='.$list['id'].'">'.$list['list_name'].'</a></li>';
      }
      echo '</ul>';
    } else {
      echo 'There are no lists available - <a href="index.php?page=new_list">Create One Now</a>';
    }	
  } else {
    echo "<p>Task Manager is a small but helpful application where you can create and manage tasks to make your life easier.
    Just register and login and you can start adding tasks</p>";
  }
?>