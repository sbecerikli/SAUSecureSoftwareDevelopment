<?php
session_start();
include_once 'token.php';

if (isset($_POST['login'], $_POST['token'])) {

    if (Token::check($_POST['token'])) {
        require 'config.php';

        $user = !empty($_POST['username']) ? trim(strip_tags($_POST['username'])) : null;
        $pass_try = !empty($_POST['password']) ? trim(strip_tags($_POST['password'])) : null;
        $pass_try2 = !empty($_POST['password2']) ? trim(strip_tags($_POST['password2'])) : null;
        $team = !empty($_POST['team']) ? (strip_tags($_POST['team'])) : null;
        $admin = !empty($_POST['admin']) ? trim(strip_tags($_POST['admin'])) : 0;


        if ($admin === 'admin') {
            $admin = "1";
        } else {
            $admin = "0";
        }

        $stmt = $conn->prepare("SELECT username FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $username = $user;
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            ?>
            <script type="text/javascript">
                alert("Username already exists, please choose another");
                location = "/SecureSoftwareProject/register.php";
            </script>
            <?php
                        exit();
                    } else {
                        if ($pass_try != $pass_try2) {
                            ?>
                <script type="text/javascript">
                    alert("Passwords did not match!");
                    location = "/SecureSoftwareProject/register.php";
                </script>
            <?php
                            exit();
                        } elseif (strlen(trim($_POST["password"])) < 6) {
                            ?>
                <script type="text/javascript">
                    alert("Password must be at least 6 characters or more");
                    location = "/SecureSoftwareProject/register.php";
                </script>
            <?php
                exit;
            } else {
                $stmt = $conn->prepare("INSERT INTO user (username, password, admin, team)
                VALUES (:username, :password, :admin, :team)");

                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':admin', $admin, PDO::PARAM_STR);
                $stmt->bindParam(':team', $team, PDO::PARAM_STR);

                // insert a row
                $username = $user;
                $password = password_hash($pass_try, PASSWORD_DEFAULT); // Creates a password hash
                $stmt->execute();

                echo "New account created successfully";
                exit(header("Location: /SecureSoftwareProject/view-tickets.php"));
            }
        }
    } else {
        exit(header("Location: /SecureSoftwareProject/invalid.php"));
    }
}
