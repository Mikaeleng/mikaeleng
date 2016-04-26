	<div id="mobile-menu"></div>
	<footer class="footer tvelvecol first clearfix" role="contentinfo">
		<div id="inner-footer" class="clearfix">
			<div class="footer-item">
				<h2>LIVE</h2>
				<?php echo bones_popular_category_posts(array('cat' =>33 , 'count'=>5)); ?>
			</div>
			<div class="footer-item">
				<h2>WORK</h2>
				<?php echo bones_popular_category_posts(array('cat' =>34 , 'count'=>5)); ?>
			</div>
			<div class="footer-item">
				<h2>CREATE</h2>
				<?php echo bones_popular_category_posts(array('cat' =>35 , 'count'=>5)); ?>
			</div>
			<div class="footer-item">
				<h2>LINKS</h2>
				<ul>
					<?php echo get_site_bookmarks(); ?>
				</ul>
			</div>
	</div>
		<!-- ends footer link list div -->
		<div id="footer-bottom" >
			<div id="inner-footer-bottom" class="tencol">
				<h2>FOLLOW</h2>
				<a href="https://pinterest.com/MikaelEng"><span class="Avantgarde-pinterest"></span></a>
				<a href="https://www.facebook.com/mikael.eng"><span class="Avantgarde-facebook"></span></a>
				<a href="https://twitter.com/MikaelEng"><span class="Avantgarde-twitter"></span></a>
			</div>
		</div>
		<!-- ends footer bottom -->
	</footer> <?php // end footer ?>

</div> <?php // end #container ?>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
<a id="menu-button" href="#menu-button">Toggle menu</a>
	</body>

</html> <?php // end page. what a ride! ?>
