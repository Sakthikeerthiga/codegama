<?php
session_start();

if(!$_SESSION['role'])
{
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

include 'includes/header.php';
?>

<style type="text/css">
  img{width: 100%;}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Video List </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="table-responsive">

            <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
              <thead>

                <tr>

                  <th>Video ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Water Mark Image</th>
                  <th>Video</th>
                  <th>Created At</th>
                </tr>
              </thead>

              <?php
              $user_id = $_SESSION['admin_id'];
              include("../database/Db_conection.php");
              $view_videos_query="select *,videos.id as vid from videos ";
              $run=mysqli_query($dbcon,$view_videos_query);
              $dataPoints = array();$dataPoints1 = array();

              while($row=mysqli_fetch_array($run))
              {
                $id=$row['vid'];
                $title=$row['title'];
                $description=$row['description'];
                $image=$row['image'];
                $watermark=$row['watermark'];
                $video=$row['video'];
                $created_date=$row['created_at'];
                
                ?>  

              <tr>
                <td><?php echo $id;  ?></td>
                <td><?php echo $title;  ?></td>
                <td><?php echo $description;  ?></td>
                <td><img src="../upload/image/<?php echo $image;  ?>"></td>
                <td><img src="../upload/watermark/<?php echo $watermark;  ?>"></td>
                <td><video width="100%" height="240" controls><source src="../videos/<?php echo $video;?>"></video></td>
                <td><?php echo $created_date;  ?></td>
                
              </tr>

            <?php } ?>

        </table>
        </div>
                </div>
              </div><!-- /.container-fluid -->
              
            </section>
            <!-- /.content -->
          </div>
    
<!-- ./wrapper -->


<?php include 'includes/footer.php';?>
