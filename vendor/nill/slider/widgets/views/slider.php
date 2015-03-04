<?php if ($status) : ?>

<section id="main-slider" class="no-margin">
    <div class="carousel slide wet-asphalt">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
            <li data-target="#main-slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php  foreach($slider as $key=>$value) { 
                    static $p=0;
                    $p++;
            ?>
            <div class="item <?php if($p==1) echo 'active'; ?>" style="background-image: url(<?= $this->assetManager->publish('@statics/web/slider/images/'.$value['img'])[1] ?>)">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-content centered text-<?= $value['align'] ?>">
                                <h2 class="animation animated-item-1"><?= $value['h1'] ?></h2>
                                <p class="animation animated-item-2"><?= $value['h2'] ?></p>
                                <h3 class="animation animated-item-3"><?= $value['h3'] ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
            <?php } ?>
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="icon-angle-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="icon-angle-right"></i>
    </a>
</section><!--/#main-slider-->

<?php endif; ?>
