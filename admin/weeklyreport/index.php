<?php
    session_start();
    unset($_SESSION['sessionCompanyEditorActivation']);
    if(!isset($_SESSION['userID'])){
        header("Location: ../../");
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
        <script type="text/javascript" src="../js/datax.js"></script>
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
                                                <a href="./">Add Interns</a>
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
                        <h1 class="page-header">View Intern <?php echo $_SESSION['sessionViewWeeklyReportUserID'] ?> Weekly report</h1>
                    </div>
                    <!--end page header -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Input information
                            </div>
                            <div class="panel-body">

                                <form target="_blank" role="form" action="./pdf/index.php" method="get">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Start Year</label>
                                                <input type="text" class="form-control" placeholder="yyyy" tabindex="1" name="viewWeeklyReportStartYearx" id="viewWeeklyReportStartYearx" maxlength="4" onkeypress="return isNumberKey(event)" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Start Month</label>
                                                <select class="form-control" tabindex="2" name="viewWeeklyReportStartMonth" id="viewWeeklyReportStartMonth"required>
                                                    <option></option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Start Day</label>
                                                <select class="form-control" tabindex="3" name="viewWeeklyReportStartDay" id="viewWeeklyReportStartDay" required>
                                                    <option></option>
                                                    <?php
                                                        for($x=1;$x<=31;$x++){
                                                            if($x<10){
                                                                $x = "0"+$x;
                                                            }
                                                            echo '<option value="'. $x .'">'. $x .'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <!--<button type="submit" class="btn btn-primary">Submit Button</button>
                                            <button type="reset" class="btn btn-success">Reset Button</button>-->
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>End Year</label>
                                                <input class="form-control" placeholder="yyyy" tabindex="4" name="viewWeeklyReportEndYear" id="viewWeeklyReportEndYear" maxlength="4" onkeypress="return isNumberKey(event)" required>
                                            </div>
                                            <div class="form-group">
                                                <label>End Month</label>
                                                <select class="form-control" tabindex="5" name="viewWeeklyReportEndMonth" id="viewWeeklyReportEndMonth" required>
                                                    <option></option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>End Day</label>
                                                <select class="form-control" tabindex="6" name="viewWeeklyReportEndDay" id="viewWeeklyReportEndDay" required>
                                                    <option></option>
                                                    <?php
                                                        for($x=1;$x<=31;$x++){
                                                            if($x<10){
                                                                $x = "0"+$x;
                                                            }
                                                            echo '<option value="'. $x .'">'. $x .'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <?php

                                                    echo'<button value="'.$_SESSION['sessionViewWeeklyReportUserID'].'" type="button" onClick="processx(value,startDate(),endDate());" class="btn btn-primary" data-toggle="modal" data-target="#myModal">View</button>';
                                                    //echo'<button value="'.$_SESSION['sessionViewWeeklyReportUserID'].' type="button" onClick="startDate();" class="btn btn-primary" data-toggle="modal" data-target="#myModal">View</button>'
                                                    //echo '<button type="button" name="x" class="btn btn-primary" onClick="startDate();">x</button>';
                                                ?>
                                                <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-success">Reset</button>
                                            </div>
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
                            <h3 class="modal-title" id="modalUserTotalWeekTime"></h3>
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
                            <button type="button" class="btn btn-default">Print</button>
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
        <script type="text/javascript">
            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
            function startDate(){
                var viewWeeklyReportStartDate = "";
                var viewWeeklyReportStartYear = document.getElementById('viewWeeklyReportStartYearx');
                var viewWeeklyReportStartMonth = document.getElementById('viewWeeklyReportStartMonth');
                var viewWeeklyReportStartDay = document.getElementById('viewWeeklyReportStartDay');
                //alert(viewWeeklyReportStartYear.value + "-" + viewWeeklyReportStartMonth.value + "-" +viewWeeklyReportStartDay.value);
                //alert("x" + viewWeeklyReportStartDay.value);
                
                viewWeeklyReportStartDate = viewWeeklyReportStartYearx.value + "-" + viewWeeklyReportStartMonth.value + "-" + viewWeeklyReportStartDay.value;
                //alert(viewWeeklyReportStartDate);
                return viewWeeklyReportStartDate;
            }
            function endDate(){
                var viewWeeklyReportEndDate = "";
                var viewWeeklyReportEndYear = document.getElementById('viewWeeklyReportEndYear');
                var viewWeeklyReportEndMonth = document.getElementById('viewWeeklyReportEndMonth');
                var viewWeeklyReportEndDay = document.getElementById('viewWeeklyReportEndDay');
                //alert("x" + xx.value);
                //alert(viewWeeklyReportEndYear.value + "-" + viewWeeklyReportEndMonth.value + "-" +viewWeeklyReportEndDay.value);
                viewWeeklyReportEndDate = viewWeeklyReportEndYear.value + "-" + viewWeeklyReportEndMonth.value + "-" + viewWeeklyReportEndDay.value;
                //alert(viewWeeklyReportEndDate);
                return viewWeeklyReportEndDate;
            }
        </script>
    </body>

</html>
