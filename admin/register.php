<?php
session_start();//session starts here

?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.2.0-dist/css/bootstrap.css">
    <title>Admin Register</title>
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
                    <h3 class="panel-title">Sign Up</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="register.php" autocomplete="new-password">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Name" name="admin_name" type="text" autofocus required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="admin_pass" type="password" value="" required="required" autocomplete="off">
                            </div>

                            <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="admin_register" >

                        </fieldset>
                    </form>
                    Already a member.<a href="index.php">Login now</a>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>

<?php

include("../database/Db_conection.php");

if(isset($_POST['admin_register']))//this will tell us what to do if some data has been post through form with button.
{
    $admin_name=$_POST['admin_name'];//here getting result from the post array after submitting the form.
    $admin_pass=md5($_POST['admin_pass']);//same
   


    if($admin_name=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter the name')</script>";
exit();//this use if first is not work then other will not show
    }

    if($admin_pass=='')
    {
        echo"<script>alert('Please enter the password')</script>";
exit();
    }

  
//here query check weather if user already registered so can't register again.
    $check_email_query="select * from admin WHERE admin_name='$admin_name'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
        echo "<script>alert('Admin $admin_name is already exist in our database, Please try another one!');window.location=window.location;</script>";
        exit();
    }

    $check_name_query="select * from admin WHERE admin_name='$admin_name'";
    $run_query1=mysqli_query($dbcon,$check_name_query);

    if(mysqli_num_rows($run_query1)>0)
    {
        echo "<script>alert('Name $admin_name is already exist in our database, Please try another one!');window.location=window.location;</script>";
        exit();
    }
    //insert the user into the database.
    $insert_user="insert into admin (admin_name,admin_pass) VALUE ('$admin_name','$admin_pass')";
    if(mysqli_query($dbcon,$insert_user))
    {
        echo"<script>window.open('login.php','_self')</script>";
    }
}

?>