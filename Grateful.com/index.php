<?php
require_once("templates/header.php");
?>

<div class="container mt-5">
<h1 class="text-center">Posts</h1>
    <div id="postContent" class="d-flex flex-column gap-4">
        <!-- Posts will bet added here -->
    </div>
</div>


<script>

    const username = "<?php 
    if(isset($_SESSION['username'])){
        echo $_SESSION['username']; 
    }
    ?>";


    async function fetchPosts() {
        try{
            let response = await fetch('api/posts.php');
            let data = await response.json();
            const postContent = document.getElementById("postContent");
            postContent.innerHTML = ""; 


            data.forEach(post => {
                // console.log(post);
                // Create a card for each post
                let card = document.createElement('div');

                card.className = "card border-warning";
                card.style.backgroundColor = "rgba(0, 31, 63, 0.8)"; // Navy blue with 50% opacity
                card.style.color = "white"; // White text for better contrast

                // Card Body
                let cardBody = document.createElement('div');
                cardBody.className = "card-body";

                // Post Title
                let h2 = document.createElement('h2');
                h2.className = "card-title";
                h2.style.color = "lightgreen"; // Set text color to dark green
                h2.textContent = post.title;
                cardBody.appendChild(h2);

                // Post Content
                let pContent = document.createElement('p');
                pContent.className = "card-text";
                pContent.textContent = post.content;
                cardBody.appendChild(pContent);

                // Post Author
                let pAuthor = document.createElement('p');
                pAuthor.className = "card-text";
                pAuthor.textContent = `Author: ${post.author}`;
                cardBody.appendChild(pAuthor);

                const divTest = document.createElement("div");
                divTest.className = "d-flex align-items-center";



                // Upvotes Count
                const upvotesCount = post.upvotes || 0; // Fetch upvotes count from the post data

                const upVotesForm = document.createElement("form");
                upVotesForm.innerHTML = `   
                    <button style="background-color: #87CEEB;" class="btn me-2" onclick="upvotesUpdate(event, ${post.id})">
                        Upvotes: ${upvotesCount}
                    </button>
                `;
                divTest.appendChild(upVotesForm);
                cardBody.appendChild(divTest);



                if(username==post.author){
                 

                    // Add the Edit form
                    const editForm = document.createElement("form");
                    editForm.innerHTML = `
                    <button class="btn btn-primary me-2" onclick="editPost(event, ${post.id})">Edit</button>
                    `;
                    divTest.appendChild(editForm);

                    // Add the Delete form
                    const deleteForm = document.createElement("form");
                    deleteForm.innerHTML = `
                    <button class="btn btn-danger" onclick="deletePost(event, ${post.id})">Delete</button>
                    `;
                    divTest.appendChild(deleteForm);

                    cardBody.appendChild(divTest);

                }


                // Append card body to card
                card.appendChild(cardBody);

                // Append card to the postContent container
                postContent.appendChild(card);
            });
            
        }catch{

        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        fetchPosts();
    });


    //upvotes fucntionality
    async function upvotesUpdate(event, postID) {
    event.preventDefault();

    try {
        const response = await fetch('api/upvotes.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ post_id: postID })
        });

        const data = await response.json();

        if (data.success) {
            // Refresh the posts to update upvote count
            fetchPosts(); 
        } else {
            console.error(data.error);
        }
    } catch (error) {
        console.error(error);
    }
}


    // Placeholder for Edit post functionality
    async function editPost(event, postID) {
        event.preventDefault();

        // Find the card body where the edit button was clicked
        const cardBody = event.target.closest('.card-body');

        // Get the existing post content and author text
        const pContent = cardBody.querySelector('.card-text');
        const buttonsDiv = cardBody.querySelector('.d-flex');

        // Save the current content as default for editing
        const currentContent = pContent.textContent;

        // Create the form element
        const editForm = document.createElement('form');
        editForm.innerHTML = `
            <textarea class="form-control mb-2" rows="3">${currentContent}</textarea>
            <button type="button" class="btn btn-success" onclick="submitEdit(event, ${postID})">Save Changes</button>
        `;

        // Replace the content and buttons with the form
        pContent.replaceWith(editForm);
        buttonsDiv.remove(); 
    }


    //Delete post functionality
    async function deletePost(event, postID) {
        event.preventDefault();

        try {
            // Send the delete request
            const response = await fetch('includes/delete-post.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: postID })
            });

            // Parse the JSON response
            const data = await response.json();

            // Call fetchPosts() again to refresh
            if (data.success) {
                fetchPosts();
            } else {
                console.error(data.error);
            }
        } catch (error) {
            console.error(error);
        }
    }

    //edit post functionality
    async function submitEdit(event, postID) {
        event.preventDefault();

        // Get the form and the updated content
        const form = event.target.closest('form');
        const newContent = form.querySelector('textarea').value;

        try {
            // Send the updated content to the server
            const response = await fetch('includes/edit-post.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: postID, content: newContent })
            });

            const data = await response.json();

            if (data.success) {
                // Fetch and repopulate posts
                fetchPosts(); 
            } else {
                console.error(data.error);
            }
        } catch (error) {
            console.error(error);
        }
    }


</script>

<?php
require_once("templates/footer.php");
?>