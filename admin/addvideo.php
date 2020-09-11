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
        </div><!-- /.col -->
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Add Video </li>
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
        <div class="col-sm-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Video</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action=""  enctype="multipart/form-data" autocomplete="new-password">
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Video Title" required>
                </div>

                <div class="form-group">
                  <label for="url">Description</label>
                  <input type="text" class="form-control" id="url" name="description" placeholder="Enter Video Description" required="required">
                </div>
                <div class="form-group">
                  <label for="url">Image</label>
                  <input type="file" class="form-control" name="file" id="img" accept="image/*"  required> 

                </div>
                <div class="form-group">
                  <label for="url">Watermark image </label>
                  <input type="file" class="form-control" name="watermark"  accept="image/*"  id="watermark" required> 
                </div>
                <div class="form-group">
                  <label for="url">Video</label>
                  <input type="file" class="form-control" name="video" id="video" required> 
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" value="addvideo" name="addvideo">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<!-- ./wrapper -->
<?php include 'includes/footer.php';?>
<script type="text/javascript">

</script>
<?php

include("../database/Db_conection.php");

if(isset($_POST['addvideo']))
{
  $title=$_POST['title'];
  $description=$_POST['description'];

  if (($_FILES['file']['name']!="")){
// Where the file is going to be stored
    $target_dir = "../upload/image/";

    $file = $_FILES['file']['name'];
    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = $path['extension'];
    $temp_name = $_FILES['file']['tmp_name'];
    $image = $target_dir.$filename.".".$ext;

    $image_name = $_FILES['file']['name'];

// Check if file already exists
      move_uploaded_file($temp_name,$image);
    
  }

  if(($_FILES['watermark']['name']!="")){
// Where the file is going to be stored
    $target_dir = "../upload/watermark/";

    $file = $_FILES['watermark']['name'];
    $path = pathinfo($file);
    $filename = $path['filename'];
    $ext = $path['extension'];
    $temp_name = $_FILES['watermark']['tmp_name'];
    $watermark = $target_dir.$filename.".".$ext;

    $watermark_name = $_FILES['watermark']['name'];
// Check if file already exists
      move_uploaded_file($temp_name,$watermark);
  
  }

  $maxsize = 5242880; // 5MB
  $name = $_FILES['video']['name'];
  $target_dir = "../videos/";
  $videos = $target_dir . $_FILES["video"]["name"];
$videos_name = $_FILES['video']['name'];
  // Select file type
  $videoFileType = strtolower(pathinfo($videos,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("mp4","avi","3gp","mov","mpeg");




  // Check extension
  if( in_array($videoFileType,$extensions_arr) ){

  // Check file size
    if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
      echo "File too large. File must be less than 5MB.";
    }else{
  // Upload
      if(move_uploaded_file($_FILES['video']['tmp_name'],$videos)){

      }else{
        echo "video not Uploaded";exit;
      }
    }

  }else{
    echo "Invalid file extension.";
  }



  $date = date('Y-m-d');

  // Insert record

  $insert_user="insert into videos (title,description,image,watermark,video,created_at) VALUE ('$title','$description','$image_name','$watermark_name','$videos_name','$date')";

  if(mysqli_query($dbcon,$insert_user))
  {
    echo"<script>window.open('videolist.php','_self')</script>";
  }
}

?>