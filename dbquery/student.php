<?php
function getStudents($connection){
    $state = $connection->prepare("select * from student");
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}
