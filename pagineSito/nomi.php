<?php
    $pass = "root";
    $user = "root";
    $db = "covid-19";
    $conn = new mysqli('172.19.0.2:3306',$user,$pass,$db);
    $search = $_POST["search"];
    $output = '';
    $result = $conn->query("SELECT Nome FROM Utente WHERE Nome LIKE '".$search."%';");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $output .= $row["Nome"]."<br>";
        }
    }
    echo $output;
?>
