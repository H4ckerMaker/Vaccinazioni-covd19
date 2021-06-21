<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Account Vaccinatore</title>
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
        if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["centro_vaccinale"])) {
            $centro_vaccinale = $_POST["centro_vaccinale"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $id = "";
            $result = $conn->query("SELECT * FROM Vaccinatore WHERE Email ='".$email."' AND Password = '".$password."';");
            if(!$result->num_rows > 0){
                echo "<div class=\"container mt-5\">";
                echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
                echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
                echo "<div>";
                echo "Non hai i permessi per vedere questa pagina!";
                echo "  <a href=\"formVaccinatore.html\">Torna indietro.</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                die();
            }
            while($row = $result->fetch_assoc()){
                $id = $row["Id_Vaccinatore"];
                $nomeVaccinatore = $row["Nome"];
                $cognomeVaccinatore = $row["Cognome"];
            }
        }else{
            echo "<div class=\"container mt-5\">";
            echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
            echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
            echo "<div>";
            echo "Completa il form!";
            echo "  <a href=\"formVaccinatore.html\">Torna indietro.</a>";
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
                        <li><a href="#" class="dropdown-item"><?php echo $nomeVaccinatore." ".$cognomeVaccinatore; ?></a></li>
                        <li><a href="formVaccinatore.html" class="dropdown-item">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2>Aggiungi Dati Vaccinato</h2>
        <form action="accountVaccinatore.php" method="post">
            <div class="mb-3">
                <label for="InputName" class="form-label">Nome</label>
                <input id="InputName" type="text" name="Nome" class="form-control" required>
                <div id="collapse-name" class="card card-body d-none"></div>
            </div>
            <div class="mb-3">
                <label for="InputSurname" class="form-label">Cognome</label>
                <input id="InputSurname" type="text" name="Cognome" class="form-control" required>
                <div id="collapse-surname" class="card card-body d-none"></div>
            </div>
            <div class="mb-3">
                <label for="InputNameMedic" class="form-label">Nome Medico</label>
                <input id="InputNameMedic" type="text" name="Nome_Medico" class="form-control" required>
                <div id="collapse-namemedic" class="card card-body d-none"></div>
            </div>
            <div class="mb-3">
                <label for="InputSurnameMedic" class="form-label">Cognome Medico</label>
                <input id="InputSurnameMedic" type="text" name="Cognome_Medico" class="form-control" required>
                <div id="collapse-surnamemedic" class="card card-body d-none"></div>
            </div>
            <input type="hidden" name="email" value="<?php echo $_POST["email"]?>">
            <input type="hidden" name="password" value="<?php echo $_POST["password"]?>">
            <input type="hidden" name="centro_vaccinale" value="<?php echo $_POST["centro_vaccinale"]?>">
            <input class="btn btn-primary" type="submit" value="Aggiungi">
        </form>
        <script>
            $(document).ready(function(){
                $('#InputName').keyup(function(){
                    var input = $(this).val();
                    if(input != ''){
                        $.ajax({
                            url: "nomi.php",
                            method: "post",
                            data:{search:input},
                            dataType: "text",
                            success: function(data)
                            {
                                if(data != ""){
                                    $('#collapse-name').html(data);
                                    $('#collapse-name').removeClass('d-none');
                                }
                            }
                        })
                    }else{
                        $('#collapse-name').addClass('d-none');
                    }
                });
                $('#InputSurname').keyup(function(){
                    var input = $(this).val();
                    if(input != ''){
                        $.ajax({
                            url: "cognomi.php",
                            method: "post",
                            data:{search:input},
                            dataType: "text",
                            success: function(data)
                            {
                                if(data != ""){
                                    $('#collapse-surname').html(data);
                                    $('#collapse-surname').removeClass('d-none');
                                }
                            }
                        })
                    }else{
                        $('#collapse-surname').addClass('d-none');
                    }
                });
                $('#InputNameMedic').keyup(function(){
                    var input = $(this).val();
                    if(input != ''){
                        $.ajax({
                            url: "nomimedici.php",
                            method: "post",
                            data:{search:input},
                            dataType: "text",
                            success: function(data)
                            {
                                if(data != ""){
                                    $('#collapse-namemedic').html(data);
                                    $('#collapse-namemedic').removeClass('d-none');
                                }
                            }
                        })
                    }else{
                        $('#collapse-namemedic').addClass('d-none');
                    }
                });
                $('#InputSurnameMedic').keyup(function(){
                    var input = $(this).val();
                    if(input != ''){
                        $.ajax({
                            url: "cognomimedici.php",
                            method: "post",
                            data:{search:input},
                            dataType: "text",
                            success: function(data)
                            {
                                if(data != ""){
                                    $('#collapse-surnamemedic').html(data);
                                    $('#collapse-surnamemedic').removeClass('d-none');
                                }
                            }
                        })
                    }else{
                        $('#collapse-surnamemedic').addClass('d-none');
                    }
                });
            });
        </script>
    </div>
    <?php
        if(!empty($_POST["Nome"]) && !empty($_POST["Cognome"]) && !empty($_POST["Nome_Medico"] && !empty($_POST["Cognome_Medico"]))){
            $nome = $_POST["Nome"];
            $cognome = $_POST["Cognome"];
            $nome_medico = $_POST["Nome_Medico"];
            $cognome_medico = $_POST["Cognome_Medico"];
            $id_medico = "";
            $id_utente = "";
            $current_date = date ('Y-m-d H:i:s');
            $result = $conn->query("SELECT Id_Medico FROM Medico WHERE Nome = '".$nome_medico."' AND Cognome = '".$cognome_medico."';");
            if($result->num_rows > 0){
                echo "<div class=\"container mt-5\">";
                echo "<div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">";
                echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>";
                echo "<div>";
                echo "Medico trovato!";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                while($row = $result->fetch_assoc()){
                    $id_medico = $row["Id_Medico"];
                }
                $result = $conn->query("SELECT Id_Utente FROM Utente WHERE Nome = '".$nome."' AND Cognome = '".$cognome."';");
                if($result->num_rows > 0){
                    echo "<div class=\"container mt-5\">";
                    echo "<div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">";
                    echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>";
                    echo "<div>";
                    echo "Paziente trovato!";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    while($row = $result->fetch_assoc()){
                        $id_utente = $row["Id_Utente"];
                    }
                    $conn->query("UPDATE Utente SET Id_Medico = '".$id_medico."' WHERE Id_Utente = '".$id_utente."';");
                    echo "<div class=\"container mt-5\">";
                    echo "<div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">";
                    echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>";
                    echo "<div>";
                    echo "Medico assegnato al paziente!";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    $conn->query("INSERT INTO Vaccinazione (Id_Utente,Id_Vaccinatore,DataOra,Centro_Vaccinale) VALUES ('".$id_utente."','".$id."','".$current_date."','".$centro_vaccinale."');");
                    echo "<div class=\"container mt-5\">";
                    echo "<div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">";
                    echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>";
                    echo "<div>";
                    echo "Vaccinazione aggiornata!";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }else{
                    echo "<div class=\"container mt-5\">";
                    echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
                    echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
                    echo "<div>";
                    echo "Paziente non esistente!";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }else{
                echo "<div class=\"container mt-5\">";
                echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
                echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
                echo "<div>";
                echo "Medico non esistente!";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            
        }else{
            echo "<div class=\"container mt-5\">";
            echo "<div class=\"alert alert-danger d-flex align-items-center\" role=\"alert\">";
            echo "<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\"><use xlink:href=\"#exclamation-triangle-fill\"/></svg>";
            echo "<div>";
            echo "Completa il form!";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "<div class=\"container mt-5\">";
        echo "</div>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>
