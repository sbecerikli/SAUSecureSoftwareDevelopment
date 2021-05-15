<?php
session_start();
include_once 'token.php';

if (isset($_POST['submit'], $_POST['token'])) {

    if (Token::check($_POST['token'])) {
        require 'config.php';

        $id = $_POST['id'];
        $ticket = !empty($_POST['ticketname']) ? (strip_tags($_POST['ticketname'])) : null;
        $ticket_type = !empty($_POST['ticket_type']) ? trim(strip_tags($_POST['ticket_type'])) : null;
        $description = !empty($_POST['description']) ? (strip_tags($_POST['description'])) : null;
        $priority = !empty($_POST['priority']) ? trim(strip_tags($_POST['priority'])) : null;
        $status = !empty($_POST['status']) ? trim(strip_tags($_POST['status'])) : null;
        $finder = !empty($_POST['finder']) ? trim(strip_tags($_POST['finder'])) : null;
        $assigned_user = !empty($_POST['assigneduser']) ? trim(strip_tags($_POST['assigneduser'])) : null;

        $stmt = $conn->prepare("SELECT ticketname FROM ticket WHERE ticketname = :ticketname");
        $stmt->bindParam(':ticketname', $ticketname);
        $ticketname = $ticket;
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE ticket SET ticketname = :ticketname, ticket_type = :ticket_type, description = :description, priority = :priority, 
                        status = :status, finder = :finder, assigneduser = :assigned_user WHERE ticketid = :id");

        $stmt->bindParam(':ticketname', $param_ticketname, PDO::PARAM_STR);
        $stmt->bindParam(':ticket_type', $param_ticket_type, PDO::PARAM_STR);
        $stmt->bindParam(':description', $param_description, PDO::PARAM_STR);
        $stmt->bindParam(':priority', $param_priority, PDO::PARAM_STR);
        $stmt->bindParam(':status', $param_status, PDO::PARAM_STR);
        $stmt->bindParam(':finder', $param_finder, PDO::PARAM_STR);
        $stmt->bindParam(':assigned_user', $param_assigned_user, PDO::PARAM_STR);
        $stmt->bindParam(':id', $param_id, PDO::PARAM_STR);

        // // insert a row
        $param_ticketname = $ticket;
        $param_ticket_type = $ticket_type;
        $param_description = $description;
        $param_priority = $priority;
        $param_status = $status;
        $param_finder = $finder;
        $param_assigned_user = $assigned_user;
        $param_id = $id;
        $stmt->execute();
        ?>
        <script type="text/javascript">
            alert("New records created successfully");
            location = "/SecureSoftwareProject/view-tickets.php";
        </script>
<?php
    } else {
        exit(header("Location: /SecureSoftwareProject/invalid.php"));
    }
}
