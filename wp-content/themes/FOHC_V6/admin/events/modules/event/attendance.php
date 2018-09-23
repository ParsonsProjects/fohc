<div id="event-attendance" class="clearfix">
                            
    <div style="width:<?php percent($no_accepted, $total_count); ?>%;" class="accepted-count alert alert-success tooltip">
        <span class="heading">Accepted: </span>
        <span class="count">
            <span class="tooltip-content"><span class="no"><?php echo $no_accepted ?></span> out of <?php echo $total_count ?> have accepted.</span> 
            <span class="percent"><?php if($no_accepted != '0') { ?><?php echo $no_accepted ?> (<?php percent($no_accepted, $total_count); ?>%)<?php } ?></span>
        </span>
    </div>
    <div style="width:<?php percent($inactive_count, $total_count); ?>%;" class="inactive-count alert alert-info tooltip">
        <span class="heading">No Response: </span>
        <span class="count">
            <span class="tooltip-content"><span class="no"><?php echo $inactive_count ?></span> out of <?php echo $total_count ?> have not responded.</span> 
            <span class="percent"><?php echo $inactive_count ?> (<?php percent($inactive_count, $total_count); ?>%)</span>
        </span>
    </div>
    <div style="width:<?php percent($no_declined, $total_count); ?>%;" class="declined-count alert alert-danger tooltip">
        <span class="heading">Declined: </span>
        <span class="count">
            <span class="tooltip-content"><span class="no"><?php echo $no_declined ?></span> out of <?php echo $total_count ?> have declined.</span>  
            <span class="percent"><?php if($no_declined != '0') { ?><?php echo $no_declined ?> (<?php percent($no_declined, $total_count); ?>%)<?php } ?></span>
        </span>
    </div>

</div>