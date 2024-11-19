<?php
require('../including/db_connection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['email'])) {
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
                            <a href="applyleave.php">
                                <span class="material-symbols-rounded">person</span>
                                <span class="text"">Apply Leave</span>
                            </a>
                        </li>

                        <li>
                            <a href="viewleave.php">
                                <span class="material-symbols-rounded">wysiwyg</span>
                                <span class="text">View Leave history</span>
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
                         <a href="logoutemployee.php">
                            <span class="material-symbols-rounded">logout</span>
                            <span class="text">Logout</span>
                         </a> 
                    </li>

                </ul>
            </div>
            <!-- nav list space  -->
        </div>
        <!-- sidenavbar  -->