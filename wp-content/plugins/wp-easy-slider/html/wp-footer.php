<?php
/*
Plugin Name: WP-Easy Slider
Author: Jordi Salord Font <jordi@graficlab.com>
License: GPL version v2.0
*/
if (!constant('WES_URL'))
      die("You can't access this file directly");
?><script type="text/javascript">
      /* <![CDATA[ */
      jQuery('div.gallery').easyslider({
            style:'fadein',
            showloading:true,
            replacegallery:false,
            gallerystyle:'default'
      });
      /* ]]> */
</script>