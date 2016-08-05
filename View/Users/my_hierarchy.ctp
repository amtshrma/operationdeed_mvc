 <div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><span class="semi-bold">My Hierarchy</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-body no-border">          
            <div class="row">
               <?php
               krsort($userTypes); 
               $i = 1;
               foreach($userTypes as $key=>$val){ 
                    $teamDetail = $this->Common->findHirarchy($key,$this->Session->read('userInfo.id'));
                    $margin = 5*$i.'%';
                   
                    $teamDetail = json_decode($teamDetail,true); 
                    if(!empty($teamDetail)){
                          echo '<div style="margin-left: '.$margin.'"><h4>'.$val.'</h4>';
                          echo "<ul>";
                         foreach($teamDetail as $kk=>$vv){
                              $class = '';
                              $titlef = '';
                              if($this->Session->read('userInfo.id') == $kk){
                                   $class = 'error';
                                   $titlef = 'You are here in hierarchy.'; 
                              }
                              echo '<li style="list-style:none" class="'.$class.'" title="'.$titlef.'" >'.$vv.'</li>';
                         }
                         echo "</ul></div>";
                    }
                    $i++;
               } 
               ?>
            </div>
           
          
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
