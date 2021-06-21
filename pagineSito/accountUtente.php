<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>accountUtente</title>
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
        $id_utente = "";
        $conn = new mysqli('172.19.0.2:3306',$user,$pass,$db);
        if (!empty($_POST["nome"]) && !empty($_POST["password"]) && !empty($_POST["cognome"])) {
            $cognome = $_POST["cognome"];
            $nome = $_POST["nome"];
            $password = $_POST["password"];
            $result = $conn->query("SELECT Id_Utente, Utente.Residenza AS Residenza, Utente.Luogo_Nascita AS Luogo_Nascita, Utente.Data_Nascita AS Data_Nascita, Medico.Nome AS Nome_Medico, Medico.Cognome AS Cognome_Medico FROM Utente 
                INNER JOIN Medico
                WHERE Utente.Id_Medico = Medico.Id_Medico AND
                Utente.Nome ='".$nome."' AND Utente.Cognome = '".$cognome."' AND Utente.Password = '".$password."';");
            if(!$result->num_rows > 0){
                $result = $conn->query("SELECT Id_Utente, Utente.Residenza AS Residenza, Utente.Luogo_Nascita AS Luogo_Nascita, Utente.Data_Nascita AS Data_Nascita FROM Utente
                WHERE Utente.Nome ='".$nome."' AND Utente.Cognome = '".$cognome."' AND Utente.Password = '".$password."';");
                if(!$result->num_rows > 0){
                    echo "<div class=\"container mt-5\">";
                    echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
                    echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
                    echo "<div>";
                    echo "Non hai i permessi per vedere questa pagina!";
                    echo "  <a href=\"formUtente.html\">Torna indietro.</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                die();
                }
            }
            while($row = $result->fetch_assoc()){
                $id_utente = $row["Id_Utente"];
                $residenza = $row["Residenza"];
                $luogo_nascita = $row["Luogo_Nascita"];
                $data_nascita = $row["Data_Nascita"];
                if(!empty($row["Nome_Medico"])){
                    $nome_medico = $row["Nome_Medico"];
                    $cognome_medico = $row["Cognome_Medico"];
                }else{
                    $nome_medico = "Medico da inserire!!";
                    $cognome_medico = "Medico da inserire!!";
                }
            }
        }else{
            echo "<div class=\"container mt-5\">";
            echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
            echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
            echo "<div>";
            echo "Completa il form!";
            echo "  <a href=\"formUtente.html\">Torna indietro.</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            die();
        }
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
                        <li><a href="#" class="dropdown-item"><?php echo $nome." ".$cognome; ?></a></li>
                        <li><a href="formUtente.html" class="dropdown-item">Log Out</a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        <?php
        echo "<div class=\"container mt-5\">";
        echo "<h2>Dati personali</h2>";
        echo "<table class=\"table\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope=\"col\">Nome</th>";
        echo "<th scope=\"col\">Cognome</th>";
        echo "<th scope=\"col\">Residenza</th>";
        echo "<th scope=\"col\">Luogo Nascita</th>";
        echo "<th scope=\"col\">Data Nascita</th>";
        echo "<th scope=\"col\">Medico Curante</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "<td>".$nome."</td>";
        echo "<td>".$cognome."</td>";
        echo "<td>".$residenza."</td>";
        echo "<td>".$luogo_nascita."</td>";
        echo "<td>".$data_nascita."</td>";
        echo "<td>".$nome_medico." ".$cognome_medico."</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";

        echo "<h2 class=\"mt-4\">Vaccinazioni Utente</h2>";
        echo "<table class=\"table\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope=\"col\">Data e Ora Vaccinazione</th>";
        echo "<th scope=\"col\">Centro vaccinale</th>";
        echo "<th scope=\"col\">Vaccinatore</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $result = $conn->query("SELECT * FROM Vaccinazione WHERE Id_Utente = '".$id_utente."';");
        while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["DataOra"]."</td>";
        switch($row["Centro_Vaccinale"]){
            case 1:
                $centrovaccinale = "Quartiere est";
                break;
            case 2:
                $centrovaccinale = "Quartiere sud";
                break;
            case 3:
                $centrovaccinale = "Quartiere ovest";
                break;        
        }
        echo "<td>".$centrovaccinale."</td>";
        $result1 = $conn->query("SELECT Nome,Cognome FROM Vaccinatore WHERE Id_Vaccinatore = '".$row["Id_Vaccinatore"]."';");
        while($row1 = $result1->fetch_assoc()){
            echo "<td>".$row1["Nome"]." ".$row1["Cognome"]."</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>
