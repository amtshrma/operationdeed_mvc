<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>Trust Deed Tombstone</h3><hr />
        <?php echo $this->Form->create('TrustDeedTombstone', array('novalidate' => true,'id'=>'tombstoneForm','class'=>'form-no-horizontal-spacing'));?>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover"> 
                        <thead>
                            <tr>
                                <td class="text-center lead mark">Fields Name</td>
                                <td class="text-center lead mark">Publish Status</td>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <td><strong>Trust Deed Position : </strong> <span><?php echo $this->Common->getTrustDeedFields('trustdeed_position', $arrTrustDeed['TrustDeed']['trustdeed_position']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php $radioOption = array('yes' =>'Yes','no' =>'No');
                                            $checked = 'yes';
                                            echo $this->Form->hidden('Trust_Deed_Position.value',array('value' => $this->Common->getTrustDeedFields('trustdeed_position', $arrTrustDeed['TrustDeed']['trustdeed_position'])));
                                            echo $this->Form->radio('Trust_Deed_Position.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Note Rate : </strong><span><?php echo $arrTrustDeed['TrustDeed']['note_rate']; ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                          <?php 
                                            echo $this->Form->hidden('Note_Rate.value',array('value' => $arrTrustDeed['TrustDeed']['note_rate']));
                                            echo $this->Form->radio('Note_Rate.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pre-pay : </strong><span> <?php echo $this->Common->getTrustDeedFields('pre_pay', $arrTrustDeed['TrustDeed']['pre_pay']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Pre_pay.value',array('value' => $this->Common->getTrustDeedFields('pre_pay', $arrTrustDeed['TrustDeed']['pre_pay'])));
                                             
                                             echo $this->Form->radio('Pre_pay.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Loan Term : </strong><span><?php echo $this->Common->getTrustDeedFields('loan_term', $arrTrustDeed['TrustDeed']['loan_term']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Loan_Term.value',array('value' => $this->Common->getTrustDeedFields('loan_term', $arrTrustDeed['TrustDeed']['loan_term'])));
                                            echo $this->Form->radio('Loan_Term.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Transaction Type : </strong><span> <?php echo $this->Common->getTrustDeedFields('trans_type', $arrTrustDeed['TrustDeed']['trans_type']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Transaction_Type.value',array('value' => $this->Common->getTrustDeedFields('trans_type', $arrTrustDeed['TrustDeed']['trans_type'])));
                                            echo $this->Form->radio('Transaction_Type.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Purchase Price : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['purchase_price'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Purchase_Price.value',array('value' => $arrTrustDeed['TrustDeed']['purchase_price']));
                                            echo $this->Form->radio('Purchase_Price.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Entitlements To Date : </strong><span> <?php echo $this->Common->getTrustDeedFields('entitlement_todate', $arrTrustDeed['TrustDeed']['entitlement_todate']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Entitlements_To_Date.value',array('value' => $this->Common->getTrustDeedFields('entitlement_todate', $arrTrustDeed['TrustDeed']['entitlement_todate'])));
                                            echo $this->Form->radio('Entitlements_To_Date.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total Cost To Date : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['cost_to_date'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                            <?php
                                                echo $this->Form->hidden('Total_Cost_To_Date.value',array('value' => $arrTrustDeed['TrustDeed']['cost_to_date']));
                                                echo $this->Form->radio('Total_Cost_To_Date.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Requested Loan Amount : </strong> <span> <?php echo $arrTrustDeed['TrustDeed']['req_loan_amount'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Requested_Loan_Amount.value',array('value' => $arrTrustDeed['TrustDeed']['cost_to_date']));
                                            echo $this->Form->radio('Requested_Loan_Amount.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LTV : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['ltv'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('LTV.value',array('value' => $arrTrustDeed['TrustDeed']['cost_to_date']));
                                            echo $this->Form->radio('LTV.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Property Type : </strong><span><?php echo $this->Common->getTrustDeedFields('property_type', $arrTrustDeed['TrustDeed']['property_type']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Property_Type.value',array('value' => $this->Common->getTrustDeedFields('property_type', $arrTrustDeed['TrustDeed']['property_type'])));
                                            echo $this->Form->radio('Property_Type.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Property Description : </strong>
                                    <span>
                                        No. of units : <?php echo isset($arrTrustDeed['TrustDeed']['no_of_units']) ? $arrTrustDeed['TrustDeed']['no_of_units'] : '--'; ?><br/>
                                        Bed : <?php echo isset($arrTrustDeed['TrustDeed']['bed']) ? $arrTrustDeed['TrustDeed']['bed'] : '--'; ?><br/>
                                        Bath : <?php echo isset($arrTrustDeed['TrustDeed']['bath']) ? $arrTrustDeed['TrustDeed']['bath'] : '--'; ?><br/>
                                    </span>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                   
                                        <?php 
                                            echo $this->Form->hidden('Property_Description.value',array('value' => $this->Common->getTrustDeedFields('property_type', $arrTrustDeed['TrustDeed']['property_type'])));
                                            echo $this->Form->radio('Property_Description.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Year Built : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['year_built'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Year_Built.value',array('value' => $arrTrustDeed['TrustDeed']['year_built']));
                                            echo $this->Form->radio('Year_Built.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Sq. Ft. Structure : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['sq_ft_structure'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Sq_Ft_Structure.value',array('value' => $arrTrustDeed['TrustDeed']['sq_ft_structure']));
                                            echo $this->Form->radio('Sq_Ft_Structure.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <strong>Sq. Ft. Lot : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['sq_ft_lot'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Sq_Ft_Lot.value',array('value' => $arrTrustDeed['TrustDeed']['sq_ft_lot']));
                                            echo $this->Form->radio('Sq_Ft_Lot.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Occupancy type : </strong><span> <?php echo $this->Common->getTrustDeedFields('occupancy_type', $arrTrustDeed['TrustDeed']['occupancy_type']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php 
                                            echo $this->Form->hidden('Occupancy_type.value',array('value' => $this->Common->getTrustDeedFields('occupancy_type', $arrTrustDeed['TrustDeed']['occupancy_type'])));
                                            echo $this->Form->radio('Occupancy_type.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Monthly Rental Income : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['monthly_rental_income'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Monthly_Rental_Income.value',array('value' => $arrTrustDeed['TrustDeed']['monthly_rental_income']));
                                            echo $this->Form->radio('Monthly_Rental_Income.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Borrower Entity Type : </strong><span> <?php echo $this->Common->getTrustDeedFields('borrower_entity_type', $arrTrustDeed['TrustDeed']['borrower_entity_type']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Borrower_Entity_Type.value',array('value' => $this->Common->getTrustDeedFields('borrower_entity_type', $arrTrustDeed['TrustDeed']['borrower_entity_type'])));
                                            echo $this->Form->radio('Borrower_Entity_Type.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','value'=>$checked,'checked'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Personal Guarantor Fico : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['personal_guarantor'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Personal_Guarantor_Fico.value',array('value' => $arrTrustDeed['TrustDeed']['personal_guarantor']));
                                            echo $this->Form->radio('Personal_Guarantor_Fico.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Occupation of Guarntor : </strong><span> <?php echo $arrTrustDeed['TrustDeed']['occupation_guarantor'];?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Occupation_of_Guarntor.value',array('value' => $arrTrustDeed['TrustDeed']['occupation_guarantor']));
                                            echo $this->Form->radio('Occupation_of_Guarntor.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Exit Strategy : </strong><span> <?php echo $this->Common->getTrustDeedFields('exit_strategy', $arrTrustDeed['TrustDeed']['exit_strategy']); ?></span></td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-with-icon  right">                                     
                                        <?php
                                            echo $this->Form->hidden('Exit_Strategy.value',array('value' => $this->Common->getTrustDeedFields('exit_strategy', $arrTrustDeed['TrustDeed']['exit_strategy'])));
                                            echo $this->Form->radio('Exit_Strategy.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Property Images : </strong></td>
                                <td>
                                    <?php
                                    if(!empty($arrTrustDeed['TrustDeedUpload'])){
                                        foreach($arrTrustDeed['TrustDeedUpload'] as $key => $image){
                                          $imageCount = $key + 1;
                                        ?>
                                            <div class="form-group" >
                                                <?php if(isset($image['property_image']) && $image['property_image'] != ''){ ?>
                                                    <div class="input-with-icon  right">                                     
                                                      <?php 
                                                         $file_path = BASE_URL."upload/TrustDeedFlyer/".$image['property_image'];
                                                        echo  '<img src="'.$file_path.'" width="100" height="100"/>';
                                                        $trustDeedImageID = isset($image['id'])?$image['id']:'';
                                                        echo $this->Form->hidden('trust_deed_upload.'.$imageCount.'.value',array('value' => $image['property_image']));
                                                         echo $this->Form->radio('trust_deed_upload.'.$imageCount.'.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                                    </div>
                                                <?php } ?>
                                            </div>
                                         <?php
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dynamic Fields : </strong></td>
                                <td>
                                <?php
                                    if(!empty($arrTrustDeed['TrustDeedField'])){
                                        foreach($arrTrustDeed['TrustDeedField'] as $key => $field){
                                        ?>
                                            <div class="form-group" >
                                                <?php if(isset($field['form_label']) && $field['form_label'] != ''){ ?>
                                                <div class="input-with-icon  right">                                     
                                                <?php 
                                                    $formLabel = $field['form_label'];
                                                    $formValue = $field['form_value'];
                                                    echo '<label>'.$formLabel. ' : '.$formValue.'</label>';
                                                    echo $this->Form->hidden('trust_deed_field.'.$key.'.value',array('value' => $formLabel .':' .$formValue));
                                                    echo $this->Form->radio('trust_deed_field.'.$key.'.option',$radioOption,array('legend' => false,'label'=>false,'class' => '','checked'=>$checked,'value'=>$checked,'hiddenField' =>false,'style'=> "margin:12px"));?>                                 
                                                </div>
                                           <?php } ?>
                                            </div>
                                     <?php }
                                    }?>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <?php echo $this->Form->button('Final Publish', array('type' => 'submit','class' => 'btn btn-primary btn-cons')); ?>
                </div>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>	
</div>  
