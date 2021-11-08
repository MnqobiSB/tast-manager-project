<?php
  $database = new Database;
 
  //LOG IN
  if($_POST['login_submit']){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $enc_password = md5($password);
    //Query
    $database->query("SELECT * FROM users WHERE username = :username AND password = :password");
    $database->bind(':username',$username);
    $database->bind(':password',$enc_password);
    $rows = $database->resultset();
    $count = count($rows);
    if($count > 0){
      session_start();
      //Assign session variables
      $_SESSION['username']   = $username;
      $_SESSION['password']   = $password;
      $_SESSION['logged_in']  = 1;
      header("Location:index.php");
    } else {
      $login_msg[] = 'Sorry, username or password is incorrect';
    }
  }
?>

<div class="card border-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">
    Sign In
  </div>
  <div class="card-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <?php if(!$_SESSION['logged_in']) : ?>
      <?php foreach($login_msg as $msg) : ?>
      <?php echo $msg.'<br />'; ?>
      <?php endforeach; ?>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>

      <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Sign In Now" name="login_submit" />
      </div>
      <?php else : ?>
      <h2>Welcome</h2>
      <?php endif; ?>
    </form>
  </div>
</div>