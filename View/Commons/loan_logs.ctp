<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
       
        <h3><span class="semi-bold">Loan Logs</span></h3>
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple">
                <div class="grid-body">			
                <div class="row" style="background-color: #e5e9ec;">
                <ul class="cbp_tmtimeline">
                <?php
                if(!empty($logs)) {
                    foreach($logs as $log) { 
                        $logAction = $log['LoanLog']['action'];?>
                        <li>
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                                <span class="logDate"><?php echo _dateFormatFront($log['LoanLog']['created']); ?></span>
                                <span class="logTime"><?php echo _timeFormatFront($log['LoanLog']['created']); ?>
                                    <span class="semi-bold"><?php echo _ampmFormatFront($log['LoanLog']['created']); ?></span>
                                </span>
                            </time>
                        <div class="cbp_tmicon primary animated bounceIn">
                            <?php 
                                if(!empty($logIcons[$logAction])) {
                                    echo $logIcons[$logAction];
                                }
                            ?>
                        </div>
                        <div class="cbp_tmlabel">
                            <div class="p-t-10 p-l-30 p-r-20 p-b-20 xs-p-r-10 xs-p-l-10 xs-p-t-5">
                                <h4 class="inline m-b-5">
                                    <span class="text-success semi-bold">
                                        <?php echo !empty($loanPhases[$log['LoanLog']['action']]) ? $loanPhases[$log['LoanLog']['action']] : ''; ?>
                                    </span>
                                </h4>
                                <p class="m-t-5 dark-text">
                                    <?php echo $log['LoanLog']['description'];?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="tiles p-t-9 p-b-10 p-l-20">
                                <ul class="action-links">
                                    <li>
                                    <?php
                                        $userArr = $this->Common->getUserDetail($log['LoanLog']['user_id']);
                                        echo '<strong>';
                                        echo isset($userArr['User']['user_type'])?$userTypes[$userArr['User']['user_type']]:'';
                                        echo '</strong> : ';
                                        echo !empty($userArr)?$userArr['User']['first_name'].' '.$userArr['User']['last_name']:'';
                                    ?>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </li>
                <?php
                    }
                }
            ?>
                </ul>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>