<page pagegroup="new"  style="font-size:12px" backtop="55mm" backleft="15mm" backright="15mm" backbottom="9mm">
	
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

    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm ;
        font-family: TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif; }
    table.page_footer {
					width: 91%;
					text-align:"center";
					border: none; 
					border-top: solid 1mm black; 
					padding: 1mm; 
					margin-left :10mm;
					}
    div.note {border: solid 1mm #DDDDDD;background-color: #EEEEEE; padding: 2mm; border-radius: 2mm; width: 100%; }
    ul { width: 95%; list-style-type: disc; }
    ul li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
	
  

</style>
    
    <page_header> 
    <table style="width:50%;">
        <tr><td style="text-align:center;"><img style="width:300px;display:inline;"  src="../../images/intest.png"></td></tr>
        

        </table>
        
	</page_header>

    <table>
    <tr><td>Roma li,</td><td><?=date("d/m/Y", strtotime($rep['data_prot']))?></td></tr>
    <tr><td>Prot n°</td><td  style="font-weight:bold;"> <?=$rep['prot_RAM']?></td></tr>

    </table>

    <table style="margin-left:400px;">
        <tr><td>Spett.le</td><td ></td><td></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;font-weight:bold;"><?=$user['ragione_sociale']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['indirizzo_impr']?>, <?=$user['civico_impr']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['cap_impr']?> - <?=$user['comune_impr']?> (<?=$user['prov_impr']?>)</td></tr>
        
    </table>
    <table style="margin-top:20px;">
      
        <tr><td style="text-align:right;">Raccomandata via pec all&#39;indirizzo: </td><td  style="font-weight:bold;"> <?=$data_RAM['pec']?></td></tr>
    </table>
    
    <table style="width:70%;margin-right:50mm">
        <tr><td style="font-weight:bold;text-align:justify;vertical-align:top;">Oggetto:</td>
        <td style="width:150mm;font-weight:bold;text-align:justify;"> Contributi ai sensi del D.D. 7 agosto 2020 n.145 per le finalità di cui al D.M.
                                                                        12 maggio 2020 n. 203 - &quot;Incentivi agli investimenti nel settore dell&#39;autotrasporto&quot;.
                                                                        Protocollo Istanza In <?=$rep['id_RAM']?>/<?=$tipo_istanza['anno']?> </td>
                                                                        </tr>

    </table>
    
    <?php
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
        if($dett['tipo']==4){
            $prot_pre = $dett['descrizione'];
        }
        if($dett['tipo']==5){
            $prot_pre_data = $dett['descrizione'];
        }
        if($dett['tipo']==6){
            $campo6 = $dett['descrizione'];
        }
        if($dett['tipo']==7){
            $campo7 = $dett['descrizione'];
        }
       
    }
    ?>
   
    <h5 style="text-align:center">IL DIRETTORE GENERALE</h5>
   
  
    <ul>
        <li style="text-align:justify;">VISTA la domanda di ammissione al contributo di cui all'oggeto presentata da Codesta impresa e acquisista con protocollo n <?=$rep['id_RAM']?>/<?=$tipo_istanza['anno']?> del <?=date("d/m/Y", strtotime($data_RAM['data_invio']))?></li>
        <li style="text-align:justify;">VISTO il verbale di riunione della Commissione, istituita ai sensi dell'art. 12, comma 3, del D.D. 7 agosto 2020, tenutasi il giorno <?=$data_verb?>;</li>
        <li style="text-align:justify;">VISTA la nota prot. n. In/<?=$prot_pre?> del <?=$prot_pre_data?> con la quale è stato dat preavviso di regetto della suddetta istanza di finanziamento;</li>
        <li style="text-align:justify;">CONSIDERATO che non è pervenuta alcuna risposta alla predetta nota del <?=$campo6?> ;</li>
        <li style="text-align:justify;">CONSIDERATO che premane la seguente motivazione di inammissibilità: <br><?=$campo7?> ;</li>
    </ul>

    <h5 style="text-align:center">COMUNICA</h5>
    <table>
        <tr><td style="text-align:justify;">a Codesta impresa che il procedimanto amministartivo avviato con l'istanza di ammissione al contributo si è concluso con il</td></tr>
    </table>
    <h5 style="text-align:center">RIGETTO DELLA DOMANDA</h5>
    <table>
        <tr><td style="text-align:justify;">Si comunica altresì che, ai sensi dell'art. 3, comma 4, della legge 7 agosto 1990 n. 241, avverso il presente atto 
        è ammesso ricorso giurisdizionale avantio al competente Tribunale Amministrativo Regionale oppure, in alternativa, ricorso straordinario al Presidente 
        della Republica, rispettivamente entro sessanta e centoventi giorni dal ricevimento dello stesso.</td></tr>
    </table>
  
    <table style="margin-left:400px;">
    
    <tr><td><img style="width:75%;display:inline;"  src="../../images/firma_resp.png"></td></tr>

    </table>
   
</page>
