<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $NIC = $_SESSION['NIC'];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['MobileNumber'];
        $email = $_POST['EmailId'];

        $sql = "update tblstudents set FullName=:fname,MobileNumber=:mobileno,EmailId=:email where NIC=:NIC";
        $query = $dbh->prepare($sql);
        $query->bindParam(':NIC', $NIC, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Your profile has been updated")</script>';
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

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">My Profile</h4>

                    </div>

                </div>
                <div class="row">

                    <div class="col-md-9 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                My Profile
                            </div>
                            <div class="panel-body">
                                <form name="signup" method="post">
                                    <?php
                                    $NIC = $_SESSION['NIC'];
                                    $sql = "SELECT EmpNo,NIC,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where NIC=:NIC ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':NIC', $NIC, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>

                                            <div class="form-group">
                                                <label>NIC No. : </label>
                                                <?php echo htmlentities($result->NIC); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Employee No. : </label>
                                                <?php echo htmlentities($result->EmpNo); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Reg Date : </label>
                                                <?php echo htmlentities($result->RegDate); ?>
                                            </div>
                                            <?php if ($result->UpdationDate != "") { ?>
                                                <div class="form-group">
                                                    <label>Last Updation Date : </label>
                                                    <?php echo htmlentities($result->UpdationDate); ?>
                                                </div>
                                            <?php } ?>


                                            <div class="form-group">
                                                <label>Profile Status : </label>
                                                <?php if ($result->Status == 1) { ?>
                                                    <span style="color: green">Active</span>
                                                <?php } else { ?>
                                                    <span style="color: red">Blocked</span>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group">
                                                <label>Enter Full Name : </label>
                                                <input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName); ?>" autocomplete="off" required />
                                            </div>


                                            <div class="form-group">
                                                <label>Mobile Number :</label>
                                                <input class="form-control" type="text" onBlur="checkAvailability('MobileNumber')" id="MobileNumber" name="MobileNumber" pattern="^[1-9]\d{6,14}$" maxlength="11" value="<?php echo htmlentities($result->MobileNumber); ?>" autocomplete="off" required />
                                                <span id="availability-status-MobileNumber" style="font-size:12px;"></span>
                                            </div>

                                            <div class="form-group">
                                                <label>Enter Email : </label>
                                                <input class="form-control" type="email" onBlur="checkAvailability('EmailId')" name="EmailId" id="EmailId" value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off" required />
                                                <span id="availability-status-EmailId" style="font-size:12px;"></span>
                                            </div>
                                    <?php }
                                    } ?>

                                    <button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button>

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
<?php } ?>