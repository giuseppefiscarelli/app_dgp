<?php
$countveiIst =countVeiIstanza($v['id_RAM']);
$countdocIst =countDocIst($v['id_RAM']);
//var_dump($countveiIst);
$cat=getCatInc();//var_dump(count($cat));
?>
<!--
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

-->
<div class="row">
    <div class="col-12">
        <table class="table">
        <h4>Riepilogo veicoli ammessi</h4>
            <thead>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2" style="background-color: #06c6;text-align:center;">Maggiorazione</th>
                    <th></th>
                </tr>    
                <tr>
                    <th>Tipologia</th>
                   
                    <th>Targa</th>
                    <th>Costo</th>
                    <th>Contributo</th>
                    <th style="background-color: #06c6;text-align:center;">PMI</th>
                    <th style="background-color: #06c6;text-align:center;">Rete Imprese</th>
                    <th style="background-color: #d6dce3;">Totale</th>
                </tr>
            </thead>
            <tbody>
            <?php
             $veiRiep = getVeicoli($i['id_RAM']);
             $totcosto=0;
             $totcontr =0;
             $totpmi = 0;
             $totrete = 0;
             $tottotale=0;

             foreach($veiRiep as $v){
                 if($v['stato_admin']=='B'){
                $tipo = getTipoVeicolo($v['tipo_veicolo']);
                $categ = getCategoria($tipo['codice_categoria_incentivo']);
                $cont = calcolaContributo($v);
                $contr = $cont[0];
                $totale = $contr['contributo']+$contr['pmi']+$contr['rete'];

                $totcosto += $v['costo'];
                $totcontr  +=  $contr['contributo'];
                $totpmi +=$contr['pmi'];
                $totrete +=$contr['rete'];
                $tottotale += $totale;
                //var_dump($cont);
                ?>
                <tr id="riep_">
                    <td><span class="badge badge-secondary" style="font-size:20px;width: -webkit-fill-available;"><?=$tipo['tpvc_descrizione_breve']?></span></td>
                   
                    <td><span class="badge badge-primary" style="font-size:20px;"><?=$v['targa']?></span></td>
                    <td style="text-align:right;"><?=$v['costo']?'€ '.number_format($v['costo'], 2, ',', '.'):'Non Presente'?></td>
                    <td style="text-align:right;"><?=$contr['contributo']?'€ '.number_format($contr['contributo'], 2, ',', '.'):'€ 0,00'?></td>
                    <td style="background-color: #bfd4ea;text-align:right;"><?=$contr['pmi']?'€ '.number_format($contr['pmi'], 2, ',', '.'):'€ 0,00'?></td>
                    <td style="background-color: #bfd4ea;text-align:right;"><?=$contr['rete']?'€ '.number_format($contr['rete'], 2, ',', '.'):'€ 0,00'?></td>
                    <td style="background-color: ##d6dce338;text-align:right;"><?=$totale?'€ '.number_format($totale, 2, ',', '.'):'€ 0,00'?></td>
                </tr>
             <?php }
             }
             ?>
            
            </tbody>
            <tfoot>
             <tr><td colspan="2" style="text-align:right;"> Totale</td>
                <td style="text-align:right;"><?='€ '.number_format($totcosto, 2, ',', '.')?></td>
                <td style="text-align:right;"><?='€ '.number_format($totcontr, 2, ',', '.')?></td>
                <td style="text-align:right;background-color: #bfd4ea;"><?='€ '.number_format($totpmi, 2, ',', '.')?></td>
                <td style="text-align:right;background-color: #bfd4ea;"><?='€ '.number_format($totrete, 2, ',', '.')?></td>
                <td style="text-align:right;background-color: ##d6dce338;"><?='€ '.number_format($tottotale, 2, ',', '.')?></td>
            </tr>
            </tfoot>
        </table>
        </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table">
        <h4>Riepilogo veicoli in lavorazione / non ammessi</h4>
            <thead>
            <tr>
                    <th style="width:15%;">Tipologia</th>
                   
                    <th style="width:15%;">Targa</th>
                    <th style="width:15%;">Costo</th>
                    <th style="width:55%;">Note</th>
                   
                </tr>
            </thead>
            <tbody>
            <?php
             $veiRiep = getVeicoli($i['id_RAM']);
             foreach($veiRiep as $v){
                 if($v['stato_admin']!=='B'){
                $tipo = getTipoVeicolo($v['tipo_veicolo']);
                $categ = getCategoria($tipo['codice_categoria_incentivo']);
                $cont = calcolaContributo($v);
                $contr = $cont[0];
                $totale = $contr['contributo']+$contr['pmi']+$contr['rete'];
                //var_dump($cont);
                ?>
                <tr>
                    <td><span class="badge badge-<?=$v['stato_admin']=='A'||$v['stato_admin']==null?'warning':'danger'?>" style="font-size:20px;width: -webkit-fill-available;"><?=$tipo['tpvc_descrizione_breve']?></span></td>
                   
                    <td><span class="badge badge-primary" style="font-size:20px;"><?=$v['targa']?></span></td>
                    <td style="text-align:right;"><?=$v['costo']?'€ '.number_format($v['costo'], 2, ',', '.'):'Non Presente'?></td>
                    
                    <td ><?=$v['note_admin']?></td>
                </tr>
             <?php }
             }
             ?>
            
            </tbody>
        </table>
    </div>
</div>            
