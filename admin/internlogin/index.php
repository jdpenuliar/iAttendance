<?php
    session_start();
    require_once("../include/DBConfigs.php");
    unset($_SESSION['sessionInternEditorActivation']);
    if(!isset($_SESSION['userID'])){
        header("Location: ../../");
    }else{
        if(isset($_POST['GITM'])){
            /*$userLevelCompare = $classDBRelatedFunctions->functionUserAuthentication($_POST['username'],$_POST['password']);
            if($userLevelCompare == 2 or $userLevelCompare == 1 or $userLevelCompare == 0){
                header("Location: ./admin");
                die();
            }else if($userLevelCompare == 3){

            }else{
                echo '<script language="javascript">';
                echo 'alert("Invalid credentials")';
                echo '</script>';
            }*/

            $userLevelCompare = $classDBRelatedFunctions->functionUserAuthentication($_POST['username'],$_POST['password'],$_POST['loginLevel']);
            if($userLevelCompare == 3){
                header("Location: ./");
                die();
            }else{
                echo '<script language="javascript">';
                    echo 'alert("Invalid credentials")';
                echo '</script>';
            }

        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iAttendance</title>

    <link rel="shortcut icon" href="../../assets/ico/favicon.png">
    <!-- Core CSS - Include with every page -->
    <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.html">
                    <img src="../assets/img/logoxxx.png" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>-->
                        <li class="divider"></li>
                        <li><a href="../logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <!--<div class="user-section-inner">
                                <img src="../assets/img/user.jpg" alt="">
                            </div>-->
                            <div class="user-info">
                                <div><?php echo $_SESSION['loginUserFirstName'] . " "?><strong><?php echo $_SESSION['loginUserLastName']?></strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;<?php echo $_SESSION['loginUserLevel'] . " "?>Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <!--<li class="sidebar-search">
                        search section
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        end search section
                    </li>-->
                    <li class="">
                        <?php
                        require_once("../include/DBConfigs.php");
                        if($classDBRelatedFunctions->functionCheckNotification($_SESSION['userID']) == 1){
                            echo '<a href="../"><i class="fa fa-dashboard fa-fw"></i>Dashboard<i class="fa fa-eye fa-fw"></i></a>';
                        }else{
                            echo '<a href="../"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>';
                        }

                        ?>

                    </li>
                    <?php
                        require_once("../include/DBConfigs.php");
                        if($classDBRelatedFunctions->functionCheckUserLevel($_SESSION['userID']) == 2){
                            echo'
                                <li>
                                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Interns<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="../intern">View Interns</a>
                                        </li>
                                        <li>
                                            <a href="../addintern">Add Interns</a>
                                        </li>
                                    </ul>
                                </li>
                                    ';
                        }else if($classDBRelatedFunctions->functionCheckUserLevel($_SESSION['userID']) == 1){
                            echo'
                                <li>
                                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Companies<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="#">View companies</a>
                                        </li>
                                        <li>
                                            <a href="#">Add companies</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Supervisors<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="#">View supervisors</a>
                                        </li>
                                        <li>
                                            <a href="#">Add supervisors</a>
                                        </li>
                                    </ul>
                                </li>
                                    <li>
                                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Interns<span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <a href="../intern">View Interns</a>
                                            </li>
                                            <li>
                                                <a href="../addintern">Add Interns</a>
                                            </li>
                                        </ul>
                                    </li>
                            ';
                        }
                    ?>
                    <li class="selected">
                        <a href="./"><i class="fa fa-eye fa-fw"></i>Intern Login</a>
                    </li>
                        <!-- second-level-items -->
                    <!--<li>
                        <a href="timeline.html"><i class="fa fa-flask fa-fw"></i>Timeline</a>
                    </li>
                    <li class="">
                        <a href="tables.html"><i class="fa fa-table fa-fw"></i>Tables</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-edit fa-fw"></i>Forms</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>UI Elements<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.html">Panels and Wells</a>
                            </li>
                            <li>
                                <a href="buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="notifications.html">Notifications</a>
                            </li>
                            <li>
                                <a href="typography.html">Typography</a>
                            </li>
                            <li>
                                <a href="grid.html">Grid</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    <!--</li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                                <!-- third-level-items -->
                            <!--</li>
                        </ul>
                        <!-- second-level-items -->
                    <!--</li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i>Sample Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="login.html">Login Page</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    <!--</li>-->
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Intern login</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Intern login -->

                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Please Sign In</h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                if(empty($_SESSION['message'])){
                                    $message = "";
                                }else{
                                    $message =  $_SESSION['message'];
                                }
                                echo '
                                        <form role="form" action="./" method="post" class="registration-form">
                                            <fieldset>
                                                <div class="form-group">
                                                    <input class="form-control" name="username" placeholder="username" type="text" id="form-first-name" tabindex="1" required>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="password" placeholder="password" type="password" id="form-last-name" tabindex="2" required>
                                                </div>
											    <input type="hidden" name="loginLevel" value="1">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    ' .  $message . '
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-success btn-block" name="GITM">Login</button>
                                                </div>
                                            </fieldset>
                                        </form>

                                    ';
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--End Intern login-->
                </div>
            </div>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/plugins/pace/pace.js"></script>
    <script src="../assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="../assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>

</html>
