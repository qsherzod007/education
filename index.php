<?php
include "session.php";
include "db.php";
include "header.php";
include "left.php";

$limit = 10;
$sth = $conn->prepare('select firstName, lastName from student limit :lim');
$sth->bindParam(':lim', $limit, PDO::PARAM_INT);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Projects of the Month</h4>
                            <div class="col-md-2 ms-auto">
                                <select class="form-select shadow-none col-md-2 ml-auto">
                                    <option selected>January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                </select>
                            </div>
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
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
</div>
<?php
include "footer.php";
