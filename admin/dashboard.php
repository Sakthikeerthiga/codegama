<?php
session_start();

if(!$_SESSION['role'])
{
    header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

include 'includes/header.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                  include("../database/Db_conection.php");
                  $user_id = $_SESSION['admin_id'];
                  $video_query="select * from videos  where user_id=$user_id";
                  $video_result=mysqli_query($dbcon,$video_query);
                  $student_query="select * from students";
                  $student_result=mysqli_query($dbcon,$student_query);

                ?>
                <h3><?php echo mysqli_num_rows($video_result);?></h3>

                <p>New Videos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>
</div>
</section>
</div>

          
<?php include 'includes/footer.php';?>