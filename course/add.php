<?php
include "../session.php";
include "../db.php";
include "../header.php";
include "../left.php";

if (isset($_POST['name']) && !empty($_POST['name'])) {
    $sql = "insert into course (name) values (:name)";
    $state = $conn->prepare($sql);
    $state->bindValue(":name", $_POST['name']);
    if ($state->execute()) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/course/index.php';
        echo "<script> window.location.replace('$host') </script>";
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
                                <label class="col-md-12 mb-0">Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" value="<?= $result['name'] ?>"
                                           placeholder="Johnathan"
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

