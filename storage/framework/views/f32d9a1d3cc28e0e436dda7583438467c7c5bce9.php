  <footer class="t-ft">
            <div class="container">
                <div class="wide-separator-line bg-mid-gray no-margin-lr margin-three no-margin-bottom"></div>
                <div class="row t-div-head-ft">
                    <div class="col-md-6 col-sm-6 footer-social t-soc">
                       <?php $social =  App\Item::where('key_layout','Social')->get();?>
                        <!-- social media link -->
                        <?php if(isset($social[0])): ?>
                        <a target="_blank" href="<?php echo e($social[0]->link); ?>"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if(isset($social[1])): ?>
                        <a target="_blank" href="<?php echo e($social[1]->link); ?>"><i class="fa fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if(isset($social[2])): ?>
                        <a target="_blank" href="<?php echo e($social[2]->link); ?>"><i class="fa fa-google-plus"></i></a>
                        <?php endif; ?>
                        <?php if(isset($social[3])): ?>
                        <a target="_blank" href="<?php echo e($social[3]->link); ?>"><i class="fa fa-youtube"></i></a>
                        <?php endif; ?>
                        <!-- end social media link -->
                    </div>
                    <div class="col-md-4 col-md-offset-2 col-sm-6">
                        <form id="d-form-uudai">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input class="t-ip-text d-uudai-email" name="email" type="email" style="width:230px" placeholder="Email nhận ưu đãi">
                            <input class="t-ip-sm d-xac-nhan" type="submit" value="Gửi" >
                        </form>
                    </div>
                </div>
                <div class="row">
                <?php
                    $dataft1 = App\Category::get();
                    $dataft2 = App\Post::get();
                    $dataft3 = App\Post_category::get();
                ?>
                <?php foreach($dataft1 as $item1): ?>
                        <div class="col-md-3 col-sm-3 col-xs-12 d-footer-menu-part2" style="margin-bottom: 30px">
                            <!-- headline -->
                            <h5 class="show_cate_footer"><?php echo e($item1->name); ?></h5>
                            <!-- end headline -->
                            <!-- link -->
                            <ul class="footer-hidden_x">
                                <?php foreach($dataft2 as $item2): ?>
                                    <?php foreach($dataft3 as $item3): ?>
                                        <?php if($item3->post_id == $item2->id && $item3->category_id == $item1->id): ?>
                                        <li><a href="<?php echo e(route('view.blog',['id'=>$item2->id, 'alias' => $item2->slug])); ?>"><?php echo e($item2->title); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                            <!-- end link -->
                        </div>
                      
                <?php endforeach; ?>
                </div>
            </div>
            <div class="container-fluid bg-dark-gray footer-bottom">
                <div class="container">
                    <div class="row margin-one">
                        <!-- copyright -->
                        <?php $lien_he =  App\Item::where('key_layout','Liên hệ')->get();?>
                        <div class="col-md-12 col-sm-12 col-xs-12 copyright text-left t-cop xs-text-center xs-margin-bottom-one">
                            <span class="footer-hidden">&copy; Copyright 2016 by <?php echo e(url('')); ?>. All right reserved.</span> Hotline: <?php if(isset($lien_he[0])): ?> <?php echo e($lien_he[0]->value); ?> <?php endif; ?>

                        </div>
                        <!-- end copyright -->
                    </div>
                </div>
            </div>

            
<!--Popup thông báo gửi thành công-->
       <div id="modal-popup-guithanhcong-uudai" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
           <div style="">
               <h5>Gửi thành công</h5>
           </div>
           <div class="t-popup-padding-rp">
               <div class="row" style="margin:0px !important">
                   <div class="center-col">
                       <p style="margin:10px 0px 0px">Cảm ơn bạn đã để lại thông tin. Chúng tôi sẽ thông báo đến bạn khi có sản phẩm Ưu đãi
                       </p>
                   </div>
               </div>
           </div>
       </div>
       <div id="modal-popup-guithanhcong-uudai1" class="zoom-anim-dialog mfp-hide center-col bg-white modal-popup-main t-popup">
           <div style="">
               <h5>Không thành công</h5>
           </div>
           <div class="t-popup-padding-rp">
               <div class="row" style="margin:0px !important">
                   <div class="center-col">
                       <p style="margin:10px 0px 0px">Email không được để trống hoặc không đúng định dạng email
                       </p>
                   </div>
               </div>
           </div>
       </div>
       <!--Hết popup thông báo gửi thành công-->
        </footer>
        