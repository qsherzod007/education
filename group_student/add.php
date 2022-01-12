<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";
include "../dbquery/student.php";
include "../dbquery/group.php";

$students = getStudents($conn);
$groups = getGroups($conn);

if (isset($_POST['student_id']) && !empty($_POST['student_id']) &&
    isset($_POST['group_id']) && !empty($_POST['group_id'])) {
    $sql = "insert into group_student (student_id, group_id) values (:student_id, :group_id)";
    $state = $conn->prepare($sql);
    $state->bindValue(":student_id", $_POST['student_id']);
    $state->bindValue(":group_id", $_POST['group_id']);
    if ($state->execute()) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/group_student/index.php';
        echo "<script> window.location.replace('$host') </script>";
//        header('Location: http://localhost/index.php');die();
        die();
    } else {
        print_r($state->errorInfo());
        die();
    }

}
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form method="post" class="form-horizontal form-material mx-2">

                            <div class="form-group">
                                <label class="col-md-12 mb-0">Students</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 form-control-line" name="student_id">
                                        <?php foreach ($students as $student) {
                                            echo "<option value=".$student['id'].">".$student['firstName']." ".$student['lastName']."</option>";
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Students</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 form-control-line" name="group_id">
                                        <?php foreach ($groups as $group) {
                                            echo "<option value=".$group['id'].">".$group['title']."</option>";
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 d-flex">
                                    <button type="submit" class="btn btn-success mx-auto mx-md-0 text-white">Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "../footer.php";
?>


