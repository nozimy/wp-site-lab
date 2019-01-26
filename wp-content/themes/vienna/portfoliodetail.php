
    
<div class="zl_prtfl_wrap"> <!-- Portfolio Wrapper -->
    <div class="portfoliohead">
        <div class="large-8 column noleftpad">
            <?php 
            /*echo '<pre><!--';
            print_r($galls);
            echo '--></pre>';*/
             ?>
            <h1 class="entry-title zl_portfloo_title"><?php echo $title; ?></h1>
        </div>
        <div class="large-4 column norightpad">
            <ul class="zl_port_nav">
                <!-- PREV -->
                <li><?php echo getPostLikeLink( $post->ID );?></li>
                <?php if($next): ?>
                <li class="zl_open_next tooltip" title="<?php echo zl_option('lang_port_prev', __('Previous Project', 'zatolab')); ?>"><a class="ajaxLink" href="<?php echo $nexturi; ?>" data-id="<?php echo $newerID; ?>"><div class="dashicons dashicons-arrow-left-alt2"></div></a></li>
                <?php else:?>
                    <li class="zl_open_next tooltip" title="<?php echo zl_option('lang_port_prev', __('Previous Project', 'zatolab')); ?>"><div class="dashicons dashicons-arrow-left-alt2"></div>
                    </li>
                <?php endif;?>
                
                <!-- NEXT -->
                <?php if($prev): ?>
                    <li class="zl_open_prev tooltip" title="<?php echo zl_option('lang_port_next', __('Next Project', 'zatolab')); ?>"><a class="ajaxLink" href="<?php echo $prevuri; ?>" data-id="<?php echo $prevID; ?>"><div class="dashicons dashicons-arrow-right-alt2"></div></a></li>
                <?php else:?>
                    <li class="zl_open_prev tooltip" title="<?php echo zl_option('lang_port_next', __('Next Project', 'zatolab')); ?>"><div class="dashicons dashicons-arrow-right-alt2"></div></li>
                <?php endif;?>

                <li class="zl_close_port tooltip" title="<?php echo zl_option('lang_close', __('Close', 'zatolab')); ?>"><div class="dashicons dashicons-no-alt"></div></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>

    <!-- ooooooooooooooooooooooooooooooooooooooooo
        IMAGE and MEDIA
    ooooooooooooooooooooooooooooooooooooooooooo -->
    <div class="<?php echo $mediawrap; ?> column ">
        <div class="zl_portimg">
            <?php 
            if( 1 == vp_metabox('portfolio.additional',  $postID) ) { ?>
                <?php 
                $islider = null;
                if (count($galls) === 1){
                    $islider = '';
                } else {
                    $islider = 'portfolioslide owl-carousel';
                }
                ?>
                <div class="<?php echo $islider; ?>">
                    <?php 
                        foreach($galls as $gall){  ?>
                            <?php 
                            $media = $gall['media_file'];
                            $type = wp_check_filetype($media);

                            if( strstr($type['type'], "video/") ){
                                echo "<div>";
                                echo do_shortcode('[video src="'.$media.'" ]');
                                echo "</div>";
                            } else if (strstr($type['type'], "image/")) {
                                echo "<div>";
                                $thumb = zl_theme_thumb($media, 960, null, 't', false);
                                echo '<img src="'.$media.'"/>';
                                echo "</div>";
                            } else if(strpos($media, 'vimeo') > 0 or strpos($media, 'youtube') > 0) {
                                echo "<div>";
                                echo wp_oembed_get( $media ); 
                                echo "</div>";
                            }
                            ?>
                    <?php } //End foreach $galls?>
                </div>

            <?php } else { 
                $thumb = zl_theme_thumb($img_url, 960, null, 't', false);
                ?>
                 <img src="<?php echo $thumb; ?>"/>
            <?php } // End if; ?>
            <div class="clear"></div>
        </div>
        <!-- END IMage and Media -->
    </div>

    <!-- ooooooooooooooooooooooooooooooooooooooooooo
    Portfolio Description
    oooooooooooooooooooooooooooooooooooooooooooo -->
    <div class="<?php echo $descwrap; ?> column ">
        <div class="zl_port_descxxx">  
           <!--  <p class="text-right"><a class="zl_closeportodesc">X</a></p> -->
            <?php if($shortdesc){ ?>
                <div class="<?php echo $zl_projectdesc; ?>">
                    <div class="zl_projectdesc">
                        <?php echo wpautop($shortdesc); ?>
                    </div>
                </div>
            <?php } ?>
           <div class="<?php echo $projectdetail; ?>">
                <ul class="zl_projectinfo">
                    <h4><?php echo zl_option('lang_projectinfo', __('Project Info', 'zatolab')); ?></h4>
                    <?php if($client){ ?>
                    <li><div class="dashicons dashicons-businessman"></div> <?php echo $client; ?></li>
                    <?php } ?>
                    <?php if($projectdate){ ?>
                    <li><div class="dashicons dashicons-calendar"></div> <?php echo $projectdate; ?></li>
                    <?php } ?>
                    <?php if($skills){ ?>
                    <li><div class="dashicons dashicons-performance"></div> <?php echo $skills; ?></li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
                <a href="<?php echo $currenturl; ?>" class="zl_post_readmore"><?php echo zl_option('lang_portlink', __('Launch Project', 'zatolab')) ?></a>
           </div>
        </div>
        <div class="clear"></div>
        
    </div> <!-- End large-4 -->
    <div class="clear"></div>
    
</div><!-- // End .Portfolio Wrapper -->
<div class="clear"></div>