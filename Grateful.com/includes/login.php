<?php
require_once("../templates/header.php");

?>


<!-- login form -->
<h2 class="text-center" style = "padding-top: 20vh;">Login</h2>
<div class="row justify-content-center mt-4">
    <div class="col-md-4">
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
                <p class="text-danger" id="issue"></p>
            <button type="submit" class="btn btn-warning text-black">Login</button>
        </form>
    </div>
</div>

<script>

    document.querySelector('form').addEventListener('submit', function (event) {
        // Prevent the default form submission behavior
        event.preventDefault(); 

        // Get the input values
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;


        // Send the data to the server
        fetch('validate.php', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json', 
            },
            body: JSON.stringify({ 
                'username' : username, 
                'password' : password }) 
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            
            //showing error login messages to user
            if(data.status=="fail"){
                let issue = document.getElementById("issue");
                issue.textContent = data.error;
            }else{
                window.location.href = "../index.php";
            }

            
        })
        .catch(error => {
            //shwoing errors
            console.error('Error:', error); 
        });
    });
</script>
<?php
require_once("../templates/footer.php")
?>