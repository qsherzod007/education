<?php
function getRegions($connection){
    $state = $connection->prepare("select * from region");
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}
