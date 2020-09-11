<?php
session_start();//session starts here

if(!empty($_SESSION))
{
    if($_SESSION['role'] == 'admin'){
         header("Location: dashboard.php");//redirect to login page to secure the welcome page without login access.
    }
}
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <title>Admin Login</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;

</style>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php" autocomplete="new-password">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Name" name="admin_name" type="text" autofocus required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="admin_pass" type="password" value="" required="required" autocomplete="off">
                            </div>


                            <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="admin_login" >


                        </fieldset>
                    </form>
                    New Member.<a href="register.php">Sign up now</a>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>

<?php

include("../database/Db_conection.php");

if(isset($_POST['admin_login']))//this will tell us what to do if some data has been post through form with button.
{
    $admin_name=$_POST['admin_name'];
    $admin_pass=md5($_POST['admin_pass']);

    $admin_query="select * from admin where admin_name='$admin_name' AND admin_pass='$admin_pass'";

    $run_query=mysqli_query($dbcon,$admin_query);

    if(mysqli_num_rows($run_query)>0)
    {
        $_SESSION['role']='admin';
        $_SESSION['admin_name']=$admin_name;
        $_SESSION['admin_id']=mysqli_fetch_array($run_query)['id'];
        echo "<script>window.open('dashboard.php','_self')</script>";
        
    }
    else {echo"<script>alert('Admin Details are incorrect..!')</script>";}

}

?>