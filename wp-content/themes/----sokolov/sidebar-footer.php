<?php
/**
* The template for displaying the footer widgets
*
* @package juliet
*/
?>
<?php $juliet_example_content = juliet_get_option('juliet_example_content');  ?>
<?php 
if ( is_active_sidebar( 'footer-row-1-col-1' ) || is_active_sidebar( 'footer-row-1-col-2' ) 
        || is_active_sidebar( 'footer-row-1-col-3' ) || is_active_sidebar( 'footer-row-1-col-4' ) ) { 

    $active_sidebar = 0;
    if ( is_active_sidebar( 'footer-row-1-col-1' ) ) $active_sidebar++;
    if ( is_active_sidebar( 'footer-row-1-col-2' ) ) $active_sidebar++; 
    if ( is_active_sidebar( 'footer-row-1-col-3' ) ) $active_sidebar++; 
    if ( is_active_sidebar( 'footer-row-1-col-4' ) ) $active_sidebar++;  
    $class = juliet_get_bootstrap_class($active_sidebar); $class = esc_attr($class);
    if($active_sidebar > 0) { ?>

    <!-- Footer Row 1 -->
    <div class="sidebar-footer footer-row-1">
        <div class="row">
            <?php if(is_active_sidebar( 'footer-row-1-col-1' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-1'); ?></div><?php } ?>
            <?php if(is_active_sidebar( 'footer-row-1-col-2' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-2'); ?></div><?php } ?>
            <?php if(is_active_sidebar( 'footer-row-1-col-3' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-3'); ?></div><?php } ?>
            <?php if(is_active_sidebar( 'footer-row-1-col-4' )) { ?><div class="<?php echo $class ?>"><?php dynamic_sidebar('footer-row-1-col-4'); ?></div><?php } ?>
        </div>
    </div>
    <!-- /Footer Row 1 -->

<?php } 
} else if($juliet_example_content == 1) { juliet_example_footer_widgets(); } ?>

<!-- Footer Row 2 --->
<hr>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter51182900 = new Ya.Metrika2({
                    id:51182900,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51182900" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- /Footer Row 2 -->