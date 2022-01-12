<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../session.php";
include "../header.php";
include "../left.php";
include "../db.php";



//pagination sonini aniqlash
$sql = $conn->prepare('select firstName from student');
$sql->execute();
$count = $sql->rowCount();
$pages_count = ceil($count / 10);
//page id ni olish
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$start = ($page - 1) * 10;




//sort id ni olish
$sort = 'asc';
if (isset($_GET['sort'])){
    $sort = $_GET['sort'];
}
$col = 'firstName';
if (isset($_GET['col'])){
    $col = $_GET['col'];
}

//search ustunini olish
if (isset($_POST['column'])){
    $column = $_POST['column'];
}
if (isset($_POST['search'])){
    $search = $_POST['search'];
}
//var_dump($column);die();


if (isset($_POST['search']) && isset($_POST['column'])){
    $limit = 10;
    $sth = $conn->prepare("select student.id, firstName, lastName, phoneNumber, r.name reg
    from student
    inner join region r on student.region_id = r.id where $column like '%$search%' order by $col $sort  limit :off,:lim");
    $sth->bindParam(':lim', $limit, PDO::PARAM_INT);
    $sth->bindParam(':off', $start, PDO::PARAM_INT);
//$sth->bindParam(':col', $col);
//$sth->bindParam(':sort', $sort);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
}else{
    $limit = 10;
    $sth = $conn->prepare("select student.id, firstName, lastName, phoneNumber, r.name reg
    from student
    inner join region r on student.region_id = r.id order by $col $sort  limit :off,:lim");
    $sth->bindParam(':lim', $limit, PDO::PARAM_INT);
    $sth->bindParam(':off', $start, PDO::PARAM_INT);
//$sth->bindParam(':col', $col);
//$sth->bindParam(':sort', $sort);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
}

//$limit = 10;
//$sth = $conn->prepare("select student.id, firstName, lastName, phoneNumber, r.name reg
//    from student
//    inner join region r on student.region_id = r.id where lastName like 'S%' order by $col $sort  limit :off,:lim");
//$sth->bindParam(':lim', $limit, PDO::PARAM_INT);
//$sth->bindParam(':off', $start, PDO::PARAM_INT);
////$sth->bindParam(':col', $col);
////$sth->bindParam(':sort', $sort);
//$sth->execute();
//$result = $sth->fetchAll(PDO::FETCH_ASSOC);



?>


    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex">
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Students </h4>
                                <a href="/student/add.php" class="btn btn-success d-none d-md-inline-block text-white">Add New ...</a>
                            </div>
                            <div class="d-md-flex">
                                <ul class="navbar-nav me-auto mt-md-3 ">
                                    <li class="nav-item hidden-sm-down">
                                        <form class="app-search" method="post">
                                            <select class="form-select shadow-none border-0 ps-0" name="column">
                                                <option value="firstName">firstName</option>
                                                <option value="lastName">lastName</option>
                                                <option value="phoneNumber">phoneNumber</option>
                                                <option value="r.name">region</option>
                                            </select>
                                            <input type="text" class="form-control" name="search" placeholder="Search for..."> <a
                                                    class="srh-btn"></a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" colspan="2">Firstname
                                            <a href="/student/index.php?page=<?php echo $page?>&sort=asc&col=firstName"><i class="fas fa-arrow-up"></i></a>
                                            <a href="/student/index.php?page=<?php echo $page?>&sort=desc&col=firstName"><i class="fas fa-arrow-down"></i></a>
                                        </th>
                                        <th class="border-top-0">Lastname
                                            <a href="index.php?page=<?php echo $page?>&sort=asc&col=lastName"><i class="fas fa-arrow-up"></i></a>
                                            <a href="index.php?page=<?php echo $page?>&sort=desc&col=lastName"><i class="fas fa-arrow-down"></i></a>
                                        </th>
                                        <th class="border-top-0">PhoneNumber
                                            <a href="index.php?page=<?php echo $page?>&sort=asc&col=phoneNumber"><i class="fas fa-arrow-up"></i></a>
                                            <a href="index.php?page=<?php echo $page?>&sort=desc&col=phoneNumber"><i class="fas fa-arrow-down"></i></a>
                                        </th>
                                        <th class="border-top-0">Region
                                            <a href="index.php?page=<?php echo $page?>&sort=asc&col=reg"><i class="fas fa-arrow-up"></i></a>
                                            <a href="index.php?page=<?php echo $page?>&sort=desc&col=reg"><i class="fas fa-arrow-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($result as $item){
                                        echo "<tr>";
                                        echo "<td style='width:50px;'><span class='round'>" . substr($item['firstName'],0, 1) . "</span></td>";
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
                                        echo $item['reg'];
                                        echo "</td>";
                                        echo "<td class='align-middle'>";
                                        echo "<a href=/student/edit.php?id=" . $item['id'] . "><i class='fa fa-pencil-alt'></i></a> &nbsp&nbsp|&nbsp&nbsp";
                                        echo "<a href=/student/delete.php?id=" . $item['id'] . "><i class='fa fa-trash-alt'></i> </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                for ($j = 1; $j <= $pages_count; $j++) {
                                    if (isset($_GET['sort'])&& isset($_GET['col'])) {
                                        echo "<a class='btn btn-info d-none d-md-inline-block text-white' href='index.php?page=$j&sort=$sort&col=$col'> $j </a>"." ";
                                    } else {
                                        echo "<a class='btn btn-info d-none d-md-inline-block text-white' href='index.php?page=$j'> $j </a>"." ";
                                    }
                                }
                                ?>
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
