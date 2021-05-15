<?php
session_start();
session_unset();
session_destroy();
include 'header.php';
?>

<style>
body {
    background: #dedede;
}
.page-wrap {
    min-height: 100vh;
}</style>

<div class="page-wrap d-flex flex-row align-items-center">
    <title>403: Error</title>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">403</span>
                <div class="mb-4 lead">Sorry, your session is not longer valid or has expired. You have been logged out of your account, please log in and try again.</div>
                <a href="index.php" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>