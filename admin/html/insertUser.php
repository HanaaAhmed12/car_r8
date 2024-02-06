<?php

include_once("includes/loginChecker.php");




include_once('../conn.php');
include_once('includes/loginChecker.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    try{

        $name = $_POST['name'];
        $email = $_POST['email'];
        $created_at = $row['created_at'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $active = isset($_POST['active']) ? 1 : 0;
        $sql= "INSERT INTO `users`( `name`, `email`, `password` , `created_at` ,`active`) VALUES (? , ? , ? ,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name , $email , $password , $created_at , $active]);
        // echo "Inserted successfully";
            header("Location: users.php");
            exit;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
 
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


                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="active" name="active">
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </form>
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