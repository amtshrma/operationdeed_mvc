<?php
    echo '<tfoot>';
    echo '<tr>';
    echo '<td colspan="7" class="text-right">';
    $count=$this->Paginator->counter('{:count}');
    if($count>10) {
        echo '  <span class="pagination pagination-right" style="margin:0px !important;">';
        echo $this->Paginator->first('<span class="fa fa-chevron-left"></span> First', array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
        echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
        echo $this->Paginator->numbers(array('currentClass' => 'active', 'currentTag' => 'a', 'tag' => 'li', 'separator' => ''));
        echo $this->Paginator->next('<i class="fa fa-chevron-right"></i> ', array('escape' => false, 'tag' => 'li', 'currentClass' => 'disabled'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
        echo $this->Paginator->last('Last <span class="fa fa-chevron-right"></span>', array('escape' => false, 'tag' => 'li', 'currentClass' => 'disabled'), null, array('escape' => false, 'tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
        
        echo '  </span>';
    }
    
    echo '<p>'.$this->Paginator->counter(array('format' => 'Page {:page} of {:pages}, showing {:current} records out of {:count} total.')).'</p>';
    echo '</td>';
    echo '</tr>';
    echo '</tfoot>';
    echo $this->Js->writeBuffer();
?>  