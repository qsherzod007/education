<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../session.php";
include "../header.php";
include "../left.php";
include "../db.php";

$limit = 10;
$sth = $conn->prepare('select g.id, g.title groupTitle, firstName , c.name courseName, r.title roomTitle
from grouup g
inner join course c on g.course_id = c.id
inner join teacher t on g.teacher_id = t.id
inner join room r on g.room_id = r.id limit :lim');
$sth->bindParam(':lim', $limit, PDO::PARAM_INT);
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
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Groups </h4>
                                <a href="/group/add.php" class="btn btn-success d-none d-md-inline-block text-white">Add</a>
                            </div>
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" colspan="2">Title</th>
                                        <th class="border-top-0">Teacher</th>
                                        <th class="border-top-0">Course</th>
                                        <th class="border-top-0">Room</th>
                                        <th class="border-top-0">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($result as $item){
                                        echo "<tr>";
                                        echo "<td style='width:50px;'><span class='round'>S</span></td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['groupTitle'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['firstName'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['courseName'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['roomTitle'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo "<a href=/group/edit.php?id=" . $item['id'] . "><i class='fa fa-pencil-alt'></i> </a> | ";
                                        echo "<a href=/group/delete.php?id=" . $item['id'] . "><i class='fa fa-trash-alt'></i> </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
include "../footer.php";
?>
