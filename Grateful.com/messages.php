<?php
require_once("templates/header.php");

if(!isset($_SESSION['username'])){
    header("Location: includes/login.php");
}
?>

<div class="text-center" style="margin-top: 50px;">
    <a href="new-message.php" class="btn btn-primary">Send New Message</a>
</div>

<div class="container mt-5">
    <h2 class="text-center">Recieved Messages</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Sender Username</th>
                <th scope="col">Content</th>
                <th scope="col">Time Recieved</th>
            </tr>
        </thead>
        <tbody id="recBody">
            <!-- Example data rows, replace with PHP loop to generate rows dynamically -->
            
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2 class="text-center">Messages Sent</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Receiver Username</th>
                <th scope="col">Content</th>
                <th scope="col">Time Sent</th>
            </tr>
        </thead>
        <tbody id="sentBody">
            <!-- Example data rows, replace with PHP loop to generate rows dynamically -->
            
        </tbody>
    </table>
</div>


<script>
let recMsgId = 0;
let sentMsgId = 0;
let user_id = <?php echo $_SESSION['user_id']?>;

    async function getRecMessages(){
        try{
            let response = await fetch('api/rec-messages.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({'id' : user_id})
            });

            let data = await response.json();

            if(recMsgId==0){
                recMsgId = data[0]['message_id'];
                data.forEach(msg => {
                    let recBody = document.getElementById("recBody");
                    let tr = document.createElement("tr");

                    let tdUser = document.createElement("td");
                    tdUser.textContent = msg['sender_username'];

                    let tdContent = document.createElement("td");
                    tdContent.textContent = msg['content'];

                    let tdTime = document.createElement("td");
                    tdTime.textContent = msg['timestamp'];

                    tr.appendChild(tdUser);
                    tr.appendChild(tdContent);
                    tr.appendChild(tdTime);

                    recBody.appendChild(tr);
                });
            }

            if(recMsgId<data[0]['message_id']){

                let msg = data[0];
                let recBody = document.getElementById("recBody");
                let tr = document.createElement("tr");

                let tdUser = document.createElement("td");
                tdUser.textContent = msg['sender_username'];

                let tdContent = document.createElement("td");
                tdContent.textContent = msg['content'];

                let tdTime = document.createElement("td");
                tdTime.textContent = msg['timestamp'];

                tr.appendChild(tdUser);
                tr.appendChild(tdContent);
                tr.appendChild(tdTime);

                recBody.appendChild(tr);
                recMsgId = data[0]['message_id'];
                
            }
            

        }
        catch{
            console.error(error);
        }
    }


    async function getSentMessages(){
        try{
            let response = await fetch('api/sent-messages.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({'id' : user_id})
            });

            let data = await response.json();

            if(sentMsgId==0){
                sentMsgId = data[0]['message_id'];
                data.forEach(msg => {

                let sentBody = document.getElementById("sentBody");
                let tr = document.createElement("tr");

                let tdUser = document.createElement("td");
                tdUser.textContent = msg['receiver_username'];

                let tdContent = document.createElement("td");
                tdContent.textContent = msg['content'];

                let tdTime = document.createElement("td");
                tdTime.textContent = msg['timestamp'];

                tr.appendChild(tdUser);
                tr.appendChild(tdContent);
                tr.appendChild(tdTime);

                sentBody.appendChild(tr);
                });
            }
        
        }
        catch{

        }
    }   
    getRecMessages();
    setInterval(getRecMessages, 5000);
    getSentMessages();

</script>

<?php
require_once("templates/footer.php");
?>