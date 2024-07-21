<h1 class="page-header">
  Carousel Slides
</h1>

<style>
   .rightImg{
    position:relative;  
   }
    .rightImg:hover img{
        height: 300px;  
        width : 300px;
    }
</style>
<div class="col-md-4">
    
    <form action="../../template/back/add_slides.php" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input autocomplete="off" type="text" name="slide_name" class="form-control">
            <input type="file" name="fileToUpload" class="form-control">
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
                        <th>Img</th>
                        <th>Delete</th>
                    </tr>
                        </thead>
                <tbody>

    <?php 
    
    display_slides_inadmin();

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
