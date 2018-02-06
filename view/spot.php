
<?php include 'shared/header.php';?>
<body>
    <div class="wrapper">

<?php include 'shared/sidebar.php';?>

   <?php
   include 'conn.php';

if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}
   ?>
        <div class="main-panel">
           
         <?php include 'shared/nav.php'; ?>

            <div class="content">
               

<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                  <a class="btn btn-success pull-right" href="spotform.php?Id=0">Create new</a>
                                    <h4 class="title">Other Tourist Spot</h4>
                                    <p class="category">Here is table of Tourist Spot</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr><th>Name</th>
                                            <th>Address</th>
                                            
                                            <th>Contact number</th>
                                            <th></th>
                                        </tr></thead>
                                        <tbody>
                                                <?php 
                                            
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];

                                              $sql = "select * from spots where Name like '%$q%' or Description like '%$q%'";
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                            <tr>
                                             
                                                <td><?php echo $data['Name'];?></td>
                                                <td><?php echo $data['Location'];?></td>
                                                <td><?php echo $data['Contact'];?></td>
                                               
                                                <td class="text-primary"><a href="spotform.php?Id=<?php echo $data['Id'];?>" class="btn btn-info btn-sm">Edit</a><a href="deletespot.php?Id=<?php echo $data['Id'];?>" class="btn btn-danger btn-sm">Delete</a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>



            </div>
    <?php include 'shared/footer.php';?>

