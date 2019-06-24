
<?php

require_once '../config/database.php';
require_once '../objects/users.php';
require_once '../utilities/session.php';

$session=new Session();




 $error;

if(isset($_POST['submit'])){

    $error="Both fields are required.";

    if(!empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['email']) && isset($_POST['password']) ){

        $email=trim($_POST['email']);
        $password=trim($_POST['password']);

        $database_connection=new DatabaseConnection;

        $db=$database_connection->getConnection();
        $user= new Users($db);
        

       $stmt= $user->CheckIfLogged($email,$password);

        $num=$stmt->rowCount();

        if($num>0){

          $row=$stmt->fetch(PDO::FETCH_ASSOC);

            $session->setSession($row['id'],$row['user_name']);

            header('Location: articles.php');
            $error="";
        }
        else{
            $error="Wrong email or password";
        }
    }
   }

?>

<html>
    <title>Article List</title>
<head>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/fontawesome-free-5.9.0-web/css/all.css" >
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php 
require_once '../navigation/nav_bar.php';
?>

<?php 
  if($session->checkSession()){

  ?>
  <div class="container login-container">
  <div style="width:800px; color:blue; margin:80px auto;">
    You are already logged in.
  </div>
  </div>
  <?php }else{?>
<div class="container login-container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" name="submit" value="Login" />
                        </div>
                        <div class="form-group">
                           <?php

                           if(isset($error)){
                               echo'<p style="color:red">'. $error.'</p>';
                           }

                           $error="";
                           ?>
                        </div>
                    </form>
                </div>
            </div>
</div>

                          <?php 
                        }
                        ?>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../assets/fontawesome-free-5.9.0-web/js/all.js"></script>
</body>

</html>