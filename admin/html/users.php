<?php
include_once('../conn.php');
include_once("includes/loginChecker.php");
try{
    $sql= "SELECT * FROM `users`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // echo "Inserted successfully";
    $result = $stmt->fetchAll();
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    $title = "Users";
include_once("includes/head.php");
?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <?php
   
   include_once("includes/sideScroller.php");
   include_once("includes/navigation.php");
   
            ?>
    </div>
    <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <?php
    include_once("includes/header.php");
    ?>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4"><?php echo $title?></h5>
                    <!-- <p class="mb-0">This is a sample page </p> -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Active</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($result as $row){
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $created_at = $row['created_at'];
                                if($row['active'] == 1){
                                    $active ="Yes";
                                }else{
                                    $active ="No";
                                };
                            ?>
                            <tr>

                                <td><?php echo $name?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $created_at?></td>
                                <td><?php echo $active?></td>
                                <td><a href="deleteUser.php?id=<?php echo $id ?>"><img
                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                            src="../assets/images/delete.png.png" alt="Delete" /></a>
                                </td>
                                <td><a href="UpDate.php?id=<?php echo $id ?>"><img
                                            onclick="return confirm('Are you sure you want to update this user?')"
                                            src="../assets/images/update.png.png" alt="update" /></a>
                                </td>

                            </tr>

                            <?php
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include_once("includes/footer.php");
    ?>
</body>

</html>