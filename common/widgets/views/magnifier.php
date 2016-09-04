<?php
?>
<!--<div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>-->
<div class="sp-wrap">
    <?php if ($imgUrls) { ?>
        <?php foreach ($imgUrls as $url) { ?>
            <a href="<?= $url['s0']?>"><img src="<?= $url['s1']?>" alt=""></a>
        <?php } ?>
    <?php } ?>
   <!-- <a href="public/common/magnifier/images/2.jpg"><img src="public/common/magnifier/images/2_tb.jpg" alt=""></a>
    <a href="public/common/magnifier/images/3.jpg"><img src="public/common/magnifier/images/3_tb.jpg" alt=""></a>
    <a href="public/common/magnifier/images/4.jpg"><img src="public/common/magnifier/images/4_tb.jpg" alt=""></a>
    <a href="public/common/magnifier/images/5.jpg"><img src="public/common/magnifier/images/5_tb.jpg" alt=""></a>
    <a href="public/common/magnifier/images/6.jpg"><img src="public/common/magnifier/images/6_tb.jpg" alt=""></a>
    <a href="public/common/magnifier/images/6.jpg"><img src="public/common/magnifier/images/6_tb.jpg" alt=""></a>-->
</div>
