<?php
session_start();
include_once 'token.php';

if (isset($_POST['submit'], $_POST['token'])) {

    if (Token::check($_POST['token'])) {
        require 'config.php';
        $user = !empty($_POST['user']) ? trim(strip_tags($_POST['user'])) : null;
        $ticketid = !empty($_POST['ticketid']) ? trim(strip_tags($_POST['ticketid'])) : null;
        $comment = !empty($_POST['comment']) ? (strip_tags($_POST['comment'])) : null;

        if (
            !empty($comment) && $user && $ticketid
        ) {
            $stmt = $conn->prepare("INSERT INTO comment (comment, user, ticketid)
                VALUES (:comment, :user, :ticketid)");

            $stmt->bindParam(':user', $param_user, PDO::PARAM_STR);
            $stmt->bindParam(':ticketid', $param_ticketid, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $param_comment, PDO::PARAM_STR);

            // insert a row
            $param_user = $user;
            $param_ticketid = $ticketid;
            $param_comment = $comment;
            $stmt->execute();
            ?>
            <script type="text/javascript">
                alert("Comment submitted successfully");
                location = "/SecureSoftwareProject/view-tickets.php";
            </script>
        <?php
                    exit();
                } else {
                    ?>
            <script type="text/javascript">
                alert("Comment Creation Failed: Missing Data Field");
                location = "/SecureSoftwareProject/view-tickets.php";
            </script>
<?php
            exit();
        }
    } else {
        exit(header("Location: /SecureSoftwareProject/invalid.php"));
    }
}
