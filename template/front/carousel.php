<div class="row carousel-holder">

<div class="col-md-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <?php getting_the_caraousel_dots();?>
        </ol>
        <div class="carousel-inner" >
                    
            <div class="item active">
                <img class="slide-image" src="http://placehold.it/800x300" alt="">
            </div>
            <?php display_carousel(); ?>
            
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>

</div>