<?php
// Footer functionality
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- 
<script>

document.addEventListener("DOMContentLoaded", () => {

    const htmlElement = document.documentElement; // Refers to the <html> tag
    const theme = <?php
    
    // if(isset($_COOKIE['theme'])){
    //     echo "'dark'";
    // }else{
    //     echo "''";
    // }
      
    ?>;
    if (theme=='dark') {
        htmlElement.setAttribute("data-bs-theme", "dark"); // Apply dark theme
    }
})


document.getElementById("darkTheme").addEventListener("click", (event) => {
    event.preventDefault(); 

    const htmlElement = document.documentElement; // Refers to the <html> tag

    fetch("includes/cookie-processing.php", {
        method : "POST",
        headers : {
            "Content-Type": "application/json"
        },
        body : JSON.stringify({ "theme" : "dark"})
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);

        if(data['theme']==="dark"){
            htmlElement.setAttribute("data-bs-theme", "dark");
        }else

        if(data['theme']==="light"){
            htmlElement.removeAttribute("data-bs-theme");   
        }   
    });

});
</script> -->
