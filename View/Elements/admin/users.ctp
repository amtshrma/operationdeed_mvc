<?php
//Pagination
$this->Js->JqueryEngine->jQueryObject = 'jQuery';
$this->Paginator->options(array(
  'update' => '#paginatedata',
  'evalScripts' => true,
  'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
  'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
));
?>
<div class="table-responsive">
  <?php
if(isset($getData) && !empty($getData)) { ?>
  <table class="table table-striped table-flip-scroll cf table-hover table-condensed">
    <thead>
      <tr>
        <th style="width:1%" data-hide="phone,tablet">
            <div class="checkbox check-default">
                <input type="checkbox" value="1" class="checkall" id="checkall">
                <label for="checkall"></label>
            </div>
        </th>
        <th style="width:1%" data-hide="phone,tablet"><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
        <th style="width:6%"><?php echo $this->Paginator->sort('otd_staff', 'OTD Staff'); ?></th>
        <th style="width:6%"><?php echo $this->Paginator->sort('email_address', 'Email Address'); ?></th>
        <th style="width:3%">Team</th>
        <th style="width:3%"><?php echo $this->Paginator->sort('first_name', 'Name'); ?></th>
        <th style="width:6%" ><?php echo $this->Paginator->sort('user_type', 'User Type'); ?></th>
        
        <!--<th style="width:5%"><?php echo $this->Paginator->sort('company_name', 'Company Name'); ?></th>
        <th style="width:5%"><?php echo $this->Paginator->sort('company_position', 'Company Position'); ?></th>
        <th style="width:5%" ><?php echo $this->Paginator->sort('state', 'State'); ?></th>
        <th style="width:5%"><?php echo $this->Paginator->sort('city', 'City'); ?></th>-->
        <th style="width:5%" >Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php //pr($getData);
        $i=1;
        foreach($getData as $key => $getData) {
            
            $userId = $getData['User']['id'];
            $class = ($key%2 == 0) ? ' class="active"' : '';
            $userTypeID = $getData['User']['user_type'];
            $stateID = $getData['UserDetail']['state'];
            $status = $getData['User']['status'];
            $staff = $getData['User']['otd_staff'];
            $pid = $getData['User']['id'];
            ?>
            <tr>
              <td class="v-align-middle">
                <div class="checkbox check-default">
                    <input type="checkbox" name="checkboxes[]" class ="chld" value="<?php echo base64_encode($userId);?>" id="checkbox_<?php echo $i; ?>">
                    <label for="checkbox_<?php echo $i; ?>"></label>
                </div>
              </td>
              <td class="v-align-middle">
                <?php							
                echo $this->Form->button($arrStatus[$status], array('class'=>$statusClass[$status], 'id'=>base64_encode($userId), 'value'=>$status, 'rel'=>'User', 'fld'=>'status'));
                ?>
              </td>
              
              <td class="v-align-middle">
              <?php
              $arrStaff = array('0'=>'No', '1'=>'Yes');
              echo $this->Form->button($arrStaff[$staff], array('class'=>$statusClass[$staff], 'id'=>base64_encode($userId), 'value'=>$staff, 'rel'=>'User', 'fld'=>'otd_staff')); ?></td>
              <td>
                  <?php
                    if(isset($getData['User']['email_address'])){
                        echo $getData['User']['email_address'];
                    } else {
                        echo '--';
                    }
                    ?>
              </td>
              <td>
                  <?php
                  $teamNames = $this->Common->getUserTeams($getData['User']['id']); 
                  
                  if(!empty($teamNames)) {							
                      echo implode(',',$teamNames);
                  } else {							
                      echo '--';
                  } ?>
              </td>
              <td class="v-align-middle"><?php echo ucfirst($getData['User']['first_name']). ' '.ucfirst($getData['User']['last_name']);?></td>
              <td class="v-align-middle">
                  <?php 
                    if(isset($userTypeID) && !empty($userTypeID) && $userTypeID > 0) {
                        echo $userTypes[$userTypeID];
                    } else {
                        echo '--';
                    }?>
              </td>
              
              <!--<td class="v-align-middle">
                  <?php /*
                    if(isset($getData['UserDetail']['company_name'])){
                        echo $getData['UserDetail']['company_name'];
                    } else {
                        echo '--';
                    } ?>
              </td>
              <td class="v-align-middle">
                  <?php
                    if(isset($getData['UserDetail']['company_position'])){
                        echo $getData['UserDetail']['company_position'];
                    } else {
                        echo '--';
                    } ?>
              </td>
              <td class="v-align-middle">
                  <?php
                    if(isset($getData['UserDetail']['state'])){
                        echo $states[$stateID];
                    } else {
                        echo '--';
                    } ?>
                  
              </td>
              <td class="v-align-middle">
                  <?php
                    if(isset($getData['UserDetail']['city'])){
                        echo $city = $this->Common->getCityName($getData['UserDetail']['city']);
                    } else {
                        echo '--';
                    } */?>							  
              </td>-->
              <td class="v-align-middle">
                  <?php
                  echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller'=>'users','action'=>'view_user',base64_encode(base64_encode($getData['User']['id']))),array('escape' =>false, 'title'=>'View', 'alt'=>'View'));							  
                  echo '&nbsp;&nbsp;';
                  echo $this->Html->link('<i class="fa fa-edit"></i>', array('controller'=>'users','action'=>'add',base64_encode($getData['User']['id'])),array('escape' =>false, 'title'=>'Edit', 'alt'=>'Edit'));
                  echo '&nbsp;&nbsp;';
                  echo $this->Html->link('<i class="fa fa-trash-o"></i>', 'javascript:void(0);', array('escape' =>false, 'title'=>'Delete', 'alt'=>'Delete', 'class'=>'deleterow', 'id'=>base64_encode($userId), 'value'=>'5', 'rel'=>'User', 'fld'=>'status'));
                  echo '&nbsp;&nbsp;';
                   echo $this->Html->link('<i class="fa fa-plus"></i>', 'javascript:void(0);', array('escape' =>false, 'title'=>'Activate to invite members', 'alt'=>'Activate to invite members', 'id'=>base64_encode($userId)));
                  
                  
                 // echo $this->Html->link('<i class="fa fa-file"></i>', array('controller'=>'users','action'=>'verifyDocument',base64_encode($getData['User']['id'])),array('escape' =>false, 'title'=>'Document', 'alt'=>'Document'));
                  //echo $this->Html->link('<i class="fa fa-trash-o"></i>',"/admin/users/delete/".base64_encode($getData['User']['id']), array('escape' =>false, 'title'=>'Delete', 'alt'=>'Delete'),"Are you sure to delete selected User?"); ?>						
              </td>
            </tr>
            <?php $i++;
        } ?>
    </tbody>
  </table>
   </div>
    <div class="row grid-title">
        <div class="col-lg-3">
            <?php						
            echo $this->Form->select('status', $arrStatus, array('empty'=>'Select one to change status', 'class'=>'form-control chngstatus', 'rel'=>'User', 'fld'=>'status')); ?>
        </div>
        <div class="col-lg-9">
            <div class="paging" align="right">
                <?php
                if(count($getData) > 0) {
                  
                  echo $this->element('pagination');                    
                }                
                ?>
            </div>
        </div>
    </div>
    <div class="row form-row">
        <div class="col-lg-2"> LEGENDS:</div>
        <div class="col-lg-2"><?php echo '<i class="fa fa-eye"></i> View &nbsp;'; ?></div>
        <div class="col-lg-2"><?php echo '<i class="fa fa-edit"></i> Edit &nbsp;'; ?></div>
        <div class="col-lg-2"><?php echo '<i class="fa fa-trash-o"></i> Delete &nbsp;'; ?></div>
        <div class="col-lg-2"><?php echo '<i class="fa fa-thumbs-up green"></i> Active / Yes &nbsp;'; ?></div>
        <div class="col-lg-2"><?php echo '<i class="fa fa-thumbs-down red"></i> Inactive / No &nbsp;'; ?></div>
    </div>
    <?php
    }else {
        
        echo $this->element('admin/no_record_exists');
    } ?>
 
