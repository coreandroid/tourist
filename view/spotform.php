
<?php

include 'conn.php';
    
    
if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}
  

    $Data = [];
    $Data['Description'] = "";
    $Data['Name'] = ""; 
$Data['OpenTime'] = "";
 $Data['CloseTime'] = "";
 $Data['MinimumSpend'] = "";
 $Data['Location'] ="";
$Data['Contact'] ="";
 $Data['Website'] ="";
 $Data['Image'] ="";
  
  


   $result = mysqli_query($conn,"select * from spots where Id=$_GET[Id]");

 
   if(mysqli_num_rows($result)> 0){

  $Data=mysqli_fetch_array($result,MYSQLI_ASSOC);
   

   }

   if(isset($_POST['save'])){


  move_uploaded_file($_FILES["image"]["tmp_name"],'images/'.$_FILES["image"]["name"]);
    
      $image = $_FILES["image"]["name"];
   
     if(intval($_POST['Id']) > 0){ // if hash id then update
    
  
      $stmt = $conn->prepare("UPDATE spots set `Name`=?,`OpenTime`=?,`CloseTime`=?,`MinimumSpend`=?,`Location`=?,`Contact`=?,`Description`=?,`Website`=?,`Image`=? where Id=?");
     $stmt->bind_param("sssssssssi", $name,$opentime,$closetime,$minimumspend,$location,$contact,$description,$website,$image,$_POST['Id']);

   

    $name = $_POST['name'];
    $opentime = $_POST['opentime'];
    $closetime = $_POST['closetime'];
    $minimumspend = $_POST['minimumspend'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    $stmt->execute();

     $stmt->close();
 
 echo "<script>alert('Spot is Updated');window.location.assign('spot.php');</script>";
     }else { //if not then add

     $stmt = $conn->prepare("INSERT INTO spots (`Name`, `OpenTime`, `CloseTime`, `MinimumSpend`, `Location`, `Contact`, `Description`, `Website`,`Image`) VALUES (?, ?, ?,?,?,?,?,?,?)");
     $stmt->bind_param("sssssssss",  $name,$opentime,$closetime,$minimumspend,$location,$contact,$description,$website,$image);

    $name = $_POST['name'];
    $opentime = $_POST['opentime'];
    $closetime = $_POST['closetime'];
    $minimumspend = $_POST['minimumspend'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $website = $_POST['website'];
    $description = $_POST['description'];
   



     $stmt->execute();
  
   
     $stmt->close();
   
   echo "<script>alert('Spot is Added');window.location.assign('spot.php');</script>";

  
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
                                    <h4 class="title">Spot Edit</h4>
                                    <p class="category">Edit or Create Spot</p>
                                </div>
                                <div class="card-content">
                                    <form method="POST" enctype="multipart/form-data">
                                      <?php if(strlen($Data['Image']) > 0) { ?>
                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <img src="images/<?= $Data['Image'];?>" style="width:445px;">
                                          </div>
                                      </div>
                                      <?php } ?>

                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Click to select Image</label>
                                                    <input type="file"   name="image" class="form-control">
                                                   
                                                </div>
                                          </div>
                                      </div>

                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" value="<?php echo $Data['Name'];?>" required name="name" class="form-control">
                                                     <input type="hidden" value="<?php echo $_REQUEST['Id'];?>" name="Id" class="form-control">
                                                </div>
                                          </div>
                                      </div>

                                        <div class="row">
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Open Time</label>
                                                    <input type="time" value="<?php echo $Data['OpenTime'];?>" required name="opentime" class="form-control">
                                               
                                                </div>
                                          </div>

                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Close Time</label>
                                                    <input type="time" value="<?php echo $Data['CloseTime'];?>" required name="closetime" class="form-control">
                                                 
                                                </div>
                                          </div>
                                      </div>


                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Minimum expenses</label>
                                                    <input type="number" value="<?php echo $Data['MinimumSpend'];?>" required name="minimumspend" class="form-control">
                                               
                                                </div>
                                          </div>

                                      </div>
                                            
                                           <div class="row">
                                           
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <input type="text" value="<?php echo $Data['Location'];?>" required name="location" class="form-control">
                                               
                                                </div>
                                          </div>

                                     <?php if(strlen($Data['Location']) > 0){ ?>
                                          <iframe  width="100%" height="400" frameborder="0" style="border:0" allowfullscreen src="//www.google.com/maps/embed/v1/place?q=<?= $Data['Location'];?>&zoom=17&key=AIzaSyCDmf5-MFqs4IO4CYfMIF3z2TXhEoO7HYg">
                                         </iframe>
                                         <?php } ?>

                                      </div>



                                           <div class="row">
                                           
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Contact number</label>
                                                    <input type="text" value="<?php echo $Data['Contact'];?>" required name="contact" class="form-control">
                                               
                                                </div>
                                          </div>

                                      </div>


                                            <div class="row">
                                           
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Website/Facebook</label>
                                                    <input type="text" value="<?php echo $Data['Website'];?>"  name="website" class="form-control">
                                               
                                                </div>
                                          </div>

                                      </div>
                                            


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"> Additional info.</label>
                                                        <textarea class="form-control" name="description" rows="5"><?php echo $Data['Description'];?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary pull-right" name="save" value="Save Spot">
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
    <?php include 'shared/footer.php';?>

