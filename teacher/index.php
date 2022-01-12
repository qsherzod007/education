<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../session.php";
include "../header.php";
include "../left.php";
include "../db.php";

$limit = 10;
$sth = $conn->prepare('select id, firstName, lastName, phoneNumber from teacher limit :lim');
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
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Teachers </h4>
                                <a href="/teacher/add.php" class="btn btn-success d-none d-md-inline-block text-white">Add</a>
                            </div>
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" colspan="2">Firstname</th>
                                        <th class="border-top-0">Lastname</th>
                                        <th class="border-top-0">PhoneNumber</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($result as $item){
                                        echo "<tr>";
                                        echo "<td style='width:50px;'><span class='round'>S</span></td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['firstName'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['lastName'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo $item['phoneNumber'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo "<a href=/teacher/edit.php?id=" . $item['id'] . "><i class='fa fa-pencil-alt'></i> </a> | ";
                                        echo "<a href=/teacher/delete.php?id=" . $item['id'] . "><i class='fa fa-trash-alt'></i> </a>";
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
