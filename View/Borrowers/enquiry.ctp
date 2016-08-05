<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <br />
        <p>Kindly upload latest changes documents from ask Documents. </p>
        <br />
        <?php echo $this->Html->link('Update Document',array('controller'=>'borrowers','action'=>'ask_document/'.base64_encode($enquiry['AskDocument']['loan_id'])),array());?>
        <table class="table table-bordered">
            <tr>
                <th>Loan ID</th>
                <th>Description</th>
                <th>Checklist</th>
            </tr>
                <tr>
                    <td><?php echo $enquiry['AskDocument']['loan_id'];?></td>
                    <td><?php echo $enquiry['AskDocument']['enquiry'];?></td>
                    <td><?php echo $enquiry['AskDocument']['borrower_document'];?></td>
                </tr>
        </table>
    </div>
</div>