<script>
  function validarForm() {
    document.forms["formulari"]["userSecret"].value = btoa(document.forms["formulari"]["user"].value);
    document.forms["formulari"]["passSecret"].value = btoa(document.forms["formulari"]["pass"].value);
  }
</script>
<?php
require_once("./usuaris.php");
require_once("./passwords.php");
$credOK = False;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    for ($i = 0; $i <= 3; $i++)
    {
        $usuaris = USUARIS[$i];
        $passwords = PASSWORDS[$i] ;
        if(base64_decode($_POST["userSecret"])==$usuaris && password_verify(base64_decode($_POST["passSecret"]),password_hash($passwords, PASSWORD_DEFAULT))){
            header("Location: https://educem.com/");
            $credOK = True;
        }
    }
    if ($credOK == False) {
      echo'<script type="text/javascript">
      alert("Usuari o contrasenya incorrectes.");
      window.location.href="M9-UF1-P1.php";
      </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="M9-UF1-P1.css">
    <title>Benvingut/da!</title>
</head>
<body>
    <div class="box">
      <h1>Benvingut/da!</h1>
      <form method="post" name="formulari" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validarForm()">
      <input type="mail" name="user" placeholder="Usuari"/>
        <input type="password" name="pass" placeholder="Contrasenya"/>
        <input type="hidden" name="userSecret"/>
        <input type="hidden" name="passSecret"/>
        <input class="boto" value="Login" type="submit">
      </form>
      <p>No recordes la teva contrasenya? <span><a href="#">Recupera-la</a></span></p>
    </div>
</body>
</html>
