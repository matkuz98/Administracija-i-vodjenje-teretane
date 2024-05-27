<?php


require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = $_POST['username'];
  $password = $_POST ['password'];


$sql = "SELECT admin_id, password FROM admins WHERE username= ?";//znak pitanja nam sluzi da bi preko njega koristili bind_param
   
 $run = $conn->prepare($sql);//prepare =  ovo znaci da cemo pripremiti sql za izvrsenje tj znaci da cemo zastititi kod  
 $run->bind_param("s", $username);//ovo sluzi da mysql sam proveri da li se admin nalazi u bazi 
 $run->execute();// execute = ovo znaci naredba da se kod izvrsi  
 $results = $run->get_result();// ovo znaci da pokrenemo rezultat



if($results->num_rows == 1) {
   $admin = $results ->fetch_assoc();//Ovo znaci da cemo u varijabli admin iz rezultata ucitati podatke iz baze u formi asocijativnog niza 

if(password_verify($password, $admin['password'])) {
  $_SESSION['admin_id'] = $admin['admin_id'];//Ovo nam sluzi da ne mozemo pristupiti admin_dashbordu nikako osim ukucavanjem tacnih admin podataka
   header('location: admin_dashboard.php');
} else{
  $_SESSION[ 'error'] = "Netacan password !!";
  $conn->close();
   header('location: index.php');
   exit;// Obavezno nakon svakog izvrsetka sesije komanda exit
}
  } else {
  $_SESSION['error'] = "Netacan username !!";
  $conn->close();
  header('location: index.php');
  exit;// Obavezno nakon svakog izvrsetka sesije komanda exit
}

}

?>






<!DOCTYPE html>
<html>
  <head>
    
   <title>Admin Login</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
if (isset($_SESSION['error'])){
  echo $_SESSION['error'] . "<br>";// Pokretanje sesion greske 

  unset($_SESSION ['error']);// Ovo nam sluzi da ne bi nam stalno stajao navedeni tekst greske
}
?>
<h2> Admin Login</h2><br>

<div class="container"> 
<div class="row mb-5">
          <div class="col-md-6">


<form action ="" method="POST">
 
<label for="username" style="font-weight: bold; font-size: larger; font-family: Arial, sans-serif;">Username:</label>
<input class="form-control"    type="text" name="username" style="background-color: lightblue;"><br><br>

<label for="password" style="font-weight: bold; font-size: larger; font-family: Arial, sans-serif;">Password:</label>
<input class="form-control"     type="password" name="password" style="background-color: lightblue;"><br><br>

  <button type="submit" class="btn btn-primary">Login</button>
</div>
</div>
</div>

</form>
</body>
</html>

</form>
</body>
</html>