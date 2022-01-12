<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";
include "../dbquery/region.php";

$regions = getRegions($conn);
if (isset($_POST['firstName']) && !empty($_POST['firstName']) &&
    isset($_POST['lastName']) && !empty($_POST['lastName']) &&
    isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])) {
    $sql = "insert into teacher (firstName, lastName, phoneNumber) values (:firstName, :lastName, :phoneNumber)";
    $state = $conn->prepare($sql);
    $state->bindValue(":firstName", $_POST['firstName']);
    $state->bindValue(":lastName", $_POST['lastName']);
    $state->bindValue(":phoneNumber", $_POST['phoneNumber']);
    if ($state->execute()) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/teacher/index.php';
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
                                    <input type="text" name="firstName" value="<?= $result['firstName'] ?>"
                                           placeholder="Johnathan"
                                           class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Last Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="lastName" value="<?= $result['lastName'] ?>"
                                           placeholder="Doe"
                                           class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Phone Number</label>
                                <div class="col-md-12">
                                    <input type="text" name="phoneNumber" value="<?= $result['phoneNumber'] ?>"
                                           placeholder="998909999999"
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


