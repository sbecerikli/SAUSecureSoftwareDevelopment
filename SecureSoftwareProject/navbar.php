<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <h3><a class="nav-link" href="view-tickets.php">Bug Tracker</a></h3>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="submit-ticket.php">Submit Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view-tickets.php">View Tickets</a>
                </li>
                <?php
               


                if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
                    ?>
                <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register a new User</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="show-users.php">Show Users</a>
                    </li>
                <?php }

                 if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                    ?>
                <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php }

                // if (!isset($_SESSION["admin"]) !== true) {
                //     
                ?>
                <!-- <li class="nav-item">
                //         <a class="nav-link" href="Register.php">Register New User</a>
                //     </li> -->
                <?php
                // } 
                ?>
            </ul>
        </div>
    </div>
</nav>