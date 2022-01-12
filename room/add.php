<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";

if (isset($_POST['title']) && !empty($_POST['title']) &&
    isset($_POST['room_number']) && !empty($_POST['room_number'])) {
    $sql = "insert into room (title, room_number) values (:title, :room_number)";
    $state = $conn->prepare($sql);
    $state->bindValue(":title", $_POST['title']);
    $state->bindValue(":room_number", $_POST['room_number']);
    if ($state->execute()) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/room/index.php';
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
                                <label class="col-md-12 mb-0">Title</label>
                                <div class="col-md-12">
                                    <input type="text" name="title" value="<?= $result['title'] ?>"
                                           placeholder="Johnathan"
                                           class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">RoomNumber</label>
                                <div class="col-md-12">
                                    <input type="text" name="room_number" value="<?= $result['room_number'] ?>"
                                           placeholder="Doe"
                                           class="form-control ps-0 form-control-line">
                                </div>
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


