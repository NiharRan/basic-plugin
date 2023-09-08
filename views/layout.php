<?php do_action( 'basic_plugin/before_admin_app' ); ?>
<div class="basic-plugin-top-header">
	<div>
		<img src="https://www.gravatar.com/avatar/eedc61a75aec6315291f11c96cfc036a?s=128&d=https%3A%2F%2Fui-avatars.com%2Fapi%2FNihar%2BHermann/128" alt="">
	</div>
	<h1><?php echo __( 'Basic Plugin', 'basic-plugin' ); ?></h1>
</div>
<header class="basic-plugin-header">
	<nav>
		<ul class="basic-plugin-menu">
			<?php foreach ( $menu_items as $item ) : ?>
			<li data-key="<?php echo esc_attr( $item['key'] ); ?>">
				<a href="<?php echo esc_url( $item['link'] ); ?>">
					<?php echo esc_attr( $item['label'] ); ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
</header>
<noscript>
	<p class="basic-plugin-alert basic-plugin-alert-danger">Please enable your browser's Javascript. If you don't enable Javascript from browser, please <a href="https://winbuzzer.com/2021/11/23/how-to-disable-or-enable-javascript-in-chrome-firefox-microsoft-edge-and-opera-xcxwbt/" target="_blank">click here</a> and follow the instructions</p>
</noscript>
<div id='basic_plugin'></div>
<?php do_action( 'basic_plugin/admin_app' ); ?>
