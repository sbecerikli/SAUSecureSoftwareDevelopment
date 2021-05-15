<?php
session_start();
include_once 'token.php';

$token = $_POST['token'];

if (isset($_POST['login'], $_POST['token'])) {
    if (Token::check($_POST['token'])) {
        require 'config.php';

        $user = !empty($_POST['username']) ? strip_tags($_POST['username']) : null;
        $pass_try = !empty($_POST['password']) ? strip_tags($_POST['password']) : null;

        $sql = "SELECT userid, username, password, team, admin FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $user);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $result['userid'];
        $username = $result['username'];
        $team = $result['team'];
        $admin = $result['admin'];


        if ($result['username'] != $user) {
            ?>
            <script type="text/javascript">
                alert("Invalid Username");
                location = "/SecureSoftwareProject/index.php";
            </script>
            <?php
                        exit();
                    } else {
                        if (password_verify($pass_try, $result['password'])) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["userid"] = $user_id;
                            $_SESSION["team"] = $team;
                            $_SESSION["username"] = $username;

                            if ($admin === "1") {
                                $_SESSION["admin"] = true;
                            } else {
                                $_SESSION["admin"] = false;
                            }
                            exit(header("Location: /SecureSoftwareProject/view-tickets.php"));
                        } else {
                            ?>
                <script type="text/javascript">
                    alert("Invalid Password");
                    location = "/SecureSoftwareProject/index.php";
                </script>
<?php
                exit();
            }
        }
    } else {
        exit(header("Location: /SecureSoftwareProject/invalid.php"));
    }
}
?>