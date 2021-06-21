<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>account Medico</title>
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
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $id = "";
            $result = $conn->query("SELECT * FROM Medico WHERE Email = '".$email."' AND Password = '".$password."';");
            if(!$result->num_rows > 0){
                echo "<div class=\"container mt-5\">";
                echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
                echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
                echo "<div>";
                echo "Non hai i permessi per vedere questa pagina!";
                echo "  <a href=\"formMedico.html\">Torna indietro.</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                die();
            }
            while($row = $result->fetch_assoc()){
                $num_pazienti = 0;
                ?>
                <div class="bg-primary">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center p-3">
                <div class="text-center col-12 col-md-2"><img id="logo-arpa-header" src="img/logo-arpa-header.png" alt="logo-arpa-bianco"></div>
                <div id="whitetextbanner" class="col-12 col-md-8">Infrastruttura per l'autenticazione e accesso ai servizi</div>
                <div id="whitetextbanner" class="col-12 col-md-2">
                <button class="btn btn-outline-light dropdown-toggle w-100 my-3" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
                        <li><a href="#" class="dropdown-item"><?php echo $row["Nome"]." ".$row["Cognome"]; ?></a></li>
                        <li><a href="formMedico.html" class="dropdown-item">Log Out</a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
                <?php
                echo "<div class=\"container mt-5\">";
                echo "<h2>Medico: ".$row["Nome"]." ".$row["Cognome"]."</h2>";
                $id = $row["Id_Medico"];
                echo "<h4>I tuoi pazienti: </h4>";
                echo "<ul class=\"list-group\">";
                $result = $conn->query("SELECT Nome,Cognome,Id_Utente FROM Utente WHERE Id_Medico = '".$id."';");
                while($row = $result->fetch_assoc()){
                    echo "<li class=\"list-group-item\">";
                    echo "<div class=\"d-flex justify-content-between align-items-center\">";
                    echo "<div class=\"col-2\">".$row["Nome"]." ".$row["Cognome"]."</div>";
                    echo "<div class=\"col-2\"><button id=\"collapseBtn".$num_pazienti."\"class=\"btn btn-primary\" data-bs-toggle=\"collapse\" href=\"#multiCollapse".$num_pazienti."\" role=\"button\" disabled>Sintomi</button></div>";
                    echo "</div>";
                    echo "</li>";
                    $result1 = $conn->query("SELECT Avvertenza.DataOra AS DataOraSintomo,Sintomo.Nome AS NomeSintomo FROM Avvertenza INNER JOIN Sintomo WHERE Avvertenza.Id_Sintomo = Sintomo.Id_Sintomo AND Id_Utente = '".$row["Id_Utente"]."';");
                    if($result1->num_rows > 0){
                        echo "<script>document.getElementById('collapseBtn".$num_pazienti."').disabled = false;</script>";
                        echo "<div class=\"collapse multi-collapse card card-body\" id=\"multiCollapse".$num_pazienti."\">";
                        while($row1 = $result1->fetch_assoc()){
                            echo $row1["DataOraSintomo"]." ".$row1["NomeSintomo"]."<br>";
                        }
                        echo "</div>";
                    }
                    $num_pazienti += 1;
                }
                echo "</ul>";
                echo "</div>";
            }
        }else{
            echo "<div class=\"container mt-5\">";
            echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
            echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
            echo "<div>";
            echo "Completa il form!";
            echo "  <a href=\"formMedico.html\">Torna indietro.</a>";
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
