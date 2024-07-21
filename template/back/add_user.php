

<h1 class="page-header">
  Add User
</h1>


<div class="col-md-4">
    
    <form action="../../template/back/add_admin.php" method="post">
    
        <div class="form-group">
            <label for="User-name">Name</label>
            <input autocomplete="off" type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="user-username">Username</label>
            <input autocomplete="off" type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="user-pass">Password</label>
            <input autocomplete="off" type="text" name="pass" class="form-control">
        </div>

        <div class="form-group">
            
            <input type="submit" class="btn btn-primary" value="Add Category">
            </div>      


    </form>


</div>


<div class="col-md-8" id="scrollableElement" style = "max-height: 200px; overflow-y: hidden;">
<table class="table">
                        <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Username</th>
                        <th>Name</th>
                    </tr>
                        </thead>
                <tbody >
                    
    <?php 
    display_admins_in_admin();
    ?>
    </tbody>

</table>

</div>


<script>

document.addEventListener("DOMContentLoaded", function() {
    var scrollableElement = document.getElementById("scrollableElement");

    // Function to check the height and enable scrolling if needed
    function checkHeight() {
        if (scrollableElement.scrollHeight > scrollableElement.clientHeight) {
            scrollableElement.style.overflowY = "auto";
        } else {
            scrollableElement.style.overflowY = "hidden";
        }
    }

    // Initial check
    checkHeight();

    // Optional: Recheck if the content changes
    var observer = new MutationObserver(checkHeight);
    observer.observe(scrollableElement, { childList: true, subtree: true });
});
</script>
