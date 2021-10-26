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
        <table class="table" id="tab_riepilogo_amm">
        <h4>Riepilogo veicoli ammessi</h4>
            <thead>
                <tr>
                    <th colspan="6"></th>
                    <th colspan="2" style="background-color: #06c6;text-align:center;">Maggiorazione</th>
                    <th></th>
                </tr>    
                <tr>
                    <th>Categoria</th>
                    <th  style="text-align:center;">Tipologia</th>
                    <th>Prog</th>
                    <th  style="text-align:center;">Targa</th>
                    <th  style="text-align:center;">Costo</th>
                    <th style="text-align:center;">Contributo</th>
                    <th style="background-color: #06c6;text-align:center;">PMI</th>
                    <th style="background-color: #06c6;text-align:center;">Rete Imprese</th>
                    <th style="background-color: #d6dce3;text-align:right;">Totale</th>
                </tr>
            </thead>
            <tbody>
           
            
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
        </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table" id="tab_riepilogo_resp">
        <h4>Riepilogo veicoli in lavorazione / non ammessi</h4>
            <thead>
            <tr>
                    <th >Categoria</th>
                    <th >Tipologia</th>
                    <th>Prog</th>
                    <th >Targa</th>
                     
                    <th >Note</th>
                   
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>     
<script>       
    $('#nav-3').on('shown.bs.tab', function (e) {
        //var target = $(e.target).attr("href") // activated tab
        //alert(target);
        $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=getRiepilogo",
            data: {idRAM:<?=$i['id_RAM']?>},
            dataType: "json",
            success: function(data){
                $('#tab_riepilogo_amm > tbody').empty()
                $('#tab_riepilogo_amm > tfoot').empty()
                $('#tab_riepilogo_resp > tbody').empty()
                    //console.log(data.datavei);
                    $.each(data.datavei, function (k,v){
                        
                        categoria = '<td><span class="badge badge-danger" style="font-size:20px;">'+v.categoria+'</span></td>'
                        tipologia = '<td><span class="badge badge-secondary" style="font-size:20px;width: -webkit-fill-available;">'+v.tipologia+'</span></td>'
                        targa = '<td><span class="badge badge-primary" style="font-size:20px;width: -webkit-fill-available;">'+v.targa+'</span></td>'
                        prog =  '<td><span class="badge badge-success" style="font-size:20px;">'+v.prog+'</span></td>'
                        costoeuro = parseFloat(v.costo).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                        costo = '<td style="text-align:right;">'+costoeuro+'</td>'
                        contributoeuro = parseFloat(v.contributo).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                        contributo = '<td style="text-align:right;">'+contributoeuro+'</td>'
                        pmieuro = parseFloat(v.pmi).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                        pmi = '<td style="background-color: #bfd4ea;text-align:right;">'+pmieuro+'</td>'
                        reteeuro = parseFloat(v.rete).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                        rete ='<td style="background-color: #bfd4ea;text-align:right;">'+reteeuro+'</td>'
                        
                        totaleeuro = parseFloat(v.totale).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                        totale ='<td style="background-color: #d6dce338;text-align:right;">'+totaleeuro+'</td>'
                        note = '<td>'+v.note+'</td>'
                        if(v.stato_admin == 'B'){
                           
                            tr ='<tr>'+categoria+tipologia+prog+targa+costo+contributo+pmi+rete+totale+'</tr>';
                            $('#tab_riepilogo_amm > tbody').append(tr)
                           
                        }else{
                            tr = '<tr>'+categoria+tipologia+prog+targa+note+'</tr>'
                            $('#tab_riepilogo_resp > tbody').append(tr)

                        }
                        
                    })
                    if(data.rottamazione== true){
                        data.tottotale += 2000;
                        rottamazione = parseFloat(2000).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                        foot='<tr style="font-weight:bold;"><td colspan="6" style="text-align:right;"> Maggiorazione Rottamazione</td><td colspan="2" style="background-color: #bfd4ea;"></td>';
                        foot +='<td style="background-color: #d6dce338;text-align:right;">'+rottamazione+'</td>'
                        foot+='</tr>'
                        $('#tab_riepilogo_amm > tfoot').append(foot)
                    }
                    limite = false
                    flaglimite = ''
                    if(data.tottotale> 550000){
                            limite = true
                            data.tottotale = 550000
                            flaglimite = '<b style="color:red;"> *</b>'
                        }
                    totcontr=parseFloat(data.totcontr).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                    totcosto=parseFloat(data.totcosto).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                    totpmi=parseFloat(data.totpmi).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                    totrete=parseFloat(data.totrete).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                    tottotale=parseFloat(data.tottotale).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                    foot='<tr style="font-weight:bold;"><td colspan="4" style="text-align:right;"> Totale</td>'
                    foot+='<td style="text-align:right;">'+totcosto+'</td>'
                    foot+='<td style="text-align:right;">'+totcontr+flaglimite+'</td>'
                    foot+='<td style="background-color: #06c6;text-align:right;">'+totpmi+'</td>'
                    foot+='<td style="background-color: #06c6;text-align:right;">'+totrete+'</td>'
                    foot+='<td style="background-color: #d6dce3;text-align:right;">'+tottotale+'</td>'
                    foot+='</tr>'
                    if (limite){ 
                        foot += '<tr><td colspan="9" style="color:red;"><b>* Limite contributo di '+tottotale+'</b></td></tr>'
                    }
                    $('#tab_riepilogo_amm > tfoot').append(foot)
            }
        })
    });
</script>