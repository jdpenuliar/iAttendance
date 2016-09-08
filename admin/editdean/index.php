<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        header("Location: ../../");
    }else{
        //btnEditInfoSetter
        require_once("../include/DBConfigs.php");
        if(!isset($_SESSION['sessionDeanEditorActivation'])){
            header("Location: ../dean");
        }
        if(isset($_POST['btnSubmit'])){
            if($classDBRelatedFunctions->functionCheckUserLevel($_SESSION['userID']) == 0){
                if(empty($_POST['userName']) or !isset($_POST['userName']) or $_POST['userName'] == "" or $_POST['userName'] == " "){
                    $updatedDeanUserName = $_SESSION['sessionEditDeanUserName'];
                }else{
                    $updatedDeanUserName = $_POST['userName'];
                }

                if((empty($_POST['userPassword']) or !isset($_POST['userPassword']) or $_POST['userPassword'] == "" or $_POST['userPassword'] == " ")
                    or (empty($_POST['userReTypePassword']) or !isset($_POST['userReTypePassword']) or $_POST['userReTypePassword'] == "" or $_POST['userReTypePassword'] == " ")){
                    $updatedDeanUserPassword = null;
                    $updatedDeanUserReTypePassword = null;
                }else{
                    $updatedDeanUserPassword = $_POST['userPassword'];
                    $updatedDeanUserReTypePassword = $_POST['userReTypePassword'];
                }

                if(empty($_POST['userCompanyID']) or !isset($_POST['userCompanyID']) or $_POST['userCompanyID'] == "" or $_POST['userCompanyID'] == " "){
                    $updatedDeanUserCopmanyID = $_SESSION['sessionEditDeanUserCompanyID'];
                }else{
                    $updatedDeanUserCopmanyID = $_POST['userCompanyID'];
                }

                if(empty($_POST['userFirstName']) or !isset($_POST['userFirstName']) or $_POST['userFirstName'] == "" or $_POST['userFirstName'] == " "){
                    $updatedDeanUserFirstName = $_SESSION['sessionEditDeanUserFirstName'];
                }else{
                    $updatedDeanUserFirstName = $_POST['userFirstName'];
                }

                if(empty($_POST['userMiddleName']) or !isset($_POST['userMiddleName']) or $_POST['userMiddleName'] == "" or $_POST['userMiddleName'] == " "){
                    $updatedDeanUserMiddleName = $_SESSION['sessionEditDeanUserMiddleName'];
                }else{
                    $updatedDeanUserMiddleName = $_POST['userMiddleName'];
                }

                if(empty($_POST['userLastName']) or !isset($_POST['userLastName']) or $_POST['userLastName'] == "" or $_POST['userLastName'] == " "){
                    $updatedDeanUserLastName = $_SESSION['sessionEditDeanUserLastName'];
                }else{
                    $updatedDeanUserLastName = $_POST['userLastName'];
                }

                if(empty($_POST['userPrimaryContact']) or !isset($_POST['userPrimaryContact']) or $_POST['userPrimaryContact'] == "" or $_POST['userPrimaryContact'] == " "){
                    $updatedDeanUserPrimaryContact = $_SESSION['sessionEditDeanUserPrimaryContact'];
                }else{
                    $updatedDeanUserPrimaryContact = $_POST['userPrimaryContact'];
                }

                if(empty($_POST['userSecondaryContact']) or !isset($_POST['userSecondaryContact']) or $_POST['userSecondaryContact'] == "" or $_POST['userSecondaryContact'] == " "){
                    $updatedDeanUserSecondaryContact = $_SESSION['sessionEditDeanUserSecondaryContact'];
                }else{
                    $updatedDeanUserSecondaryContact = $_POST['userSecondaryContact'];
                }

                if(empty($_POST['userEmailAddress']) or !isset($_POST['userEmailAddress']) or $_POST['userEmailAddress'] == "" or $_POST['userEmailAddress'] == " "){
                    $updatedDeanUserEmailAddress = $_SESSION['sessionEditDeanUserEmailAddress'];
                }else{
                    $updatedDeanUserEmailAddress = $_POST['userEmailAddress'];
                }

                if(empty($_POST['userAccountStatus']) or !isset($_POST['userAccountStatus']) or $_POST['userAccountStatus'] == "" or $_POST['userAccountStatus'] == " "){
                    $updatedDeanUserAcountStatus = $_SESSION['sessionEditDeanUserAccountStatus'];
                }else{
                    $updatedDeanUserAcountStatus = $_POST['userAccountStatus'];
                }
                $updatedDeanUserID = $_SESSION['sessionEditDeanUserID'];
                $classDBRelatedFunctions->functionEditDean($updatedDeanUserID,$updatedDeanUserName,$updatedDeanUserPassword,$updatedDeanUserReTypePassword,$updatedDeanUserCopmanyID,$updatedDeanUserFirstName,$updatedDeanUserMiddleName,$updatedDeanUserLastName,$updatedDeanUserPrimaryContact,$updatedDeanUserSecondaryContact,$updatedDeanUserEmailAddress,$updatedDeanUserAcountStatus);
                header("Location: ../dean");
            }else{
                echo '<script language="javascript">';
                    echo 'alert("Invalid Supervisor credentials")';
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

        <link rel="shortcut icon" href="../assets/ico/favicon.png">
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
                                            <a href="../intern">View Interns</a>
                                        </li>
                                        <li>
                                            <a href="../">Add Interns</a>
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
                                                <a href="./companies">View companies</a>
                                            </li>
                                            <li>
                                                <a href="./addcompanies">Add companies</a>
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
                        }else if($classDBRelatedFunctions->functionCheckUserLevel($_SESSION['userID']) == 0){
                            echo'
                                <li>
                                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Dean<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="../">View Deans</a>
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
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Dean<small>Do not fill the input if you will not change that particular information</small></h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update user ID <?php echo $_SESSION['sessionEditDeanUserID']?> information
                        </div>
                        <div class="panel-body">
                            <form role="form" action="./" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Username: <?php echo $_SESSION['sessionEditDeanUserName']?></label>
                                            <input class="form-control" placeholder="Username" tabindex="1" name="userName">
                                        </div>
                                        <div class="form-group">
                                            <label>Password (Do not fill if you will not change your password)</label>
                                            <input class="form-control" type="password" placeholder="Password" tabindex="2" name="userPassword">
                                        </div>
                                        <div class="form-group">
                                            <label>Re-type password  (Do not fill if you will not change your password)</label>
                                            <input class="form-control" type="password" placeholder="Re-type password" tabindex="3" name="userReTypePassword">
                                        </div>
                                        <div class="form-group">
                                            <label>User company: <?php
                                                require_once("../include/DBConfigs.php");
                                                echo $classDBRelatedFunctions->functionCompanyListEditX($_SESSION['sessionEditDeanUserCompanyID']);
                                                ?></label>
                                            <select class="form-control" tabindex="4" name="companyID">
                                                <?php
                                                    require_once("../include/DBConfigs.php");
                                                    $classDBRelatedFunctions->functionCompanyList();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>User account status: <?php
                                                if($_SESSION['sessionEditDeanUserAccountStatus'] == 1){
                                                    echo "Active";
                                                }else{
                                                    echo "Inactive";
                                                }
                                                ?></label>
                                            <select class="form-control" tabindex="5" name="userAccountStatus">
                                                <option></option>
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>
                                        <!--<button type="submit" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>-->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>First name: <?php echo $_SESSION['sessionEditDeanUserFirstName']?></label>
                                            <input class="form-control" placeholder="First name" tabindex="6" name="userFirstName" >
                                        </div>
                                        <div class="form-group">
                                            <label>Middle name: <?php echo $_SESSION['sessionEditDeanUserMiddleName']?></label>
                                            <input class="form-control" placeholder="Middle name" tabindex="7" name="userMiddleName" >
                                        </div>
                                        <div class="form-group">
                                            <label>Last name: <?php echo $_SESSION['sessionEditDeanUserLastName']?></label>
                                            <input class="form-control" placeholder="Last name" tabindex="8" name="userLastName" >
                                        </div>
                                        <div class="form-group">
                                            <label>Primary contact: <?php echo $_SESSION['sessionEditDeanUserPrimaryContact']?></label>
                                            <input class="form-control" placeholder="Primary contact (Phone number)" tabindex="9" name="userPrimaryContact" onkeypress="return isNumberKey(event)" >
                                        </div>
                                        <div class="form-group">
                                            <label>Secondary contact: <?php echo $_SESSION['sessionEditDeanUserSecondaryContact']?></label>
                                            <input class="form-control" placeholder="Secondary contact" tabindex="10" name="userSecondaryContact" onkeypress="return isNumberKey(event)" >
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address: <?php echo $_SESSION['sessionEditDeanUserEmailAddress']?></label>
                                            <input class="form-control" placeholder="Email Address" tabindex="10" name="userEmailAddress" tabindex="11" type="email" >
                                        </div>
                                        <!--<button type="submit" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Form Elements -->
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
    <script type="text/javascript">
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
</body>

</html>
