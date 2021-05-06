<?php
/* Plugin Name: Ускоритель сайта
 * Plugin URI:
 * Author: Апарин Александр
 * Author URI: https://efeto.ru
 * Description: Контакты. Email: engineer.aparin@gmail.com, Telegram: https://t.me/aaaparin
 * Version: 1.0.8 (stable)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require('messages.php');
require('settings.php');
require('variables.php');
//require('printer.php');
//require('make_node.php');
 
function options() {
	global $plagin_page, $site_name;
	add_menu_page( $site_name, $site_name, 'manage_options', $plagin_page, 'site_accelerator_page');  
}
add_action('admin_menu', 'options');


function site_accelerator_page(){
	?><div class="wrap">
		<h1><?php global $site_name; echo $site_name ?></h1>
		<p style="color: green; padding: 10px; background-color: white;"><b>Developer contacts.</b> Email: engineer.aparin@gmail.com, Telegram: https://t.me/aaaparin</p>
		<h2><?php echo('Введите ключ плагина:')?></h2>
            <form method="post" enctype="multipart/form-data" action="options.php">
                  <?php wp_nonce_field('update-options'); ?>
                  <input type="hidden" name="action" value="update" />
                  <input type="hidden" name="page_options" value="site_acceleration_key" />
                  <p>	
                        <input style="width:250px;" type="text" name="site_acceleration_key" value="<?php echo get_option('site_acceleration_key'); ?>" >
                  </p>
                  <?php 
                  global $correct_key_message, $wrong_key_message;
                  echo(get_option('site_acceleration_key') === md5($_SERVER['SERVER_NAME']) ? $correct_key_message : $wrong_key_message);
                  ?>     
            <?php submit_button(); ?>
            </form>
	</div><?php
}

if (get_option('site_acceleration_key') !== md5($_SERVER['SERVER_NAME'])) return;

function wp_site_accelerator() {
      ?>

      <!----------  smart  loading  ---------->
            <script>
            
            function smart_loading() {
                  /*
                  const make_node = (url, id) => {
								const node = document.createElement('script');
								node.src = url + id;
								node.async = true;
								document.querySelector('body').appendChild(node);
							};
			make_node('wp-content/plugins/wp-client-site-accelerator/test.js');
                  */
                  /* Global site tag (gtag.js) - Google Analytics */
                        const analitics = document.createElement('script');
                        analitics.src = 'https://www.googletagmanager.com/gtag/js?id=<?php global $analitics; echo $analitics; ?>';
                        analitics.async = true;
                        document.querySelector('body').appendChild(analitics);

                        window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag('js', new Date());

                        gtag('config', '<?php echo $analitics; ?>');
                  /* End Global site tag (gtag.js) - Google Analytics */
                  /* Yandex.Metrika counter */
                        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                        ym("<?php global $metrica; echo $metrica; ?>", "init", {
                              clickmap:true,
                              trackLinks:true,
                              accurateTrackBounce:true
                        });
                  /* End Yandex.Metrika counter */          
                  /* Google Adsense */
                        const adsense = document.createElement('script');
                        adsense.src = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
                        adsense.async = true;
                        adsense.setAttribute('data-ad-client', '<?php global $adsense; echo $adsense; ?>');
                        document.querySelector('body').appendChild(adsense);
                  /* End Google Adsense */
                  /* Jivosite */
                  const jivosite = document.createElement('script');
                              jivosite.src = '//code-ya.jivosite.com/widget/<?php global $jivosite; echo $jivosite; ?>';
                              jivosite.async = true;
                              document.querySelector('body').appendChild(jivosite);     
                  /* End Jivosite */                    
                  events.forEach(event => {
                        document.removeEventListener(event, smart_loading);          
                  });

            }
            const events = ['scroll', 'click', 'mousemove', 'touchstart'];
            events.forEach(event => {
                        document.addEventListener(event, smart_loading);          
                  });

            </script>
            <noscript><div><img src="https://mc.yandex.ru/watch/<?php global $metrica; echo $metrica; ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
      <!--------- End smart loading ---------->

      <!---------- lazy loading ----------->
            <script>
            function lazy_loading() {

            }
            </script>
      <!--------- /lazy loading ----------->
<?php      
}
add_action('wp_body_open', 'wp_site_accelerator');