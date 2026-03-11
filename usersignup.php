<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {

    $NIC = $_POST['NIC'];
    $EmpNo = $_POST['EmpNo'];
    $fname = $_POST['fullanme'];
    $MobileNumber = $_POST['MobileNumber'];
    $EmailId = $_POST['EmailId'];
    $password = md5($_POST['password']);
    $status = 0;
    $approval = 0;
    $sql = "INSERT INTO  tblstudents(EmpNo,NIC,FullName,MobileNumber,EmailId,Password,Status,Approval) VALUES(:EmpNo,:NIC,:fname,:MobileNumber,:EmailId,:password,:status,:approval)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':NIC', $NIC, PDO::PARAM_STR);
    $query->bindParam(':EmpNo', $EmpNo, PDO::PARAM_STR);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':MobileNumber', $MobileNumber, PDO::PARAM_STR);
    $query->bindParam(':EmailId', $EmailId, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':approval', $approval, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo '<script>alert("Your Registration successfull and your student id is  "+"' . $StudentId . '")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability(fieldname) {

            $("#loaderIcon").show();

            // Get the value of the input field dynamically
            var fieldValue = $('#' + fieldname).val();

            jQuery.ajax({
                url: "check_availability.php",
                // Constructing the data object dynamically
                data: {
                    [fieldname]: fieldValue
                },
                type: "POST",
                success: function(data) {
                    console.log(data);
                    $('#availability-status-' + fieldname).html(data);
                    $("#loaderIcon").hide();

                },
                error: function() {
                    $("#loaderIcon").hide();
                }
            });

        }
    </script>

</head>

<body style="background-image:url('assets/img/form-background.jpeg');" class="form-body">
    <!------MENU SECTION START-->
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container form-container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="index.php">
                        <img class="navbar-brand" src="assets/img/logo-mini.svg" style="height: auto !important;width:300px;max-width:100%;" />
                    </a>
                </div>
            </div>

            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line text-center">User Signup</h4>

                </div>

            </div>
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            SINGUP FORM
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enter Full Name</label>
                                            <input class="form-control" type="text" name="fullanme" autocomplete="off" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIC No.</label>
                                            <input class="form-control" onBlur="checkAvailability('NIC')" placeholder="e.g. 911222555V or 199112202555" pattern="^([0-9]{9}[VX]|[0-9]{12})$" type="text" name="NIC" id="NIC" autocomplete="off" required />
                                            <span id="availability-status-NIC" style="font-size:12px;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee No.</label>
                                            <input class="form-control" onBlur="checkAvailability('EmpNo')" type="text" name="EmpNo" id="EmpNo" autocomplete="off" required />
                                            <span id="availability-status-EmpNo" style="font-size:12px;"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input class="form-control" onBlur="checkAvailability('MobileNumber')" placeholder="e.g. 94771234567" pattern="^[1-9]\d{6,14}$" type="text" name="MobileNumber" id="MobileNumber" maxlength="11" autocomplete="off" required />
                                            <span id="availability-status-MobileNumber" style="font-size:12px;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Enter Email</label>
                                            <input class="form-control" onBlur="checkAvailability('EmailId')" type="email" name="EmailId" id="EmailId" autocomplete="off" required />
                                            <span id="availability-status-EmailId" style="font-size:12px;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enter Password</label>
                                            <input class="form-control" type="password" name="password" autocomplete="off" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password </label>
                                            <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button> | <a href="userlogin.php">Already have an account ?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>

</html>