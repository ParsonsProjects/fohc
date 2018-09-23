                <?php

                    $om1 = (of_get_option('game_opp_mens_1s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_1s', '' );
                    $tm1 = of_get_option('game_time_mens_1s', '' );
                    $pm1 = of_get_option('game_pitch_mens_1s', '');
                    $om2 = (of_get_option('game_opp_mens_2s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_2s', '' );
                    $tm2 = of_get_option('game_time_mens_2s', '' );
                    $pm2 = of_get_option('game_pitch_mens_2s', '');
                    $om3 = (of_get_option('game_opp_mens_3s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_3s', '' );
                    $tm3 = of_get_option('game_time_mens_3s', '' );
                    $pm3 = of_get_option('game_pitch_mens_3s', '');
                    $om4 = (of_get_option('game_opp_mens_4s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_4s', '' );
                    $tm4 = of_get_option('game_time_mens_4s', '' );
                    $pm4 = of_get_option('game_pitch_mens_4s', '');
                    $om5 = (of_get_option('game_opp_mens_5s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_5s', '' );
                    $tm5 = of_get_option('game_time_mens_5s', '' );
                    $pm5 = of_get_option('game_pitch_mens_5s', '');
                    $om6 = (of_get_option('game_opp_mens_6s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_6s', '' );
                    $tm6 = of_get_option('game_time_mens_6s', '' );
                    $pm6 = of_get_option('game_pitch_mens_6s', '');
                    $om7 = (of_get_option('game_opp_mens_7s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_7s', '' );
                    $tm7 = of_get_option('game_time_mens_7s', '' );
                    $pm7 = of_get_option('game_pitch_mens_7s', '');
					$om8 = (of_get_option('game_opp_mens_8s', '' ) == '') ? 'No Game' : of_get_option('game_opp_mens_8s', '' );
                    $tm8 = of_get_option('game_time_mens_8s', '' );
                    $pm8 = of_get_option('game_pitch_mens_8s', '');
                    $ol1 = (of_get_option('game_opp_ladies_1s', '' ) == '') ? 'No Game' : of_get_option('game_opp_ladies_1s', '' );
                    $tl1 = of_get_option('game_time_ladies_1s', '' );
                    $pl1 = of_get_option('game_pitch_ladies_1s', '');
                    $ol2 = (of_get_option('game_opp_ladies_2s', '' ) == '') ? 'No Game' : of_get_option('game_opp_ladies_2s', '' );
                    $tl2 = of_get_option('game_time_ladies_2s', '' );
                    $pl2 = of_get_option('game_pitch_ladies_2s', '');
                    $ol3 = (of_get_option('game_opp_ladies_3s', '' ) == '') ? 'No Game' : of_get_option('game_opp_ladies_3s', '' );
                    $tl3 = of_get_option('game_time_ladies_3s', '' );
                    $pl3 = of_get_option('game_pitch_ladies_3s', '');
                    $ol4 = (of_get_option('game_opp_ladies_4s', '' ) == '') ? 'No Game' : of_get_option('game_opp_ladies_4s', '' );
                    $tl4 = of_get_option('game_time_ladies_4s', '' );
                    $pl4 = of_get_option('game_pitch_ladies_4s', '');

                ?>

                                <div class="tabs-pane" id="tab02">
                                    <div class="teams">
                                        <span class="close">View All Teams</span>
                                        <ul class="clearfix">
                                            <li class="team<?php if($pm1 == 'away') { echo ' red'; } elseif ($pm1 != 'no_game' && $pm1 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">1<span>st</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om1; ?>
                                                        </div>
                                                        <?php if($pm1 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm1 ) ); ?> @ <?php echo $tm1; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pm2 == 'away') { echo ' red'; } elseif ($pm2 != 'no_game' && $pm2 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">2<span>nd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om2; ?>
                                                        </div>
                                                        <?php if($pm2 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm2 ) ); ?> @ <?php echo $tm2; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pm3 == 'away') { echo ' red'; } elseif ($pm3 != 'no_game' && $pm3 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">3<span>rd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om3; ?>
                                                        </div>
                                                        <?php if($pm3 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm3 ) ); ?> @ <?php echo $tm3; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pm4 == 'away') { echo ' red'; } elseif ($pm4 != 'no_game' && $pm4 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">4<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om4; ?>
                                                        </div>
                                                        <?php if($pm4 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm4 ) ); ?> @ <?php echo $tm4; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pm5 == 'away') { echo ' red'; } elseif ($pm5 != 'no_game' && $pm5 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">5<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om5; ?>
                                                        </div>
                                                        <?php if($pm5 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm5 ) ); ?> @ <?php echo $tm5; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pm6 == 'away') { echo ' red'; } elseif ($pm6 != 'no_game' && $pm6 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">6<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om6; ?>
                                                        </div>
                                                        <?php if($pm6 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm6 ) ); ?> @ <?php echo $tm6; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pm7 == 'away') { echo ' red'; } else if($pm7 != 'no_game' && $pm7 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">7<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om7; ?>
                                                        </div>
                                                        <?php if($pm7 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm7 ) ); ?> @ <?php echo $tm7; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
											<li class="team<?php if($pm8 == 'away') { echo ' red'; } else if($pm8 != 'no_game' && $pm8 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Mens</span>
                                                    <span class="name">8<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $om8; ?>
                                                        </div>
                                                        <?php if($pm8 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pm8 ) ); ?> @ <?php echo $tm8; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pl1 == 'away') { echo ' red'; } else if($pl1 != 'no_game' && $pl1 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">1<span>st</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol1; ?>
                                                        </div>
                                                        <?php if($pl1 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pl1 ) ); ?> @ <?php echo $tl1; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pl2 == 'away') { echo ' red'; } else if($pl2 != 'no_game' && $pl2 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">2<span>nd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol2; ?>
                                                        </div>
                                                        <?php if($pl2 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pl2 ) ); ?> @ <?php echo $tl2; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pl3 == 'away') { echo ' red'; } else if($pl3 != 'no_game' && $pl3 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">3<span>rd</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol3; ?>
                                                        </div>
                                                        <?php if($pl3 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pl3 ) ); ?> @ <?php echo $tl3; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if($pl4 == 'away') { echo ' red'; } else if($pl4 != 'no_game' && $pl4 != 'away') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Ladies</span>
                                                    <span class="name">4<span>th</span></span>
                                                    <div class="details">
                                                        <div class="against">
                                                            <?php echo $ol4; ?>
                                                        </div>
                                                        <?php if($pl4 != 'no_game') { ?>
                                                        <div class="pitch">
                                                            <?php echo ucwords( str_replace('_', ' ', $pl4 ) ); ?> @ <?php echo $tl4; ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="team<?php if(of_get_option('games_sunday', '') != '') { echo ' green'; } ?>">
                                                <div class="team-inset">
                                                    <span class="head">Sunday</span>
                                                    <span class="name">All</span>
                                                    <div class="details">
                                                        <?php echo of_get_option('games_sunday', 'No Games') ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="key">
                                            <span class="head">click a team for more info</span>
                                            <div class="red">
                                                <span></span>away
                                            </div>
                                            <div class="green">
                                                <span></span>home
                                            </div>
                                            <div class="default">
                                                <span></span>no match
                                            </div>
                                        </div>
                                    </div>
                                </div>