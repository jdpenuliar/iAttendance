<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        header("Location: ../../");
    }
    if(isset($_POST['btnEditInfoSetter'])){
        /*
         *
         *
         * <input type="hidden" name="sessionInternEditorActivation" value="1">
        <input type="hidden" name="sessionEditInternUserName" value="'. $row['userName'] .'">
        <input type="hidden" name="sessionEditInternUserFirstName" value="'. $row['userFirstName'] .'">
        <input type="hidden" name="sessionEditInternUserMiddleName" value="'. $row['userMiddleName'] .'">
        <input type="hidden" name="sessionEditInternUserLastName" value="'. $row['userLastName'] .'">
        <input type="hidden" name="sessionEditInternUserCompanyID" value="'. $row['userCompanyID'] .'">
        <input type="hidden" name="sessionEditInternUserPrimaryContact" value="'. $row['userPrimaryContact'] .'">
        <input type="hidden" name="sessionEditInternUserSecondaryContact" value="'. $row['userSecondaryContact'] .'">
        <input type="hidden" name="sessionEditInternUserEmailAddress" value="'. $row['userEmailAddress'] .'">
        <input type="hidden" name="sessionEditInternUserAccountStatus" value="'. $row['userAccountStatus'] .'">
         *
         *
         */
        $_SESSION['sessionDeanEditorActivation'] = $_POST['sessionDeanEditorActivation'];
        $_SESSION['sessionEditDeanUserID'] = $_POST['sessionEditDeanUserID'];
        $_SESSION['sessionEditDeanUserName'] = $_POST['sessionEditDeanUserName'];
        $_SESSION['sessionEditDeanUserFirstName'] = $_POST['sessionEditDeanUserFirstName'];
        $_SESSION['sessionEditDeanUserMiddleName'] = $_POST['sessionEditDeanUserMiddleName'];
        $_SESSION['sessionEditDeanUserLastName'] = $_POST['sessionEditDeanUserLastName'];
        $_SESSION['sessionEditDeanUserCompanyID'] = $_POST['sessionEditDeanUserCompanyID'];
        $_SESSION['sessionEditDeanUserPrimaryContact'] = $_POST['sessionEditDeanUserPrimaryContact'];
        $_SESSION['sessionEditDeanUserSecondaryContact'] = $_POST['sessionEditDeanUserSecondaryContact'];
        $_SESSION['sessionEditDeanUserEmailAddress'] = $_POST['sessionEditDeanUserEmailAddress'];
        $_SESSION['sessionEditDeanUserAccountStatus'] = $_POST['sessionEditDeanUserAccountStatus'];
        if(isset($_POST['sessionDeanEditorActivation']) and $_POST['sessionDeanEditorActivation'] == 1){
            header("Location: ../editdean");
        }

    }else{
        unset($_SESSION['sessionCompanyEditorActivation']);
        unset($_SESSION['sessionSupervisorEditorActivation']);
        unset($_SESSION['sessionDeanEditorActivation']);
    }

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>iAttendance</title>

        <link rel="shortcut icon" href="../assets/ico/favicon.png">
        <!-- Core CSS - Include with every page -->
        <link href="../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
        <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
        <link href="../assets/css/style.css" rel="stylesheet" />
        <link href="../assets/css/main-style.css" rel="stylesheet" />

        <!-- Page-Level CSS -->
        <link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/data.js"></script>
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
                <a class="navbar-brand" href="#">
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
                                            <a href="./">View Interns</a>
                                        </li>
                                        <li>
                                            <a href="../addintern">Add Interns</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="../internlogin"><i class="fa fa-eye fa-fw"></i>Intern Login</a>
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
                                                <a href="./">View supervisors</a>
                                            </li>
                                            <li>
                                                <a href="../addsupervisor">Add supervisors</a>
                                            </li>
                                        </ul>
                                    </li>
                                ';
                        }else if($classDBRelatedFunctions->functionCheckUserLevel($_SESSION['userID']) == 0){
                            echo'
                                <li>
                                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Dean<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="./">View Deans</a>
                                        </li>
                                        <li>
                                            <a href="../adddean">Add Deans</a>
                                        </li>
                                    </ul>
                                </li>
                            ';
                        }
                    ?>
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
                    <h1 class="page-header">Dean</h1>
                </div>
                <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dean table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>User Level</th>
                                        <th>User Account Status</th>
                                        <th>Date and Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        require_once("../include/DBConfigs.php");
                                        $classDBRelatedFunctions->functionDeanList($_SESSION['userID']);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->



    <div class="container">
        <!-- Trigger the modal with a button -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalUserID"></h4>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-title" id="modalUserName"></h3>
                        <h3 class="modal-title" id="modalUserFirstName"></h3>
                        <h3 class="modal-title" id="modalUserMiddleName"></h3>
                        <h3 class="modal-title" id="modalUserLastName"></h3>
                        <h3 class="modal-title" id="modalUserLevel"></h3>
                        <h3 class="modal-title" id="modalUserCompanyID"></h3>
                        <h3 class="modal-title" id="modalUserPrimaryContact"></h3>
                        <h3 class="modal-title" id="modalUserSecondaryContact"></h3>
                        <h3 class="modal-title" id="modalUserAccountStatus"></h3>
                        <h3 class="modal-title" id="modalUserEmailAddress"></h3>
                        <h3 class="modal-title" id="modalUserRegistrationDate"></h3>
                        <h3 class="modal-title" id="modalUserTotalHours"></h3>
                        <h3 class="modal-title" id="modalUserRemainingHours"></h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

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
