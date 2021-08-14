<page pagegroup="new"  style="font-size:12px" backtop="30mm" backleft="15mm" backright="15mm" backbottom="9mm">
	
<style>
	.testoParagrafo {
		text-align:justify;	
        font-weight: bold;
	}
    .smallBox {
    	border:1px solid #333;
    	height:3mm; 
    	width:3mm; 
    	display:inline;
    }
</style>
<style>

.tab{
    border: 1px solid black;
  border-collapse: collapse;
}
 .bordered-bottom {
    	border-bottom: 1px dashed black;	
    }
    .separator {
    	border-top:1px solid #333;
    }
    .box {
    	border:1px solid #333;
    	height:5mm; 
    	width:5mm; 
    	display:inline;
    }
    .priv{
        text-align: justify;
        font-size:8px;

    }
	</style>
<style type="text/css">

    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {
					width: 91%;
					text-align:"center";
					border: none; 
					border-top: solid 1mm black; 
					padding: 1mm; 
					margin-left :10mm;
					}
    div.note {border: solid 1mm #DDDDDD;background-color: #EEEEEE; padding: 2mm; border-radius: 2mm; width: 100%; }
    ul { width: 95%; list-style-type: square; }
    ul li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
	
  

</style>
    
<page_header> 
        <table width="75%" style="margin:30px;text-align:center;">
        <tr><td style="text-align:center;"><img style="width:300px;display:inline;"  src="../../images/intest.PNG"></td></tr>
        

        </table>
        
	</page_header>

    <table style="margin-left:400px;">
         <tr><td>Roma li,</td><td><?=date("d/m/Y",strtotime($rep['data_ins']))?></td></tr>
    </table>

    <table style="margin-left:400px;">
        <tr><td>Spett.le</td><td ></td><td></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;font-weight:bold;"><?=$user['ragione_sociale']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['indirizzo_impr']?>, <?=$user['civico_impr']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['cap_impr']?> - <?=$user['comune_impr']?> (<?=$user['prov_impr']?>)</td></tr>
        
    </table>
    <table style="margin-top:45px;">
        <tr><td style="text-align:right;">Prot n°</td><td  style="font-weight:bold;"> <?=$rep['prot_RAM']?></td></tr>
        <tr><td style="text-align:right;">Raccomandata via pec all&#39;indirizzo: </td><td  style="font-weight:bold;"> <?=$user['pec_impr']?></td></tr>
    </table>
    <hr style="height:0.1px;">

    <table style="width:70%;margin-right:50mm">
        <tr><td style="font-weight:bold;text-align:justify;vertical-align:top;">Oggetto:</td>
        <td style="width:150mm;font-weight:bold;text-align:justify;"> Contributi ai sensi del D.D. 7 agosto 2020 n.145 per le finalità di cui al D.M.
                                                                        12 maggio 2020 n. 203 - &quot;Incentivi agli investimenti nel settore dell&#39;autotrasporto&quot;.<br>
                                                                        Protocollo Istanza In <?=$rep['prot_RAM']?>/2020 Informativa ai sensi dell'art.10-bis legge 241/90</td>
</tr>
<?php
$prot=0;
$data_prot='01/01/2020';
$data_verb='01/01/2020';
    foreach($dettagli as $dett){

        if($dett['tipo']==1){
            $prot = $dett['descrizione'];
        }
        if($dett['tipo']==2){
            $data_prot = $dett['descrizione'];
        }
        if($dett['tipo']==3){
            $data_verb = $dett['descrizione'];
        }
    }
    ?>
    </table>
    <h5 style="text-align:center">IL DIRETTORE GENERALE</h5>
   
    
    <table>
      
      
        <tr><td style="text-align:justify;">- VISTA la domanda di ammissione al contributo di cui all'oggeto presentata da Codesta impresa e acquisista con protocollo n <?=$prot?> del <?=$data_prot?>;</td></tr>
        <tr><td style="text-align:justify;">- VISTO il verbale di riunione della Commissione, istituita ai sensi dell'art. 12, comma 3, del D.D. 7 agosto 2020 n.145 , tenutasi il giorno <?=$data_verb?>;</td></tr>
                    
    
    
    </table>
    <table>
        <tr><td style="text-align:justify;">ferma restando la permanenza dei requisiti da ammissibilità richiesti dalla normativa vigente, dispone per l'istanza di finanziamento dagli investimenti da Codesta impresa la relativa</td></tr>
    </table>
    <h5 style="text-align:center">IL DIRETTORE GENERALE</h5>
    <table>
        <tr><td style="text-align:justify;">per gli importi di seguito ripartiti secondo le categorie e sottocategorie di investimento di cui agli artt. 1 e 2 D.M. 22 luglio 2019 n. 336:</td></tr>
    </table>


    <table style="border-collapse: collapse;border: 1px solid black;font-size:11px;padding:10px;">
       <tr style="text-align:center;border: 1px solid black;">
        <th style="width:30mm; border: 1px solid black;">Categoria Investimenti</th>
        <th style="width:30mm; border: 1px solid black;">Sotto-Categoria Investimenti</th>
        <th style="width:22mm; border: 1px solid black;">Numero acquisizioni finanziabili</th>
        <th style="width:22mm; border: 1px solid black;">Importo contributi ammessi (€)</th>
        <th style="width:22mm; border: 1px solid black;">Eventuali Maggiorazioni (%)</th>
        <th style="width:22mm; border: 1px solid black;">Importo Totale Contributo (€)</th>

       </tr>
       <tr >
        <td style=" border: 1px solid black;padding:10px;" rowspan="3">Art.1, comma 4, lett a)</td>
        <td style=" border: 1px solid black;padding:10px;">Art.3, comma 2, lett a)</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr>
       <tr>
        <td style="border: 1px solid black;border-left: 0px ;padding:10px;">Art.3, comma 2, lett b)</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr> 
       <tr>
        <td style=" border: 1px solid black;border-left: 0px ;padding:10px;" >Art.3, comma 2, lett c)</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr>              
    



       <tr >
        <td style=" border: 1px solid black;padding:10px;" >Art.1, comma 4, lett b) -a)</td>
        <td style=" border: 1px solid black;padding:10px;">Art.3, comma 3</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr>





       <tr >
        <td style=" border: 1px solid black;padding:10px;" >Art.1, comma 4, lett b) -b)</td>
        <td style=" border: 1px solid black;padding:10px;">Art.3, comma 4</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr>





       <tr >
        <td style=" border: 1px solid black;padding:10px;" rowspan="3">Art.1, comma 4, lett c)</td>
        <td style=" border: 1px solid black;padding:10px;">Art.3, comma 5, lett a)</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr>
       <tr>
        <td style="border: 1px solid black;border-left: 0px ;padding:10px;">Art.3, comma 5, lett b)</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr> 
       <tr>
        <td style=" border: 1px solid black;border-left: 0px ;padding:10px;" >Art.3, comma 5, lett b)</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr> 

       
       <tr >
        <td style=" border: 1px solid black;padding:10px;" >Art.1, comma 4, lett d)</td>
        <td style=" border: 1px solid black;padding:10px;">Art.3, comma 7</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0</td>
        <td style="text-align:right; border: 1px solid black;padding:10px;">0,00</td>
       </tr>
       <tr >
        <td style=" border: 1px solid black;padding:10px;"colspan="5" >Totale Contributo finanziabile (€)</td>
        
        <td style="text-align:right; border: 1px solid black;">0,00</td>
       </tr>
             
    </table>
   
    </page>