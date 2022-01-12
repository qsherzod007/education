<?php
function getRooms($connection){
    $state = $connection->prepare("select * from room");
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}
