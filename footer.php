<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores.me
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="automattic-credit">
			An <a href="http://automattic.com/" id="automattic-credit-logo">Automattic</a> 
			<?php
				$words = array( 'Production', 'Joint', 'Medley', 'Experiment', 'Ruckus', 'Invention', 'Creation', 'Thingamajig', 'Opus', 'Brainchild', 'Contraption' );
				echo $words[ wp_rand( 0, count( $words ) - 1 ) ];
			?>
		</div><!-- .automattic-credit -->
		<span class="sep"> | </span>
		<div class="site-info">
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'underscoresme' ); ?>" rel="generator">
				<?php
					/* translators: %s: WordPress. */
					printf( __( 'Proudly powered by %s', 'underscoresme' ), 'WordPress' );
				?>
			</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
