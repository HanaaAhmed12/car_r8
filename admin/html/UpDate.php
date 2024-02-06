<?php
  include_once('includes/loginChecker.php');
  include_once('../conn.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
  
    try {
        $sql= "SELECT * FROM `users` WHERE `id` = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt ->fetch();
        $name = $result['name'];
        $email = $result['email'];
        $active = $result['active'] ? "checked" : "";
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}


//update user data

if($_SERVER['REQUEST_METHOD'] === 'POST'){



    try {
        $sql= "UPDATE `users` SET `name` = ? , `email` = ?, `password` = ? ,`active` = ? WHERE `id` = ?";
        $name = $_POST['name'];
        $email= $_POST['email'];

        if(empty($_POST['password'])){
            $password = $_POST['oldPassword'];
        }else{
            $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
        }
        $active = isset($_POST['active']);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email ,$password, $active, $id]);
     
     
        
     
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}


























?>

<form action="" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name"
            value="<?php echo isset($name) ? $name : '' ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
            value="<?php echo isset($email) ? $email : '' ?>">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="active" name="active" <?php echo $active ?>>
        <label class="form-check-label" for="active">Active</label>
    </div>
    <input type="hidden" name="oldPassword" value="<?php echo $password?>">
    <button type="submit" class="btn btn-primary">Update</button>
</form>