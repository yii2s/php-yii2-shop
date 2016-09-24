<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'zcShop商城系统';
?>
<?= Html::cssFile('public/frontend/menu/css/index.css')?>

<!--  顶部    start-->
<div class="yHeader">
    <!-- 导航   start  -->
    <div class="yNavIndex">
        <div class="pullDown">
            <h2 class="pullDownTitle">
                所有商品分类
            </h2>
            <ul class="pullDownList">
                <?php if ($categories) { ?>
                    <?php foreach ((array)$categories[0] as $k => $category) { ?>
                        <?php $firstCatIDs[] = $category['id']; ?>
                        <li class="">
                            <i class="listi1"></i>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/goods/list', 'cid' => $category['id']])?>" target="_blank"><?= $category['name']?></a>
                            <span></span>
                        </li>
                        <?php if ($k == 14) break;?>
                    <?php } ?>
                <?php } ?>
            </ul>
            <!-- 下拉详细列表具体分类 -->
            <div class="yMenuListCon">
            <?php if ($firstCatIDs) { ?>
                <?php foreach ((array)$firstCatIDs as $catID) { ?>
                    <div class="yMenuListConin">
                        <?php foreach ((array)$categories[$catID] as $category2) { ?>
                            <div class="yMenuLCinList">
                                <h3>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/goods/list', 'cid' => $category2['id']])?>" class="yListName"><?= $category2['name']?></a>
                                    <a href="" class="yListMore">更多 ></a>
                                </h3>
                                <p>
                                    <?php foreach ((array)$categories[$category2['id']] as $k => $category3) { ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['/goods/list', 'cid' => $category3['id']])?>" <?= $k==0 ? 'class="ecolor610"' : ''?> >
                                            <?= $category3['name']; ?>
                                        </a>
                                    <?php } ?>
                                </p>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
            </div>

         <!--   <div class="yMenuListCon">
                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">11精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">11精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">11精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

                <div class="yMenuListConin">
                    <div class="yMenuLCinList">
                        <h3><a href="" class="yListName">精品男装</a><a href="" class="yListMore">更多 ></a></h3>
                        <p>
                            <a href="" class="ecolor610">大牌上新</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                            <a href="">商场同款</a>
                            <a href="">男装集结</a>
                            <a href="">羽绒服</a>
                            <a href="">加厚羽绒 </a>
                            <a href="">高帮鞋</a>
                        </p>
                    </div>
                </div>

            </div>-->

        </div>

        <ul class="yMenuIndex">
            <li><a href="" target="_blank" class="yMenua">首页</a></li>
            <li><a href="" target="_blank">电器城 <span></span></a></li>
            <li><a href="" target="_blank">电器城</a></li>
            <li><a href="" target="_blank">电器城</a></li>
            <li><a href="" target="_blank">电器城</a></li>
            <li><a href="" target="_blank">电器城</a></li>
            <li><a href="" target="_blank">电器城</a></li>
        </ul>
    </div>
    <!-- 导航   end  -->
</div>
<!--  顶部    end-->
<!-- banner   start -->
<div class="yBanner">
    <div class="yBannerList">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner" style="opacity:1;">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

    <div class="yBannerList ybannerHide">
        <div class="yBannerListIn">
            <a href="">
                <img class="ymainBanner" src="public/frontend/menu/images/banner1.jpg">
					<span class="ytextBanner">
					</span>
            </a>
            <div class="yBannerListInRight">
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
                <b class="yimaginaryLine"></b>
                <a href="">
                    <img src="public/frontend/menu/images/BR2.png"/>
                </a>
            </div>
        </div>
    </div>

</div>
<!-- banner   end -->

<div class="row" style="margin-top: 20px">
    <div class="col-lg-2">
        <div id="recommend-goods">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">相关推荐</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$commendGoods as $commend) { ?>
                    <div class="" style="width: 100%;">
                        <div class="thumbnail" style="border: #ffffff">
                            <img src="<?= $commend['ad_img']; ?>" alt="<?= $commend['name']; ?>">
                            <div class="caption">
                                <h3 style="color: #E4393C">¥<?= $commend['sell_price'];?></h3>
                                <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$commend['id']])?>" style="color: #333333"><?= $commend['name']; ?></a></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">热门商品</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$hotGoods as $hot) { ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= $hot['ad_img']; ?>"
                                     alt="<?= $hot['name']; ?>">
                                <div class="caption">
                                    <h3 style="color: #E4393C">¥<?= $hot['sell_price']; ?></h3>
                                    <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$hot['id']])?>" style="color: #333333"><?= $hot['name']; ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">特价商品</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$bargainGoods as $bargain) { ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= $bargain['ad_img']; ?>"
                                     alt="<?= $bargain['name']; ?>">
                                <div class="caption">
                                    <h3 style="color: #E4393C">¥<?= $bargain['sell_price']; ?></h3>
                                    <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$bargain['id']])?>" style="color: #333333"><?= $bargain['name']; ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">最新商品</h3>
                </div>
                <div class="panel-body">
                    <?php foreach((array)$newestGoods as $newest) { ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= $newest['ad_img']; ?>"
                                     alt="<?= $newest['name']; ?>">
                                <div class="caption">
                                    <h3 style="color: #E4393C">¥<?= $newest['sell_price']; ?></h3>
                                    <p><a href="<?= Yii::$app->urlManager->createUrl(['goods/detail','id'=>$newest['id']])?>" style="color: #333333"><?= $newest['name']; ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('@web/public/frontend/menu/js/index.js',
    ['depends' => [JqueryAsset::className()],'position'=>$this::POS_END]
);
?>
