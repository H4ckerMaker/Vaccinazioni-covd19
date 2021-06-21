<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Password Utente</title>
</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
</svg>
    <?php
        $pass = "root";
        $user = "root";
        $db = "covid-19";
        $conn = new mysqli('172.19.0.2:3306',$user,$pass,$db);
        if (!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["randomKey"])) {
            $cognome = $_POST["cognome"];
            $nome = $_POST["nome"];
            $randomKey = $_POST["randomKey"];
            $result = $conn->query("SELECT * FROM Utente WHERE Nome ='".$nome."' AND Cognome = '".$cognome."';");
            if(!$result->num_rows > 0){
                echo "<div class=\"container mt-5\">";
                echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
                echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
                echo "<div>";
                echo "Non hai i permessi per vedere questa pagina!";
                echo "  <a href=\"formUtenteNewPass.html\">Torna indietro.</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                die();
            }
            $new_password = hash('md5',$nome.$cognome.$randomKey);
            $conn->query("UPDATE Utente SET Password = '".$new_password."' WHERE Nome ='".$nome."' AND Cognome = '".$cognome."'");
                    echo "<div class=\"container mt-5\">";
                    echo "<div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">";
                    echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>";
                    echo "<div>";
                    echo "La tua password è ".$new_password."<br>";
                    echo "<a href=\"formUtente.html\">Torna al login.</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
        }else{
            echo "<div class=\"container mt-5\">";
            echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
            echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
            echo "<div>";
            echo "Completa il form!";
            echo "  <a href=\"formUtenteNewPass.html\">Torna indietro.</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            die();
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>
