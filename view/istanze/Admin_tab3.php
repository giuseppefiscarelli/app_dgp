<?php
$countveiIst =countVeiIstanza($v['id_RAM']);
$countdocIst =countDocIst($v['id_RAM']);
//var_dump($countveiIst);
$cat=getCatInc();//var_dump(count($cat));
?>
<div class="row">
    <div class="col-lg-8">
        <table class="table">
            <thead>
                <tr>
                    <td></td><td></td><td></td><td colspan="<?=count($cat)?>" style="text-align:center;">Categorie</td>
                </tr>
                <tr>
                <td></td><td></td><td><span class="badge badge-danger" style="font-size:20px;">Tot</span></td>
                <?php
                    foreach($cat as $c){?>
                        <td style="width:7%;"><span class="badge badge-danger" style="font-size:20px;"><?=$c['ctgi_categoria']?></span></td>
                    <?php
                    }
                ?>
                
                </tr>    
            </thead>
            <tbody>
                <tr><td rowspan="2">Veicoli Istanza</td>
                <td>Caricati</td>
                <td><span class="badge badge-primary" style="font-size:20px;"><?=$countveiIst?></span></td>
            
                <?php
                    foreach($cat as $ca){
                        $countcat= countVeiIstanzaCat($i['id_RAM'],$ca['ctgi_codice']);?>

                        <td><span class="badge badge-primary" style="font-size:20px;"><?=$countcat?></span></td>
                    <?php
                    }
                ?>
            
            
            </tr>
            <tr>
                <td>Verificati</td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                
                
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
            </tr>
            <tr>
                <td rowspan="2">Documenti Istanza</td>
                <td>Caricati</td>
                <td><span class="badge badge-primary" style="font-size:20px;"><?=$countdocIst?></span></td>
                <?php
                    foreach($cat as $caA){
                        $countcatA= countDocIstCat($i['id_RAM'],$caA['ctgi_codice']);?>

                        <td><span class="badge badge-primary" style="font-size:20px;"><?=$countcatA?></span></td>
                    <?php
                    }
                ?>
            </tr>
            <tr>
                <td>Verificati</td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
                <td><span class="badge badge-warning" style="font-size:20px;color:black;">0</span></td>
               
            </tr>
            </tbody>
        </table>    
    </div>
</div> 
