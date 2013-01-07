<?php
  global $options;
?>


	</div><!-- #main  -->

	<footer role="contentinfo">
			<div class="widget-area">
			<?php if ( is_active_sidebar( 'footer-widget-area' ) ){
				dynamic_sidebar( 'footer-widget-area' );					
			}?>
			</div>
		
			<div class="copyright">
				<small>
					&copy; Copyright <?php echo date('Y') . " " . esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'presstige' ); ?>"   ><?php printf( __( 'Proudly powered by %s.', 'presstige' ), 'WordPress' ); ?></a>
					<?php 
						if ($options['presstige_copy'] != "")
							echo "<p class='small'>".$options['presstige_copy']."</p>";			
				 
					?>	
				</small>
			</div>
	</footer>
</div>

<?php wp_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function($) { 
		jQuery(window).konami(function(){ $("#container").addClass('red'); }); // Replace to put your own changes!
	});
	</script>

</body>
</html>