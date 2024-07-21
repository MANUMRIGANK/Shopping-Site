

<h1 class="page-header">
  Product Categories
</h1>


<div class="col-md-4">
    
    <form action="../../template/back/add_category.php" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input autocomplete="off" type="text" name="catergoryname" class="form-control">
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
                        <th>Title</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                        </thead>
                <tbody >
                    
    <?php 
    display_category_in_admin();
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
