		</div>

	</div>	

	<footer id="footer">
	    <div class="container">
	        <aside class="row clearfix">
	            
	            <section class="column grid_3">
	                <h3>Members Links</h3>
	                <?php sceletus_members_links(); ?>                       
	            </section>
	            <section class="column grid_3">
	                <h3>Guest Links</h3>
	                <?php sceletus_guest_links(); ?>                      
	            </section>
	            <section class="column grid_3">
	                <h3>Be Social</h3>
	                <ul>
	                    <li><a href="<?php echo of_get_option('facebook_url', '' ); ?>" title="Join Us On Facebook">Facebook</a></li>
	                    <li><a href="<?php echo of_get_option('twitter_url', '' ); ?>" title="Join Us On Twitter">Twitter</a></li>
	                </ul>
	                <h3 class="last">Website Users</h3>
	                <ul>
	                    <li><a title="Log In" href="<?php echo get_option('home'); ?>/wp-login.php?redirect_to=http%3A%2F%2Fwww.folkestone-optimists.co.uk">Log In</a></li>
	                    <li><a title="Forgot Password" href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Forgot Username?</a></li>
	                </ul>
	            </section>
	            <section class="column grid_3">
	                <h3>Our Address</h3>
	                <p>3 Hills Sports Park<br>
	                Cheriton Road<br>
	                Folkestone<br>
	                CT19 5JU <br>
	                <a href="">View Map</a></p>
	                Email: <a href="mailto:enquiriesFOHC@outlook.com?subject=Website Contact">enquiriesFOHC@outlook.com</a> 
	            </section>
	                                
	        </aside>
	        
	        <span class="pull-right">Designed &amp; Coded by <a target="_blank" href="http://parsonsprojects.co.uk/">Parsons Projects</a> Using The Powerful <a target="_blank" href="http://wordpress.org/">Wordpress</a></span> &copy; <a title="<?php echo bloginfo('name'); ?>" href="<?php echo get_option('home'); ?>"><?php echo bloginfo('name'); ?></a> 2013                    
	    </div>
	</footer>

	<div class="modal-overlay"></div>

	<div class="modal-box" id="club-newsletter">
	    <div class="modal-header">
	        Club Newsletter
	        <span data-dismiss="modal" class="close">X</span>
	    </div>
	    <div class="modal-body">
	        <p>Body</p>
	    </div>
	    <div class="modal-footer">
	    </div>
	</div>

	<div class="modal-box" id="get-directions">
	    <div class="modal-header">
	        Get Directions
	        <span data-dismiss="modal" class="close">X</span>
	    </div>
	    <div class="modal-body">
	        <form action="http://maps.google.co.uk/maps" method="get" target="_blank">
				<p><label for="saddr">Enter your location</label></p>
			    <p><input type="text" name="saddr" /></p>
			    <input type="hidden" name="daddr" value="CT19 5JU" />
			    <p><input type="submit" class="btn btn-green" value="Get directions" /></p>
	        </form>
	    </div>
	    <div class="modal-footer">
	    </div>
	</div>
	<?php wp_footer(); ?>
  </body>
</html>