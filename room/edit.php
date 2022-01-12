<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";

$id = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
}
$sth = $conn->prepare('SELECT  *    FROM room where id = :id limit :lim');
$sth->bindValue(':lim', 1, PDO::PARAM_INT);
$sth->bindValue(':id', $id, PDO::PARAM_INT);
$sth->execute();



$result = $sth->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['title']) && !empty($_POST['title']) &&
    isset($_POST['room_number']) && !empty($_POST['room_number'])) {
    $sql = "update room set title = :title, room_number = :room_number where id = :id";
    $state = $conn->prepare($sql);
    $state->bindValue(":title", $_POST['title']);
    $state->bindValue(":room_number", $_POST['room_number']);
    $state->bindValue(":id",  $id);
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
                                <label class="col-md-12 mb-0">First Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="title" value="<?= $result['title'] ?>"
                                           placeholder="Johnathan"
                                           class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Last Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="room_number" value="<?= $result['room_number'] ?>"
                                           placeholder="Doe"
                                           class="form-control ps-0 form-control-line">
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


