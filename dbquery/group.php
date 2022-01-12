<?php
function getGroups($connection){
    $state = $connection->prepare("select * from grouup");
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}
