<?php
  $task_id = $_GET['id'];

  //Instantiate Database object
  $database = new Database;
  //Query
  $database->query('SELECT * FROM tasks WHERE id = :id');
  $database->bind(':id',$task_id);
  $row = $database->single();
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Task Name:</th>
      <td><?php echo $row['task_name']; ?></td>
    </tr>
    <tr>
      <th scope="row">Description:</th>
      <td><?php echo $row['task_body']; ?></td>
    </tr>
    <tr>
      <th scope="row">Due Date:</th>
      <td><?php echo $row['due_date']; ?></td>
    </tr>
    <tr>
      <th scope="row">Task Name:</th>
      <td>
        <?php if($row['is_complete'] == 1){
            echo '<strong>Complete</strong>';
          } else {
            echo '<strong>Incomplete</strong>';
          }; 
        ?>
      </td>
    </tr>
  </tbody>
</table>

<a href="?page=edit_task&id=<?php echo $row['id']; ?>">Edit Task</a>