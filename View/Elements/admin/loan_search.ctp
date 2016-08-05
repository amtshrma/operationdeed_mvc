<div class="row form-row">
    <?php
    $recordExits = false;
    if(isset($getData) && !empty($getData)) {
        
        $recordExits = true;
    }

    echo $this->Form->create('Search', array('url' => array('controller' => 'admins', 'action' => 'loans'),'id'=>'userssearch','type'=>'get'));    ?>
    <div class="col-lg-6 col-lg-search">   
        <?php
        $keyword = '';
        if(!empty($this->params->query)&& ($this->params->query['search'] !='')) {
            
            $keyword = $this->params->query['search'];	
        }
        echo $this->Form->input('search',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Loan Amount and Property Type','class' => 'form-control')); ?>					
    </div>
    
    <div class="col-lg-3 col-lg-search">                        
        <?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
        <?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'loans'),array('class' => 'btn btn-default'));?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>