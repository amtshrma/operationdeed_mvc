<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3>My Hierarchy</h3><hr />
		<div class="row">
			<p><?php echo $this->Session->flash();?></p>
            <?php
            krsort($userTypes); 
            $i = 1;
			if(count($userTypes)){
               foreach($userTypes as $key=>$val){ 
                    $teamDetail = $this->Common->findHirarchy($key,$this->Session->read('userInfo.id'));
                    $margin = 7 * $i.'%';
                    $teamDetail = json_decode($teamDetail,true); 
                    if(!empty($teamDetail)){
						echo '<div style="font-size: 16px;margin-left: '.$margin.'"><strong>'.$val.'</strong>';
						echo "<ul class='usersListHir'>";
						foreach($teamDetail as $kk=>$vv){
							$class = $titlef = '';
							if($this->Session->read('userInfo.id') == $kk){
								$class = 'greenText';
								$titlef = 'You are here in hierarchy.'; 
							}
							echo '<li class="'.$class.'" title="'.$titlef.'" >'.$vv.'</li>';
						}
                         echo "</ul></div>";
                    }
                    $i++;
               }
			}
            ?> 
		</div>
	</div>
<!-- END PAGE -->
</div>