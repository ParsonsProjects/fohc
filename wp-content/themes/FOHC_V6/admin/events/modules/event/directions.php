<div class="event-directions clearfix">
    <div class="event-label">Directions:</div>
    <div class="event-value">
	    <a id="get-directions" href="" title="Get Directions">Get Directions</a>
	    <div style="display:none;">
	        <form action="http://maps.google.com/maps" method="get" target="_blank">
	           <!-- <label for="saddr">Enter your location</label> -->
	           <input type="text" name="saddr" value="Enter your location" />
	           <p><input type="hidden" name="daddr" value="<?php echo $event_location; ?>" /></p>
	           <input type="submit" class="btn btn-success" value="Get directions" />
	        </form>
	    </div>
	</div>
</div>