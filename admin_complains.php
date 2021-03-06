<?php
    $for_user = $_GET['id'];
    session_start();
    $user;
    
    $errorpafelocation = 'Location: /error_page.php?err_msg=';
    include '/php-files/db_connection.php';
    if (isset($_SESSION['user']) && $_SESSION['user_type'] == "Admin") {
        // logged in
        $user = $_SESSION['user'];
    } else {
        // not logged in
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=/index.php" );
     }
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Erfan Heya Mim">
    <link rel="shortcut icon" type="image/x-icon" href="/fileStorage/bracu_logo.ico" />
    <title>Admin | BRACU CMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/php-files/Profile.php">Admin | BRACU CMS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/php-files/Profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                       
                        <li>
                            <a href="/admin_settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/php-files/signout.php"><i class="fa fa-fw fa-power-off"></i> Sign Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dashboard_admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="admin_complains.php"><i class="fa fa-comments"></i> Complains</a>
                    </li>
                    <li>
                        <a href="admin_accountreq_manage.php?id=Teacher"><i class="fa fa-fw fa-table"></i>Teacher account requests</a>
                    </li>
                    <li>
                        <a href="admin_accountreq_manage.php?id=Student"><i class="fa fa-fw fa-table"></i>Student account requests</a>
                    </li>
                    <li>
                        <a href="admin_sem_routine.php"><i class="fa fa-fw fa-desktop"></i>Semester Overview</a>
                    </li>
                   
                    <li>
                        <a href="admin_settings.php"><i class="fa fa-fw fa-wrench"></i>Settings</a>
                    </li>
                   
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Complains 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-comments"></i> Review Complains 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                    $query = "SELECT * FROM complains WHERE Solved = 0";
                    $result = mysqli_query($conn, $query);
                    while($row = $result->fetch_assoc()){
                        $user_name = $row["User"];
                        $complain_text = $row["Complain_text"];
                        $time_stamp = $row["Timestamp"];
                        $complain_tag = $row["Tag"];


                        echo "<div class=\"alert alert-info alert\" id=\"".$user_name."\">
                                    <div class=\"row\">
                                    <div class=\"col-lg-7\">
                                    <h5> User Email or Id: "
                                    .$user_name.
                                    "</h5>
                                    </div>
                                    <div class=\"col-lg-5\">
                                    <h5>";
                                    echo "</h5>
                                    </div></div>"; 
                                    //show complain
                                    echo "<div class=\"row\"> <div class=\"col-lg-12\"><p> <b>Complain message:  </b>".$complain_text."</p></div></div>";
                                    //approve reject buttons here
                                    echo "<div class=\"row\">
                                    <div class=\"col-lg-6\"><button type=\"button\" class=\"btn btn-sm btn-success btn-block\" onclick=\"solved('".$user_name."','".$complain_text."','".$complain_tag."','".$user."')\">Solved</button> </div> 
                                    <div class=\"col-lg-6\"><button type=\"button\" class=\"btn btn-sm btn-danger btn-block\" onclick=\"dismiss('".$user_name."','".$complain_text."','".$complain_tag."','".$user."')\">Dismiss</button> </div>";
                                    echo"</div>";
                                     echo "<div class=\"row\"> <div class=\"col-lg-12\"><br><p> <b>Add a reply to the message:</b><br> </p></div></div>
                                     <textarea class=\"form-control\" rows=\"3\" id=\"".$user_name."complain_comment\" placeholder=\"Add a message? Or you can just leave it blank.\"></textarea>
                                     ";
                                     echo "</div>";
                    }
                ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

     <script>
         function solved(emailorid, complain_text, complain_tag, admin_email) {
             complain_reply = document.getElementById(emailorid + "complain_comment").value;
            
             $.ajax({
                 url: "/php-files/solve.php",
                 type: "POST",
                 data: { 'emailorid': emailorid, 'complain_text': complain_text, 'complain_tag': complain_tag, 'complain_reply': complain_reply, 'admin_email' : admin_email },
                 success: function (dataa) {

                     if (dataa == 0) {
                         var element = document.getElementById(emailorid);
                         element.parentNode.removeChild(element);
                         alert("Approved!");
                     } else {
                         alert("Sorry something went wrong, please try again!");
                     }

                 },
                 error: function () {
                     alert("Sorry something went wrong, please try again!");
                 }
             });
         }


         function dismiss(emailorid, complain_text, complain_tag, admin_email) {
             complain_reply = document.getElementById(emailorid + "complain_comment").value;
            
             $.ajax({
                 url: "/php-files/dismiss.php",
                 type: "POST",
                 data: { 'emailorid': emailorid, 'complain_text': complain_text, 'complain_tag': complain_tag, 'complain_reply': complain_reply, 'admin_email' : admin_email },
                 success: function (dataa) {

                     if (dataa == 0) {
                         var element = document.getElementById(emailorid);
                         element.parentNode.removeChild(element);
                         alert("Approved!");
                     } else {
                         alert("Sorry something went wrong, please try again!");
                     }

                 },
                 error: function () {
                     alert("Sorry something went wrong, please try again!");
                 }
             });
         }
</script>

</body>

</html>
