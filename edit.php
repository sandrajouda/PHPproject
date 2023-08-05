<?php
    include "connect.php";
    // $id      = "";
    // $name    = "";
    // $email   = "";
    // $phone   = "";
    // $address = "";
    // $errorMessage = "";
    // $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(!isset($_GET['id'])){
            header("Location:index.php");
            exit;
        }
        $id = $_GET['id'];
        $sql = "SELECT * FROM `clients` WHERE id=$id" ;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        // fetch_assoc() method fetches the next row from the result set as an associative array, where the keys of the array correspond to the column names in the result set.
        // The fetched row is then assigned to thez variable $row, which can be used to access the values of individual columns for that particular row.
        if(!$row){
            header("Location:index.php");
            exit;
        }

        $name    = $row['name'];
        $email   = $row['email'];
        $phone   = $row['phone'];
        $address = $row['address'];
    }else{
        $id      = $_POST['id'];
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $phone   = $_POST['phone'];
        $address = $_POST['address'];

        do{
            if (empty($id)|| empty($name) || empty($email) || empty($phone) || empty($address)) {
                $errorMessage = "All fields required";
                break;
            }
            $sql = "UPDATE clients SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address' WHERE id=$id";
            $result = $conn->query($sql);
            if(!$result){
                $errorMessage = "invalid query".$conn->error;
                break;
            }
            $successMessage = "updated successfully";
            header("Location:index.php");
            exit;
        }while(true);
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My shop</title>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-5">Update Client </h2>
        <?php 
            if(!empty($errorMessage)){
                echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>' . $errorMessage . '</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
        ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo$id  ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label ">
                    Name
                </label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" value="<?php echo$name  ?>" placeholder="name">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label ">
                    Email
                </label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" value="<?php echo$email  ?>" placeholder="email">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label ">
                    Phone
                </label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control" value="<?php echo$phone  ?>" placeholder="phone">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label ">
                    Address
                </label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control" value="<?php echo$address  ?>" placeholder="address">
                </div>
            </div>


            <?php
                if(!empty($successMessage)){
                    echo ' 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>' . $successMessage . '</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
                }
            ?>
            <div class="row mb-3 ">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php">Cancel</a>
                </div>

            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>