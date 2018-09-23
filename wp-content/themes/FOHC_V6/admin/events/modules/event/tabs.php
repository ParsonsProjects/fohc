
<div id="event-tabs" class="tabs">

    <ul class="tabs-nav clearfix">
    <?php $i = 0; foreach ($args as $key => $option) {
    $active = ($i == '0') ? 'active' : '';
    echo '<li class="' . $active . '"><a href="#tab-' . $i . '">' . $option['tab_name'] . '</a></li>';
    $i++; } ?>
    </ul>

    <?php $i = 0; foreach ($args as $key => $option) {
    $active = ($i == '0') ? ' active' : '';
    echo '<div class="tabs-pane' . $active . '" id="tab-' . $i .'">';
        include_once($option['tab_content']);
    echo '</div>';
    $i++; } ?>

</div>
