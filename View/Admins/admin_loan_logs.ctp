<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Loan Logs</a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><span class="semi-bold">Loan Logs</span></h3>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
            <div class="grid-body">			
                <div class="row" style="background-color: #e5e9ec;">
                    <ul class="cbp_tmtimeline">
                    <?php
                    if(!empty($logs)) {
                      foreach($logs as $log) {
                    ?>
                    <li>
                      <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                        <span class="date"><?php echo _dateFormatFront($log['LoanLog']['created']); ?></span>
                        <span class="time"><?php echo _timeFormatFront($log['LoanLog']['created']); ?> <span class="semi-bold"><?php echo _ampmFormatFront($log['LoanLog']['created']); ?></span></span>
                      </time>
                      <div class="cbp_tmicon primary animated bounceIn"> <?php echo $log['LoanLog']['log_icon']; //<i class="fa fa-comments"></i> ?> </div>
                      <div class="cbp_tmlabel">
                        <div class="p-t-10 p-l-30 p-r-20 p-b-20 xs-p-r-10 xs-p-l-10 xs-p-t-5">
                          <h4 class="inline m-b-5">
                          <span class="text-success semi-bold">
                              <?php echo $log['LoanLog']['action']; ?>
                          </span>
                          </h4>
                          <!--<h5 class="inline muted semi-bold m-b-5">@johnsmith</h5>-->
                          <div class="muted"><!--Shared publicly - 12:45pm--></div>
                          <p class="m-t-5 dark-text">
                            <?php echo $log['LoanLog']['description']; //$this->Common->getNotificationDetail($log['LoanLog']['description']); ?>
                          </p>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="tiles grey p-t-9 p-b-10 p-l-20">
                          <ul class="action-links">
                            <li><?php $userArr = $this->Common->getUserDetail($log['LoanLog']['user_id']);
                            echo '<strong>';
                            echo isset($userArr['User']['user_type'])?$userTypes[$userArr['User']['user_type']]:'';
                            echo '</strong> : ';
                            echo !empty($userArr)?$userArr['User']['first_name'].' '.$userArr['User']['first_name']:'';
                            ?>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        
                      </div>
                    </li>
                    <?php
                      }
                    }?>                          
                  </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>