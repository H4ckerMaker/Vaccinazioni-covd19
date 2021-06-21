<?php
    $pass = "root";
    $user = "root";
    $db = "covid-19";
    $conn = new mysqli('172.19.0.2:3306',$user,$pass,$db);
    $search = $_POST["search"];
    $output = '';
    $result = $conn->query("SELECT Cognome FROM Utente WHERE Cognome LIKE '".$search."%';");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $output .= $row["Cognome"]."<br>";
        }
    }
    echo $output;
?>
