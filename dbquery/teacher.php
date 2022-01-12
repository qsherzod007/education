<?php
function getTeachers($connection){
    $state = $connection->prepare("select * from teacher");
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}
