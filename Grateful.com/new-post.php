<?php
require_once("templates/header.php");

if(!isset($_SESSION['username'])){
    header("Location: includes/login.php");
}
?>
  
<!-- form for new post -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Send a New Message</h1>
    <div class="card shadow-lg">
        <div class="card-body">
            <form id="sendMessageForm" method="post" action="includes/new-posts.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Message</label>
                    <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter your message" required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="text-center" style="margin-top: 50px;">
    <a href="messages.php" class="btn btn-warning btn-sm">Back to Dashboard</a>
</div>


<?php
require_once("templates/footer.php");
?>