<div class="row">
    <?php
    echo $this->Form->create('Search', array('url' => array('controller' => 'users', 'action' => 'index'),'id'=>'userssearch','type'=>'get'));    ?>
    <div class="col-lg-2 col-lg-search">   
        <?php
        $keyword = '';
        if(!empty($this->params->query)&& ($this->params->query['first_name'] !='')) {
            $keyword = $this->params->query['first_name'];	
        }
        echo $this->Form->input('first_name',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Name','class' => 'form-control'));?>
        
    </div>
    <div class="col-lg-2 col-lg-search">   
        <?php
        $search_email = '';
        if(!empty($this->params->query)&& ($this->params->query['search_email'] !='')) {
            $search_email = $this->params->query['search_email'];	
        }
        echo $this->Form->input('search_email',array('label' => false,'div' => false,'value'=>$search_email, 'placeholder' => 'Search By Email','class' => 'form-control')); ?>						
    </div>
    <div class="col-lg-2 col-lg-search">   
        <?php
        $selectedType = '';
        if(isset($this->params->query['search_user_type']) && ($this->params->query['search_user_type'] !='')) {
            $selectedType = $this->params->query['search_user_type'];	
        }
        echo $this->Form->input('search_user_type',array('label' => false,'div' => false, 'options'=>$userTypes,'empty' => 'Search By User Type','class' => 'form-control','selected' => $selectedType));
        $searchStaff = '';
        if(!empty($this->params->query)&& ($this->params->query['search_email'] != '')) {
            $search_email = $this->params->query['search_email'];	
        }
    ?>
    </div>
    <div class="col-lg-3 col-lg-search">
    <?php
        $radioOption = array('1'=>'Staff only', '0'=>'Other users only');
        echo $this->Form->input('search_staff',array('empty'=>'Select Staff Type','label'=>false,'div'=>false,'options'=>$radioOption,'class'=>'','style'=> "margin-left:12px",'default'=>(!empty($this->params->query['search_staff']) ? $this->params->query['search_staff'] : '0'))); ?>
    </div>
    
    <div class="col-lg-3 col-lg-search">                        
        <?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
        <?php echo $this->Html->link('List All',array('controller'=>'users','action'=>'index'),array('class' => 'btn btn-default'));?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>