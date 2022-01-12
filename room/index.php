<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../session.php";
include "../header.php";
include "../left.php";
include "../db.php";

$limit = 10;
$sth = $conn->prepare('select id, title, room_number from room limit :lim');
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
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Rooms </h4>
                                <a href="/room/add.php" class="btn btn-success d-none d-md-inline-block text-white">Add</a>
                            </div>
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" colspan="2">Title</th>
                                        <th class="border-top-0">RoomNumber</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($result as $item){
                                        echo "<tr>";
                                        echo "<td style='width:50px;'><span class='round'>S</span></td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['title'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['room_number'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo "<a href=/room/edit.php?id=" . $item['id'] . "><i class='fa fa-pencil-alt'></i> </a> | ";
                                        echo "<a href=/room/delete.php?id=" . $item['id'] . "><i class='fa fa-trash-alt'></i> </a>";
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
