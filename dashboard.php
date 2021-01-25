<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
 include "config/config.php";
 if(isset($_POST['submit'])){
  $title =  mysqli_real_escape_string($link, trim($_POST['title']));
  $name = mysqli_real_escape_string($link, trim($_POST['name']));
  $salary = mysqli_real_escape_string($link, trim($_POST['salary']));

 // $conn = mysqli_connect("localhost", "root","", "loginsystem") or die("Error". mysqli_connect_error());
   $q ="INSERT INTO data( `title`, `name`, `salary`) VALUES ('$title', '$name', '$salary')";
   if(mysqli_query($link, $q)){
    echo "Your Contact is added";
  }else{
    echo "Error".mysqli_error($link);
}
}


?>


<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <header class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    
    </ul>
  </div>
  <div>
     <a href="logout.php" class="logout">Logout</a>
    </div>
</nav> 
      </header>
      <div class="jumbotron display-2 text-center">
        <h1><?php echo $_SESSION["username"]; ?></h1>
      </div>

    <div class="container"> 
      <div class="row">
        <div class="col-md-6">
         <form style="width:300px" action="" method="post">
         <div class="form-group">
            <input type="text" name="title" placeholder="Title" class="form-control"><br/>
            <input type="text" name="name" placeholder="Name" class="form-control"><br/>
            <input type="text" name="salary" placeholder="Salary" class="form-control"><br/>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
         </div>
         
         </form>
        
        
        
        </div>
        <div class="col-md-6">
        <table class="table">
          <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Name</th>
            <th>Salary</th>
          </tr>
        <?php
         
          $q = "SELECT * FROM data";
          $qry = mysqli_query($link, $q);
          $num = mysqli_num_rows($qry);
          while($result = mysqli_fetch_array($qry)){

        ?>
        
        <tr>
            <td><?php echo $result['id']; ?></td>
            <td><?php echo $result['title']; ?></td>
            <td><?php echo $result['name']; ?></td>
            <td><?php echo $result['salary']; ?></td>
        </tr>
        <?php
       } 
       ?>
        </table>
        
        </div>
      </div>
    </div>  

      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>