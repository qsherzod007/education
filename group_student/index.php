<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../session.php";
include "../header.php";
include "../left.php";
include "../db.php";
include "../dbquery/student.php";
include "../dbquery/group.php";

$students = getStudents($conn);
$groups = getGroups($conn);

$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$start = ($page - 1) * 10;
$sql = $conn->prepare('select student_id from group_student');
$sql->execute();
$count = $sql->rowCount();
$pages_count = ceil($count / 10);



$limit = 10;
$sth = $conn->prepare('select gs.id gs_id, concat(s.firstName, " ", s.lastName) fullName, g.title group_title
from group_student gs
inner join grouup g on gs.group_id = g.id
inner join student s on gs.student_id = s.id limit :off, :lim ');
$sth->bindParam(':lim', $limit, PDO::PARAM_INT);
$sth->bindParam(':off', $start, PDO::PARAM_INT);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);




?>


    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex">
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">StudentsGroup </h4>
                                <a href="/group_student/add.php" class="btn btn-success d-none d-md-inline-block text-white">Add</a>
                            </div>
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" colspan="2">FullName</th>
                                        <th class="border-top-0">GroupTitle</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($result as $item){
                                        echo "<tr>";
                                        echo "<td style='width:50px;'><span class='round'>S</span></td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['fullName'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['group_title'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo "<a href=/group_student/edit.php?id=" . $item['gs_id'] . "><i class='fa fa-pencil-alt'></i> </a> | ";
                                        echo "<a href=/group_student/delete.php?id=" . $item['gs_id'] . "><i class='fa fa-trash-alt'></i> </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                for ($j = 1; $j <= $pages_count; $j++) {
                                        echo "<a class='btn btn-info d-none d-md-inline-block text-white' href='index.php?page=$j'> $j </a>"." ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
include "footer.php";
?>
