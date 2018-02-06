
<?php

include 'conn.php';
    
    
if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}
  

    $Data = [];
    $Data['Fname'] = "";
    $Data['Lname'] = "";
    $Data['Uname'] = "";
    $Data['Email'] = "";
    $Data['Password'] = "";
    $Data['Address'] = "";
    $Data['City'] = "";
    $Data['Country'] = "";
    $Data['Postalcode'] = "";
    $Data['About'] = "";


   $result = mysqli_query($conn,"select * from Users where Id=$_GET[Id]");

 
   if(mysqli_num_rows($result)> 0){

  $Data=mysqli_fetch_array($result,MYSQLI_ASSOC);
   

   }

   if(isset($_POST['save'])){

     if(intval($_POST['Id']) > 0){ // if hash id then update
    
    if(isset($_POST['password']) && $_POST['password'] != ""){
     $stmt = $conn->prepare("UPDATE Users set Fname=?,Lname=?,Email=?,Uname=?,Password=?,Address=?,City=?,Country=?,Postalcode=?,About=? where Id=?");
     $stmt->bind_param("ssssssssssi", $fname,$lname,$email,$uname,$password,$address,$city,$country,$postalcode,$about,$_POST['Id']);
     }else{

      $stmt = $conn->prepare("UPDATE Users set Fname=?,Lname=?,Email=?,Uname=?,Address=?,City=?,Country=?,Postalcode=?,About=? where Id=?");
     $stmt->bind_param("sssssssssi", $fname,$lname,$email,$uname,$address,$city,$country,$postalcode,$about,$_POST['Id']);

     }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname']; 
    $email = $_POST['email'];   
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $about = $_POST['about'];

    $stmt->execute();

     $stmt->close();
     $conn->close();
 echo "<script>alert('Profile is Updated');window.location.assign('user.php');</script>";
     }else { //if not then add

     $stmt = $conn->prepare("INSERT INTO Users (`Fname`, `Lname`, `Email`, `Uname`, `Password`, `Address`, `City`, `Country`, `Postalcode`, `About`) VALUES (?, ?, ?,?,?,?,?,?,?,?)");
     $stmt->bind_param("ssssssssss",  $fname,$lname,$email,$uname,$password,$address,$city,$country,$postalcode,$about);

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname']; 
    $email = $_POST['email'];   
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $postalcode = $_POST['postalcode'];
    $about = $_POST['about'];


     $stmt->execute();
  
   
     $stmt->close();
     $conn->close();
   echo "<script>alert('Profile is Added');window.location.assign('user.php');</script>";

  
     }

   }

   ?>

<?php include 'shared/header.php';?>
<body>
    <div class="wrapper">

<?php include 'shared/sidebar.php';?>


        <div class="main-panel">
           
         <?php include 'shared/nav.php'; ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">User Form</h4>
                                    <p class="category">Edit or Create user</p>
                                </div>
                                <div class="card-content">
                                    <form method="POST">
                                        <div class="row">
                                           
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" value="<?php echo $Data['Uname'];?>" required name="uname" class="form-control">
                                                     <input type="hidden" value="<?php echo $_REQUEST['Id'];?>" name="Id" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email address</label>
                                                    <input type="email" value="<?php echo $Data['Email'];?>" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fist Name</label>
                                                    <input type="text" value="<?php echo $Data['Fname'];?>" required name="fname" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" name="lname" value="<?php echo $Data['Lname'];?>" required class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" name="address" class="form-control" value="<?php echo $Data['Address'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">City</label>
                                                    <input type="text" name="city" value="<?php echo $Data['City'];?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Country</label>
                                                    <input type="text" name="country" value="<?php echo $Data['Country'];?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Postal Code</label>
                                                    <input type="text" name="postalcode" value="<?php echo $Data['Postalcode'];?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                           <div class="row">
                                           
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" name="password"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Confirm Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About</label>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"> About the User.</label>
                                                        <textarea class="form-control" name="about" rows="5"><?php echo $Data['About'];?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary pull-right" name="save" value="Save User">
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
    <?php include 'shared/footer.php';?>

