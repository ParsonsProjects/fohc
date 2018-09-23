<div class="time-remaining clearfix">
    <div class="event-label">Time Remaining:</div>
    <div class="event-value">
        <span class="years">
            <?php if($years_remaining != '0') echo esc_html($years_remaining .' Years ');?>
        </span>
        <span class="months">
            <?php if($months_remaining != '0') echo esc_html($months_remaining. ' Months ');?>
        </span>
        <?php if($days_remaining == '1') { ?>
        <span class="days">
            <?php echo esc_html($days_remaining .' day from now ');?>
        </span>
        <?php } ?>
        <?php if($days_remaining > '1') { ?>
        <span class="days">
            <?php echo esc_html($days_remaining .' days from now ');?>
        </span>
        <?php } ?>
        <?php if($days_remaining == '0') { ?>
        <div class="clock">
            <span class="minutes"><?php echo esc_html($minutes_remaining);?> minute(s)</span>
            <span class="divider">:</span>
            <span class="seconds"><?php echo esc_html($seconds_remaining);?> seconds</span>
        </div>
        <?php } ?>
    </div>
</div>