<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>View Borrower Detail</h3><hr />
        <div class="col-md-12">
            <h4><b>Basic Information</b></h4><hr />            
            <div class="form-group col-md-4">
                <label class="form-label"><strong>First Name : </strong><?php echo $arrUser['User']['first_name']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Last Name : </strong><?php echo $arrUser['User']['last_name']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>User Type : </strong><?php echo $userTypes[$arrUser['User']['user_type']]; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Email Address : </strong> <?php echo $arrUser['User']['email_address']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Company Name : </strong><?php echo $arrUser['UserDetail']['company_position']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Company Position : </strong><?php echo $arrUser['UserDetail']['company_position']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Birthday : </strong><?php echo _dateFormatFront($arrUser['UserDetail']['birthdate']); ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"> <strong>Profile Picture</strong><?php $pp = $arrUser['UserDetail']['profile_picture']; ?></label
            </div>
        </div>
        <div class="col-md-12">
            <h4><b>Postal Information</b></h4><hr />
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Mailing Address : </strong> <?php echo $arrUser['UserDetail']['mailing_address']; ?></label>
            </div>
            <?php if(!empty($arrUser['UserDetail']['mailing_address2'])) { ?>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Mailing Address 2 : </strong><?php echo $arrUser['UserDetail']['mailing_address2']; ?>&nbsp;</label>
            </div>
            <?php } ?>
            <div class="form-group col-md-4">
            <?php $state = $this->Common->getStateName($arrUser['UserDetail']['state']); ?>
                <label class="form-label"><strong>State : </strong><?php echo $state; ?></label>
            </div>
            <div class="form-group col-md-4">
                <?php $city = $this->Common->getCityName($arrUser['UserDetail']['city']); ?>
                <label class="form-label"><strong>City : </strong><?php echo $city; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Zipcode : </strong><?php echo $arrUser['UserDetail']['zipcode']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Fax Number : </strong><?php echo $arrUser['UserDetail']['fax_number']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Office Phone : </strong><?php echo $arrUser['UserDetail']['office_phone']; ?></label>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><strong>Mobile Phone</strong> <?php echo $arrUser['UserDetail']['mobile_phone']; ?></label>
            </div>
        </div>
        <div class="col-md-12">
            <h4><b>Additional Information</b></h4><hr />
            <div class="form-group col-md-4">
            <?php $licenceType = $arrUser['UserDetail']['employer_licence_type'];
                if($licenceType == 'bre') { ?>
                <div class="col-md-4" id ="BRELiceneRow">
                    <label class="form-label"><strong>BRE License : </strong><?php echo $arrUser['UserDetail']['bre_license_number']; ?></label>
                </div>
            <?php } else { ?>
                <div class="col-md-4" id = "CFLLiceneRow">
                    <label class="form-label"><strong>CFL License : </strong><?php echo $arrUser['UserDetail']['cfl_license_number']; ?></label>
                </div>
            <?php } ?>
            </div>
            <?php
            if(!empty($arrUser['UserDetail']['referred_by_user_id'])){ ?>
                <div class="col-md-4">
                    <label class="form-label">Referred User Name</label>                      
                    <div class="input-with-icon  right">                                       
                       <?php
                       $referred_by_user_id = isset($arrUser['UserDetail']['referred_by_user_id'])?$arrUser['UserDetail']['referred_by_user_id']:'&nbsp;';
                       $referee = $this->Common->getUserDetail($referred_by_user_id);
                       echo !empty($referee)?$referee['User']['first_name'].' '.$referee['User']['last_name']:'&nbsp;';
                       ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>   
</div>