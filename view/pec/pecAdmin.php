<?php

//var_dump($unSend);

?>

<div class="row">
    <div class="col-3 col-md-2">
        <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
            
            <a class="nav-link active" id="nav-vertical-tab-bg1-tab" data-toggle="tab" href="#nav-vertical-tab-bg1" role="tab" aria-controls="nav-vertical-tab-bg1" aria-selected="true">
                <table style="width:100%">
                  <tr><td style="width:90%">Pec da convalidare</td><td><span class="badge badge-primary"><?=$unSend?></span></td></tr>
                </table> 
            </a>
            <a class="nav-link" id="nav-vertical-tab-bg3-tab" data-toggle="tab" href="#nav-vertical-tab-bg3" role="tab" aria-controls="nav-vertical-tab-bg3" aria-selected="true">
                <table style="width:100%">
                  <tr><td style="width:90%">Pec da inviare</td><td><span class="badge badge-primary"><?=$conv?></span></td></tr>
                </table> 
            </a>

            <a class="nav-link" id="nav-vertical-tab-bg2-tab" data-toggle="tab" href="#nav-vertical-tab-bg2" role="tab" aria-controls="nav-vertical-tab-bg2" aria-selected="false">
                <table style="width:100%">
                  <tr><td style="width:90%">Pec inviate</td><td><span class="badge badge-primary"><?=$send?></span></td></tr>
                </table> 
            </a>

        </div>
    </div>
    <div class="col-9 col-md-10">
       



          <div class="tab-content" id="nav-vertical-tab-bgContent">
              <div class="tab-pane p-3 fade show active" id="nav-vertical-tab-bg1" role="tabpanel" aria-labelledby="nav-vertical-tab-bg1-tab"><?php require 'admin_tab1.php';?></div>
              <div class="tab-pane p-3 fade" id="nav-vertical-tab-bg3" role="tabpanel" aria-labelledby="nav-vertical-tab-bg3-tab"><?php require 'admin_tab3.php';?></div>
              <div class="tab-pane p-3 fade" id="nav-vertical-tab-bg2" role="tabpanel" aria-labelledby="nav-vertical-tab-bg2-tab"><?php require 'admin_tab2.php';?></div>
          </div>
        </div>
</div>


