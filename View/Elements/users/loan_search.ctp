<div class="row form-row">
    <?php
    $recordExits = false;
    if(isset($getData) && !empty($getData)) {
        
        $recordExits = true;
    }

    echo $this->Form->create('Search', array('url' => array('controller' => 'loans', 'action' => 'loan_listing'),'id'=>'userssearch','type'=>'get'));    ?>
    <div class="col-lg-6 col-lg-search">   
        <?php
        $keyword = '';
        if(!empty($this->params->query)&& ($this->params->query['search'] !='')) {
            
            $keyword = $this->params->query['search'];
        }
        echo $this->Form->input('search',array('div' => false,'value'=>$keyword, 'placeholder' => 'Search By Loan Amount, Property Type, State, City','class' => 'form-control')); ?>
    </div>
    <div class="col-lg-6 col-lg-search">
        <?php echo $this->Form->input('search_by_loan_date', array('type'=>'text', 'div' => false, 'class' => 'form-control datepicker', 'placeholder'=>'Pick a date', 'value'=>'')); ?>
    </div>
    <div class="col-lg-4 col-lg-search">
        <?php
        echo $this->Form->input('search_by_loan_status',array('div' => false, 'empty' => 'Select one', 'class' => 'form-control', 'options' =>$loanStatus, 'value'=>''));
        ?>
    </div>
    
    
    <div class="col-lg-12 col-lg-search">                        
        <?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
        <?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'loans'),array('class' => 'btn btn-default'));?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>