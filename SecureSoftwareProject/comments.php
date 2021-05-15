<?php
include_once 'scripts/token.php';
include_once "scripts/session_check.php";
include 'header.php';
include 'navbar.php';

if (isset($_POST['submit'], $_POST['token'])) {

	if (Token::check($_POST['token'])) {
		require 'scripts/config.php';
		$id = $_POST['ticketid'];
		?>
		<div class="container-fluid">
			<!-- Page Content  -->
			<div class="row justify-content-center">
				<div class="col-11 col-md-6">
					<?php
							require 'scripts/config.php';
							$tickets = $conn->query('SELECT * FROM ticket WHERE ticketid = ' . $id)->fetchAll();
							$token = Token::generate();
							foreach ($tickets as $ticket) {
								$ticketid = htmlspecialchars($ticket['ticketid']);
								?>
						<form method="POST" action="scripts/comment.php">
							<div class="form-group row">
								<?php
											echo "<h2>", htmlspecialchars($ticket['ticketname']), "</h2>";
									?>
							</div>
							<div class="form-group row">
								<?php
											echo "<p><strong>Assigned User: </strong>", htmlspecialchars($ticket['assigneduser']), "</p>";
											?>
							</div>
							<div class="form-group row">
								<?php
											echo "<p><strong>Ticket Priority: </strong>", htmlspecialchars($ticket['priority']), "</p>";
											?>
							</div>
							<div class="form-group row">
								<?php
											echo "<p><strong>Date Created: </strong>", htmlspecialchars($ticket['datecreated']), "</p>";
											?>
							</div>
							<div class="form-group row">
								<?php
											echo "<p><strong>Ticket Type: </strong>", htmlspecialchars($ticket['ticket_type']), "</p>";
											?>
							</div>
							<div class="form-group row">
								<?php
											echo "<p><strong>Description: </strong>", htmlspecialchars($ticket['description']), "</p>";
											?>
							</div>
							<div class="form-group row">
								<?php
											echo "<h4><strong>Ticket Status: </strong>", htmlspecialchars($ticket['status']), "</strong></h4>";
											?>
							</div>
							<?php
										// if ($ticket['status'] === 'open' && $ticket['assigneduser'] === $_SESSION['username']) {
										if ($ticket['status'] === 'open') {

											?>
								<div class="form-group row">
									<input name="comment" type="text" class="form-control" id="comment" placeholder="Submit Comment">
								</div>
								<button type="submit" name="submit" class="btn btn-primary">Submit Comment</button>
							<?php
										} ?>
							<input type="hidden" name="ticketid" value="<?php echo htmlspecialchars($ticket['ticketid']) ?>">
							<input type="hidden" name="ticketid" value="<?php echo htmlspecialchars($ticket['ticketid']) ?>">
							<input type="hidden" name="user" value="<?php echo $_SESSION['username'] ?>">
							<input type="hidden" name="token" value="<?php echo $token; ?>">
						</form>
					<?php
							} ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-11 col-md-6">
					<hr />
					<label>
						<h5><strong><em>Comments:</em></strong></h5>
					</label>
					<?php
							require 'scripts/config.php';
							$comments = $conn->query('SELECT * FROM comment WHERE ticketid = ' . $id)->fetchAll();
							foreach ($comments as $comment) {
								$ticketid = htmlspecialchars($comment['ticketid']);
								?>
						<form method="POST" action="scripts/comment.php">
							<div class="form-group row">
								<?php
											echo "<p>", htmlspecialchars($comment['comment']), "</p>";
											?>
							</div>
							<div class="form-group row">
								<?php
											echo "<p class='text-muted'>By <strong>", htmlspecialchars($comment['user']), "</strong> at ", htmlspecialchars($comment['commentdate']), "</p>";
											?>
							</div>

						</form>
						<hr />
					<?php
							} ?>
				</div>
			</div>
	<?php
			exit();
		} else {
			exit(header("Location: /SecureSoftwareProject/invalid.php"));
		}
	}
	include 'footer.php';
