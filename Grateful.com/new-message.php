<?php
require_once("templates/header.php");

if(!isset($_SESSION['username'])){
    header("Location: includes/login.php");
}
?>
  
<!-- form for new message   -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Send a New Message</h1>
    <div class="card shadow-lg">
        <div class="card-body">
            <form id="sendMessageForm" method="post" action="includes/messages.php">
                <div class="mb-3">
                    <label for="recipient" class="form-label">Recipient</label>
                    <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Enter recipient's name" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- button to go back to messages -->
<div class="text-center" style="margin-top: 50px;">
    <a href="messages.php" class="btn btn-warning btn-sm">Back to Messages</a>
</div>


<?php
require_once("templates/footer.php");
?>