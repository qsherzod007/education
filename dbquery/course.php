<?php
function getCourses($connection){
    $state = $connection->prepare("select * from course");
    $state->execute();
    return $state->fetchAll(PDO::FETCH_ASSOC);
}
