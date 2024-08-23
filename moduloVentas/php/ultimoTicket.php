<?php
session_start();
require "../../conn/conn.php";

    $sqlMaxTicket="SELECT MAX(`idVenta`) maxTicket FROM `ventas`;";
    $maxTicket=$conn->prepare($sqlMaxTicket);
    $maxTicket->execute();
    $maxTicket=$maxTicket->fetch(PDO::FETCH_ASSOC);

echo json_encode($maxTicket);
?>