<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";
include "../dbquery/region.php";
include "../dbquery/teacher.php";
include "../dbquery/course.php";
include "../dbquery/room.php";

$regions = getRegions($conn);
$teachers = getTeachers($conn);
$courses = getCourses($conn);
$rooms = getRooms($conn);
if (isset($_POST['groupTitle']) && !empty($_POST['groupTitle']) &&
    isset($_POST['teacher_id']) && !empty($_POST['teacher_id']) &&
    isset($_POST['course_id']) && !empty($_POST['course_id']) &&
    isset($_POST['room_id']) && !empty($_POST['room_id'])) {
    $sql = "update  grouup set title = :title, teacher_id = :teacher_id, course_id = :course_id, room_id = :room_id";
    $state = $conn->prepare($sql);
    $state->bindValue(":title", $_POST['groupTitle']);
    $state->bindValue(":teacher_id", $_POST['teacher_id']);
    $state->bindValue(":course_id", $_POST['course_id']);
    $state->bindValue(":room_id", $_POST['room_id']);
    if ($state->execute()) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/group/index.php';
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
                                <label class="col-md-12 mb-0">GroupTitle</label>
                                <div class="col-md-12">
                                    <input type="text" name="groupTitle" value="<?= $result['groupTitle'] ?>"
                                           placeholder="Johnathan"
                                           class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Teacher</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 form-control-line" name="teacher_id">
                                        <?php foreach ($teachers as $teacher) {
                                            echo "<option value=".$teacher['id'].">".$teacher['firstName']."</option>";
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Course</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 form-control-line" name="course_id">
                                        <?php foreach ($courses as $course) {
                                            echo "<option value=".$course['id'].">".$course['name']."</option>";
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Room</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 form-control-line" name="room_id">
                                        <?php foreach ($rooms as $room) {
                                            echo "<option value=".$room['id'].">".$room['title']."</option>";
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

