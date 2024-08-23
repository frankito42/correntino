<?php
session_start();
require "../conn/conn.php";

if (empty($_SESSION['establecimiento'])) {
    # code...
    echo json_encode("no");
}else{
    
    $sqlEstablecimientos="SELECT `idEsta`, `nombreEsta` FROM `establecimiento` where idEsta=$_SESSION[establecimiento]";
    $establecimientos=$conn->prepare($sqlEstablecimientos);
    $establecimientos->execute();
    $establecimientos=$establecimientos->fetch(PDO::FETCH_ASSOC);
    echo json_encode($establecimientos);

}

?>