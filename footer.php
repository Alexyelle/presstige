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
					<?php 
						if ($options['presstige_copy'] != "")
							echo "<p class='small'>".stripslashes($options['presstige_copy'])."</p>";			
				 
					?>	
				</small>
			</div>
	</footer>
</div>

<?php wp_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function($) { 
		jQuery(window).konami(function(){ $("#main").addClass('red'); }); // Replace to put your own changes!
	});
</script>

<!-- A supprimer si déploiement recherche non utilisé -->
<script src="<?php echo get_template_directory_uri(); ?>/js/classie.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/uisearch.js"></script>
<script>
new UISearch( document.getElementById( 'sb-search' ) );
</script>
<!-- END déploiement recherche  -->

</body>
</html>