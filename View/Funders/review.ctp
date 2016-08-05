<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
	<div class="col-sm-12 col-md-12 col-lg-11 whiteBG">
        <div class="row-fluid" >
            <h2 class=" inline">Funder Review / Checklist</h2><?php echo $this->Session->flash();?>
			<hr />
        </div>
		<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
        <div class="row-fluid">
        <?php //pr($arrLoanDoc);
            echo $this->Form->create('Review', array('novalidate' => true,'id'=>'funderReivewForm','class'=>'form-no-horizontal-spacing reviewForm'));?>
            <div class="col-lg-12 radio_btn">
                <div class="col-lg-4">
                    <label>No Servicing Arrangements : </label> <br />
					<?php
						$OptionsYN = array('1'=>'Yes', '0'=>'No');
						$selected = "";
						if(!empty($funderReviews)){
							$selected = array_key_exists('no_servicing_aggrements', $funderReviews) ? true:false;
						}
						echo $this->Form->radio('no_servicing_aggrements', $OptionsYN, array('legend'=>false, 'required'=>true,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px", 'default'=>$selected));
					?>
                </div>
				<div class="col-lg-4">
                    <label>Broker is Servicing Agent : </label></br />
					<?php
						$selected = "";
						if(!empty($funderReviews)){
							$selected = array_key_exists('broker_is_servicing_agent', $funderReviews) ? true:false;
						}
						echo $this->Form->radio('broker_is_servicing_agent', $OptionsYN, array('legend'=>false, 'required'=>true,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px",'default'=>$selected));
					?>
                </div>
                <div class="col-lg-4">
                    <label>Another Qualifiied Party will Service the Loan : </label><br />
					<?php 
						$selected = "";
						if(!empty($funderReviews)){
							$selected = array_key_exists('another_qualified_party_will_service_the_loan', $funderReviews) ? true : false;
						}
						echo $this->Form->radio('another_qualified_party_will_service_the_loan', $OptionsYN, array('legend'=>false, 'required'=>true,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px", 'default'=>$selected));
					?>
                </div>
			</div><hr />
            <div class="col-lg-12 radio_btn">
                <div class="col-lg-4">
                    <label>Copy of Servicing Contract is Attached : </label><br />
                    <?php 
						$selected = "";
						if(!empty($funderReviews)) {
							$selected = array_key_exists('copy_of_servicing_contract_is_attached', $funderReviews) ? true : false;
						}
						echo $this->Form->radio('copy_of_servicing_contract_is_attached', $OptionsYN, array('legend'=>false, 'required'=>true, 'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px",'default'=>$selected));
                    ?>
				</div>               
                <div class="col-lg-4">
                    <label>Cost to Lender for Servicing (2% per year)</label> <br />
                    <?php
						$value = "";
						if(!empty($funderReviews)){
							$value = array_key_exists('cost_to_lender_for_servicing', $funderReviews) ? $funderReviews['cost_to_lender_for_servicing'] : '';
						}
						echo $this->Form->input('cost_to_lender_for_servicing',array('label' => false,'div' => false, 'placeholder' => '', 'class' => 'form-control', 'type' => 'text', 'value'=>$value));
                ?>
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>Servicing Paid (monthly)</label>
                    <?php
						if(!empty($funderReviews)) { $value = array_key_exists('servicing_paid', $funderReviews)?$funderReviews['servicing_paid']:''; }
						echo $this->Form->input('servicing_paid',array('label' => false,'div' => false, 'placeholder' => '', 'class' => 'form-control', 'type' => 'text', 'value'=>$value)); ?>
                </div>
			</div><hr />
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Name of Authorized Servicer</label><br />
					<?php
						if(!empty($funderReviews)) { $value = array_key_exists('name_of_authorized_servicer', $funderReviews)?$funderReviews['name_of_authorized_servicer']:''; }
						echo $this->Form->input('name_of_authorized_servicer',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text', 'value'=>$value)); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Telephone Number of Servicer</label><br />
						<?php
						if(!empty($funderReviews)) { $value = array_key_exists('telephone_number_of_servicer', $funderReviews)?$funderReviews['telephone_number_of_servicer']:''; }
						echo $this->Form->input('telephone_number_of_servicer',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text', 'value'=>$value)); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Business Address of Servicer</label><br />
                    <?php
						if(!empty($funderReviews)) { $value = array_key_exists('business_address_of_servicer', $funderReviews)?$funderReviews['business_address_of_servicer']:''; }
						echo $this->Form->input('business_address_of_servicer',array('label' => false,'div' => false, 'placeholder' => 'Business Address of Servicer','class' => 'form-control','type' => 'textarea', 'rows'=>'2', 'value'=>$value)); ?>
                </div>
			</div><hr />
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Docs</label> <br/>
					<?php
					if(!empty($arrLoanDoc)) {
						foreach($arrLoanDoc as $doc) {
							$docType = $doc['AskDocument']['document_type'];
							$documentId = $doc['AskDocument']['document_id'];
							//echo '<a href="" class="fa fa-download"> ';
							$link = $doc['AskDocument']['document_detail']['checklistname'];
							$document = urlencode($doc['AskDocument']['borrower_document']);
							//echo '</a>';
							echo $this->Html->link($link, $this->Html->url( '/', true ).'app/webroot/borrower_document/'.$document, array('class' => 'fa fa-download','target'=>'_blank'));
						   
							echo '<br />';                            
						}
					}
					?>
                </div>
            </div> <hr/>           
            <div class="col-lg-12 radio_btn">
                <div class="form-group col-lg-4">
                    <label>Reviewed</label><br />
                    <?php 
					$selected = "";
					if(!empty($funderReviews)) { $selected = array_key_exists('reviewed', $funderReviews)?true:false; }
							echo $this->Form->radio('reviewed', $OptionsYN, array('legend'=>false, 'required'=>true, 'legend' => false,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px",'default'=>$selected));
					?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Lender's instructions Reviewed</label><br />
                    <?php 
                    $selected = "";
                    if(!empty($funderReviews)) { $selected = array_key_exists('lenders_instructions_reviewed', $funderReviews)?true:false; }
                    echo $this->Form->radio('lenders_instructions_reviewed', $OptionsYN, array('legend'=>false, 'required'=>true,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px", 'default'=>$selected)); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Legal Input : </label> <br />
                    <?php 
                    $selected = "";
                    if(!empty($funderReviews)) { $selected = array_key_exists('legal_input', $funderReviews)?true:false; }
                    echo $this->Form->radio('legal_input', $OptionsYN, array('legend'=>false, 'required'=>true, 'legend' => false,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px",'default'=>$selected)); ?>
                </div>
            </div><hr />
            <div class="col-lg-12 radio_btn">
                <div class="form-group col-lg-4">
                    <label>Borrower Pays Legal : </label> <br />
                    <?php 
                    $selected = "";
                    if(!empty($funderReviews)) { $selected = array_key_exists('borrower_pays_legal', $funderReviews)?true:false; }
                    echo $this->Form->radio('borrower_pays_legal', $OptionsYN, array('legend'=>false, 'required'=>true,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px", 'default'=>$selected)); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Put Legal Fees in Loan closing : </label><br />
					<?php 
						$selected = "";
						if(!empty($funderReviews)) { $selected = array_key_exists('put_legal_fees_in_loan_closing', $funderReviews)?true:false; }
						echo $this->Form->radio('put_legal_fees_in_loan_closing', $OptionsYN, array('required'=>true,'legend' => false,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px", 'default'=>$selected)); ?>
                </div>
            </div>            
        </div>
        <div class="row-fluid">
            <div class="form-group col-lg-2 col-lg-offset-10">                
                <label>&nbsp;</label>
                <?php                    
                echo $this->Form->button('Submit Review', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton', 'div'=>false, 'label'=>false));
                ?>
            </div>
        </div>
    </div>
<!-- END PAGE --> 
</div>