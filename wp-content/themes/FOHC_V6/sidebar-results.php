			<?php    
                    $om1 = (of_get_option('opposition_mens_1s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_1s', '' );
                    $sm1 = of_get_option('score_mens_1s', '' );
                    $sm1o = of_get_option('score_mens_1s_opposition', '' );
                    $om2 = (of_get_option('opposition_mens_2s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_2s', '' );
                    $sm2 = of_get_option('score_mens_2s', '' );
                    $sm2o = of_get_option('score_mens_2s_opposition', '' );
                    $om3 = (of_get_option('opposition_mens_3s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_3s', '' );
                    $sm3 = of_get_option('score_mens_3s', '' );
                    $sm3o = of_get_option('score_mens_3s_opposition', '' );
                    $om4 = (of_get_option('opposition_mens_4s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_4s', '' );
                    $sm4 = of_get_option('score_mens_4s', '' );
                    $sm4o = of_get_option('score_mens_4s_opposition', '' );
                    $om5 = (of_get_option('opposition_mens_5s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_5s', '' );
                    $sm5 = of_get_option('score_mens_5s', '' );
                    $sm5o = of_get_option('score_mens_5s_opposition', '' );
                    $om6 = (of_get_option('opposition_mens_6s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_6s', '' );
                    $sm6 = of_get_option('score_mens_6s', '' );
                    $sm6o = of_get_option('score_mens_6s_opposition', '' );
                    $om7 = (of_get_option('opposition_mens_7s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_7s', '' );
                    $sm7 = of_get_option('score_mens_7s', '' );
                    $sm7o = of_get_option('score_mens_7s_opposition', '' );
					$om8 = (of_get_option('opposition_mens_8s', '' ) == '') ? 'No Game' : of_get_option('opposition_mens_8s', '' );
                    $sm8 = of_get_option('score_mens_8s', '' );
                    $sm8o = of_get_option('score_mens_8s_opposition', '' );
                    $ol1 = (of_get_option('opposition_ladies_1s', '' ) == '') ? 'No Game' : of_get_option('opposition_ladies_1s', '' );
                    $sl1 = of_get_option('score_ladies_1s', '' );
                    $sl1o = of_get_option('score_ladies_1s_opposition', '' );
                    $ol2 = (of_get_option('opposition_ladies_2s', '' ) == '') ? 'No Game' : of_get_option('opposition_ladies_2s', '' );
                    $sl2 = of_get_option('score_ladies_2s', '' );
                    $sl2o = of_get_option('score_ladies_2s_opposition', '' );
                    $ol3 = (of_get_option('opposition_ladies_3s', '' ) == '') ? 'No Game' : of_get_option('opposition_ladies_3s', '' );
                    $sl3 = of_get_option('score_ladies_3s', '' );
                    $sl3o = of_get_option('score_ladies_3s_opposition', '' );
                    $ol4 = (of_get_option('opposition_ladies_4s', '' ) == '') ? 'No Game' : of_get_option('opposition_ladies_4s', '' );
                    $sl4 = of_get_option('score_ladies_4s', '' );
                    $sl4o = of_get_option('score_ladies_4s_opposition', '' );
            ?>

                                <div class="tabs-pane active" id="weekend-results">
                                    <div class="teams">
                                        <span class="close">View All Teams</span>
                                        <ul class="clearfix">
                                            <li class="team<?php if($sm1 > $sm1o) { echo ' green'; } else if($sm1 < $sm1o) { echo ' red'; } else if($sm1 == $sm1o && $sm1 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">1<span>st</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om1; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm1; ?> - <?php echo $sm1o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sm2 > $sm2o) { echo ' green'; } else if($sm2 < $sm2o) { echo ' red'; } else if($sm2 == $sm2o && $sm2 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">2<span>nd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om2; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm2; ?> - <?php echo $sm2o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sm3 > $sm3o) { echo ' green'; } else if($sm3 < $sm3o) { echo ' red'; } else if($sm3 == $sm3o && $sm3 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">3<span>rd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om3; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm3; ?> - <?php echo $sm3o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sm4 > $sm4o) { echo ' green'; } else if($sm4 < $sm4o) { echo ' red'; } else if($sm4 == $sm4o && $sm4 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">4<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om4; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm4; ?> - <?php echo $sm4o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sm5 > $sm5o) { echo ' green'; } else if($sm5 < $sm5o) { echo ' red'; } else if($sm5 == $sm5o && $sm5 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">5<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om5; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm5; ?> - <?php echo $sm5o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sm6 > $sm6o) { echo ' green'; } else if($sm6 < $sm6o) { echo ' red'; } else if($sm6 == $sm6o && $sm6 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">6<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om6; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm6; ?> - <?php echo $sm6o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sm7 > $sm7o) { echo ' green'; } else if($sm7 < $sm7o) { echo ' red'; } else if($sm7 == $sm7o && $sm7 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">7<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om7; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm7; ?> - <?php echo $sm7o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
											<li class="team<?php if($sm8 > $sm8o) { echo ' green'; } else if($sm8 < $sm8o) { echo ' red'; } else if($sm8 == $sm8o && $sm8 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">8<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om8; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sm8; ?> - <?php echo $sm8o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sl1 > $sl1o) { echo ' green'; } else if($sl1 < $sl1o) { echo ' red'; } else if($sl1 == $sl1o && $sl1 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">1<span>st</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol1; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sl1; ?> - <?php echo $sl1o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sl2 > $sl2o) { echo ' green'; } else if($sl2 < $sl2o) { echo ' red'; } else if($sl2 == $sl2o && $sl2 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">2<span>nd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol2; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sl2; ?> - <?php echo $sl2o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sl3 > $sl3o) { echo ' green'; } else if($sl3 < $sl3o) { echo ' red'; } else if($sl3 == $sl3o && $sl3 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">3<span>rd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol3; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sl3; ?> - <?php echo $sl3o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($sl4 > $sl4o) { echo ' green'; } else if($sl4 < $sl4o) { echo ' red'; } else if($sl4 == $sl4o && $sl4 != '') { echo ' blue'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">4<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol4; ?>
                                                        </div>
                                                        <div class="score">
                                                            <?php echo $sl4; ?> - <?php echo $sl4o; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if(of_get_option('results_sunday', '') != '') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Sunday</span>
                                                    <span class="name">All</span>
                                                    <div class="details">
                                                        <?php echo of_get_option('results_sunday', 'No Games') ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="key">
                                            <span class="head">click a team for more info</span>
                                            <div class="green">
                                                <span></span>win
                                            </div>
                                            <div class="red">
                                                <span></span>loss
                                            </div>
                                            <div class="blue">
                                                <span></span>draw
                                            </div>
                                            <div class="default">
                                                <span></span>no match
                                            </div>
                                        </div>
                                    </div>
                                </div>
