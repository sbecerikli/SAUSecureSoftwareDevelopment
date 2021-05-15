<?php
session_start();
include_once 'token.php';

if (isset($_POST['submit'], $_POST['token'])) {

    if (Token::check($_POST['token'])) {
        require 'config.php';

        $ticket = !empty($_POST['ticketname']) ? (strip_tags($_POST['ticketname'])) : null;
        $ticket_type = !empty($_POST['ticket_type']) ? trim(strip_tags($_POST['ticket_type'])) : null;
        $description = !empty($_POST['description']) ? (strip_tags($_POST['description'])) : null;
        $priority = !empty($_POST['priority']) ? trim(strip_tags($_POST['priority'])) : null;
        $status = !empty($_POST['status']) ? trim(strip_tags($_POST['status'])) : null;
        $finder = !empty($_POST['finder']) ? trim(strip_tags($_POST['finder'])) : null;
        $assigned_user = !empty($_POST['assigneduser']) ? trim(strip_tags($_POST['assigneduser'])) : null;
        $teamname = !empty($_POST['team']) ? trim(strip_tags($_POST['team'])) : null;

        if (
            !empty($ticket)  && !empty($ticket_type)  && !empty($description) && !empty($priority)
            && !empty($status)  && !empty($finder)  && !empty($assigned_user) && !empty($teamname)
        ) {
            $stmt = $conn->prepare("SELECT ticketname FROM ticket WHERE ticketname = :ticketname");
            $stmt->bindParam(':ticketname', $ticketname);
            $ticketname = $ticket;
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                ?>
                <script type="text/javascript">
                    alert("Ticketname already exists, please choose another");
                    location = "/SecureSoftwareProject/submit-ticket.php";
                </script>
            <?php
                            exit();
                        } else {
                            $stmt = $conn->prepare("INSERT INTO ticket (ticketname, ticket_type, description, priority, status, finder, assigneduser, teamname)
                            VALUES (:ticketname, :ticket_type, :description, :priority, :status, :finder, :assigned_user, :team)");

                            $stmt->bindParam(':ticketname', $param_ticketname, PDO::PARAM_STR);
                            $stmt->bindParam(':ticket_type', $param_ticket_type, PDO::PARAM_STR);
                            $stmt->bindParam(':description', $param_description, PDO::PARAM_STR);
                            $stmt->bindParam(':priority', $param_priority, PDO::PARAM_STR);
                            $stmt->bindParam(':status', $param_status, PDO::PARAM_STR);
                            $stmt->bindParam(':finder', $param_finder, PDO::PARAM_STR);
                            $stmt->bindParam(':assigned_user', $param_assigned_user, PDO::PARAM_STR);
                            $stmt->bindParam(':team', $param_team, PDO::PARAM_STR);

                            // // insert a row
                            $param_ticketname = $ticket;
                            $param_ticket_type = $ticket_type;
                            $param_description = $description;
                            $param_priority = $priority;
                            $param_status = $status;
                            $param_finder = $finder;
                            $param_assigned_user = $assigned_user;
                            $param_team = $teamname;
                            $stmt->execute();
                            ?>
                <script type="text/javascript">
                    alert("New records created successfully");
                    location = "/SecureSoftwareProject/view-tickets.php";
                </script>
            <?php
                            exit();
                        }
                    } else {
                        ?>
            <script type="text/javascript">
                alert("Ticket Creation Failed: Missing Data Field");
                location = "/SecureSoftwareProject/submit-ticket.php";
            </script>
<?php
            exit();
        }
    } else {
        exit(header("Location: /SecureSoftwareProject/invalid.php"));
    }
}
