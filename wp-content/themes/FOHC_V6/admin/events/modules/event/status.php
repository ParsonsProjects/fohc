<div class="status">
<?php 
    switch ($post_meta_status) {
        case 'accepted':
        echo esc_html('You are attending');
        break;

        case 'declined':
        echo esc_html('You have declined');
        break;

        default:
        echo esc_html('No Response');
        break;
    }
?>
</div>