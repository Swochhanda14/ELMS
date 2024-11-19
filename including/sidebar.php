<?php
require('db_connection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
?>
        
        <!-- sidenavbar  -->
        <div class="sidebar">

            <div class="menu-btn" style="z-index: 100;"> 
                <span class="material-symbols-rounded open" aria-hidden="true">menu</span>
            </div>

            <!-- logo space  -->
            <div class="head">

                <div class="user-img">
                    <img src="../assets/logo/logo.png" alt="">
                </div>

                <div class="user-detail">
                    <p class="title">ELMS</p>
                    <p class="name">Admin</p>
                </div>

            </div>
            <!-- logo space  -->

            <!-- nav list space  -->
            <div class="nav">
                <div class="menu">
                    <p class="title">Main</p>
                    <ul>
                        <li>
                            <a href="dashboard.php">
                                <span class="material-symbols-rounded">dashboard</span>
                                <span class="text"">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="employeesection.php">
                                <span class="material-symbols-rounded">badge</span>
                                <span class="text">Employee Section</span>
                            </a>
                        </li>

                        <li>
                            <a href="departmentsection.php">
                                <span class="material-symbols-rounded">departure_board</span>
                                <span class="text">Department Section</span>
                            </a>
                        </li>

                        <li>
                            <a href="leavetype.php">
                                <span class="material-symbols-rounded">logout</span>
                                <span class="text">Leave type</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span class="material-symbols-rounded">manage_accounts</span>
                                <span class="text">Manage Leave</span>
                                <i class="fa-solid fa-caret-down arrow"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="pending.php">
                                        <span class="material-symbols-rounded">pending</span>
                                        <span class="text">Pending</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="approved.php">
                                        <span class="material-symbols-rounded">check_box</span>
                                        <span class="text">Approved</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="decline.php">
                                        <span class="material-symbols-rounded">cancel</span>
                                        <span class="text">Declines</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="leavehistory.php">
                                        <span class="material-symbols-rounded">manage_history</span>
                                        <span class="text">Leave History</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="manageadmin.php">
                                <span class="material-symbols-rounded">admin_panel_settings</span>
                                <span class="text">Manage Admin</span>
                            </a>
                        </li>




                    </ul>
                </div>


            </div>

            <hr>
            <div class="menu">
                <p class="title">Privacy</p>
                <ul>
                    <li>
                         <a href="logout.php">
                            <span class="material-symbols-rounded">logout</span>
                            <span class="text">Logout</span>
                         </a> 
                    </li>

                </ul>
            </div>
            <!-- nav list space  -->
        </div>
        <!-- sidenavbar  -->