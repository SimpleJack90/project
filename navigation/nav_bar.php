<?php 


?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
<div class="container">
  <a class="navbar-brand" href="../main/articles.php">Article</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mx-5">
    <?php 
      if($session->checkSession()){
        ?>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php 
         echo $session->getUserName();
       
         ?>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="#">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../main/logout.php">Logout</a>
        </div>
      </li>
    <?php  
        }else{
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="../main/login.php">Login<span class="sr-only">(current)</span></a>
      </li>
        <?php } ?>
      
      
    </ul>
    
  </div>
  </div>
</nav>
<


</script>