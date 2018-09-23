
                                <div class="tabs-pane" id="tab03">
                                    <?php if (of_get_option('monday_training', '' ) != '') { ?>
                                    <div class="mon">
                                        <div class="heading">Mon</div>
                                        <div class="details">
                                            <?php echo of_get_option('monday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if (of_get_option('tuesday_training', '' ) != '') { ?>
                                    <div class="tue">
                                        <div class="heading">Tue</div>
                                        <div class="details">
                                            <?php echo of_get_option('tuesday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if (of_get_option('wednesday_training', '' ) != '') { ?>
                                    <div class="wed">
                                        <div class="heading">Wed</div>
                                        <div class="details">
                                            <?php echo of_get_option('wednesday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if (of_get_option('thursday_training', '' ) != '') { ?>
                                    <div class="thu">
                                        <div class="heading">Thu</div>
                                        <div class="details">
                                            <?php echo of_get_option('thursday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if (of_get_option('friday_training', '' ) != '') { ?>
                                    <div class="fri">
                                        <div class="heading">Fri</div>
                                        <div class="details">
                                            <?php echo of_get_option('friday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if (of_get_option('saturday_training', '' ) != '') { ?>
                                    <div class="sat">
                                        <div class="heading">Sat</div>
                                        <div class="details">
                                            <?php echo of_get_option('saturday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if (of_get_option('sunday_training', '' ) != '') { ?>
                                    <div class="sun">
                                        <div class="heading">Sun</div>
                                        <div class="details">
                                            <?php echo of_get_option('sunday_training', 'No Training' ); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
