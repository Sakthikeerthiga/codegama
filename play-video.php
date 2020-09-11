<?php
session_start();
if(!$_SESSION['email'])
{
    header("Location: Login.php");//redirect to login page to secure the welcome page without login access.
}

include("database/Db_conection.php");
$video_id=$_GET['id'];
$query="select * from videos WHERE id='$video_id'";//delete query
$run=mysqli_query($dbcon,$query);
if($run)
{
    while($row=mysqli_fetch_array($run))
    {
        $id=$row['id'];
        $title=$row['title'];
        $video=$row['video'];
        $watermark=$row['watermark'];
    
        
        if(isset($_SESSION['sess_video'])){
            $arr=$_SESSION['sess_video'];
        }else{
            $arr=[];
        }
        
        if(!empty($arr)){
            if (!in_array($id,$arr))
            {
                $sql = "UPDATE videos SET views=views+1 WHERE id=$id";
                mysqli_query($dbcon,$sql);
                array_push($arr,$id);
                $_SESSION['sess_video'] = $arr;
            }
        }else{

            $arr=array();
            $sql = "UPDATE videos SET views=views+1 WHERE id=$id";
            mysqli_query($dbcon,$sql);
            array_push($arr,$id);
            $_SESSION['sess_video'] = $arr;
        }
        
        
    }
}
?>
<!DOCTYPE html>  
<html>  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Codegama Test</title>  
    <link href="assets/video.js/dist/video-js.min.css" rel="stylesheet">
    <link href="assets/videojs-watermark/dist/videojs-watermark.css" rel="stylesheet">
    <link href="assets/videojs-resolution-switcher/lib/videojs-resolution-switcher.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style type="text/css">
        .video-js *, .video-js :after, .video-js :before {box-sizing: inherit;display: grid;}
        .video-js .vjs-watermark-top-right {right: 5%;top: 50%;}
        .video-js .vjs-watermark-content {opacity: 0.3;}
        .vjs-menu-button-popup .vjs-menu {width: auto;}
    </style>
    <script src="js/videojs-ie8.min.js"></script>  
    <script src='js/video.js'></script>  
    <script src="js/videojs-flash.js"></script>  
    <script src="js/videojs-contrib-hls.js"></script>  
    <script src="assets/videojs-watermark/dist/videojs-watermark.js"></script>
    <script src="assets/videojs-resolution-switcher/lib/videojs-resolution-switcher.js"></script>
</head>  
<body style="margin:0;padding:0;">  
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          
            <ul class="nav navbar-nav">
                <li class="active"><a href="Welcome.php">Home</a></li>
                <?php if(!$_SESSION['email']){ ?>
                <li class=""><a href="Login.php">Signin</a></li>
                <?php } ?>
                <?php if($_SESSION['email']){ ?>
                <li class=""><a href="Logout.php">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
<div>  
<?php
$query="select * from videos WHERE id='$id'";//delete query
$run=mysqli_query($dbcon,$query);
$res = mysqli_fetch_array($run);
?>

<input type="hidden" id="user_id" value="<?php echo $_SESSION['user_id']?>">
<input type="hidden" id="video_id" value="<?php echo $_GET['id'];?>">
 <!-- test/playlist.m3u8 -->
    <video id="video" class="video-js vjs-default-skin vjs-big-play-centered" controls data-setup='{"controls": true, "autoplay": true, "aspectRatio":"16:9", "fluid": true, "playbackRates": [0.5, 1, 1.5, 2]}' type="video/mp4" >
        <source src="./videos/<?php echo $video;?>" type='video/mp4'>
       
    </video>  
</div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    var user_id = $("#user_id").val();
    var video_id = $("#video_id").val();
    
    videojs('video', {},function(){
        var player = this;
        window.player = player
        player.watermark({
            image: './upload/watermark/<?php echo $watermark;?>',
            fadeTime: null,
            url: ''
        });
    });
</script>
  
</body>  
</html>