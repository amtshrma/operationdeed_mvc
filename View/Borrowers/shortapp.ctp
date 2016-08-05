<div class="section first">
    <div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Short App</h2>
          </div>
          
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
        <div class="container">
          <div class="row login-container">
            <div class="row column-seperation">
                    <div class="col-lg-12">
                      <span class="help"></span>
                    </div>
                    <div class="col-lg-12">
                     <table class="table table-bordered">
                       <tr>
                        <th>Applicant Name</th>
                        <th>Applicant Email</th>
                        <th>Applicant Phone</th>
                        <th>Applicant Company Name</th>
                        <th>Load Objective</th>
                        <th>Action</th>
                       </tr>
                       <?php
                       foreach($shortApplication as $shotApplication){
                       
                       ?>
                       <tr>
                        <td><?php echo $shotApplication['ShortApplication']['applicant_first_name']." ".$shotApplication['ShortApplication']['applicant_last_name'];?></td>
                        <td><?php echo $shotApplication['ShortApplication']['applicant_email_ID'];?></td>
                        <td><?php echo $shotApplication['ShortApplication']['applicant_phone'];?></td>
                        <td><?php echo $shotApplication['ShortApplication']['applicant_company_name'];?></td>
                        <td><?php echo $shotApplication['ShortApplication']['loan_objective'];?></td>
                        <td><?php echo $this->Html->link('Submit Document',array('controller'=>'borrowers','action'=>'ask_document/'.base64_encode($shotApplication['ShortApplication']['id'])))." ".$this->Html->link('Enquiry',array('controller'=>'borrowers','action'=>'enquiry/'.base64_encode($shotApplication['ShortApplication']['id']))); ?></td>
                       </tr>
                       <?php
                       }
                       ?>
                     </table>   
                    </div>
            </div>
          </div>
        </div>
    </div>
</div>