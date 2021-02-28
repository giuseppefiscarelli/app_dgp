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
    ul { width: 95%; list-style-type: square; }
    ul li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
	
  

</style>
    
    <page_header> 
        <table width="75%" style="margin:30px;text-align:center;">
        <tr><td style="text-align:center;"><img style="width:40px;height:40px;display:inline;"  src="../../images/italia.png"></td></tr>
        <tr><td style="font-style:italic;font-weight: bold;">Ministero delle Infrastrutture e dei Trasporti</td></tr>
        <tr><td>Dipartimento per i trasporti, la Navigazione</td></tr>
        <tr><td>ed i Sistemi Informativi e Statistici</td></tr>
        <tr><td>Direzione Generale per il Trasporto Stradale</td></tr>
        <tr><td>e per lìIntermodalità</td></tr>

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
        <td style="width:150mm;font-weight:bold;text-align:justify;"> Contributi ai sensi del D.D. 11 ottobre 2019 per le finalità di cui al D.M.
            22 luglio 2019 n. 336 - &quot;Incentivi agli investimenti nel settore dell&#39;autotrasporto&quot;.<br>
            Protocollo Istanza In <?=$rep['prot_RAM']?>/2020 Informativa ai sensi dell'art.10-bis legge 241/90</td>
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
   
    
    <table>
      
      
        <tr><td style="text-align:justify;">- VISTA la domanda di ammissione al contributo di cui all'oggeto presentata da Codesta impresa e acquisista con protocollo n <?=$prot?> del <?=$data_prot?>;</td></tr>
        <tr><td style="text-align:justify;">- VISTO il verbale di riunione della Commissione, istituita ai sensi dell'art. 11, comma 3, del D.D. 11 ottobre 2019, tenutasi il giorno <?=$data_verb?>;</td></tr>
        <tr><td style="text-align:justify;">- VISTA la nota prot. n. In/<?=$prot_pre?> del <?=$prot_pre_data?> con la quale è stato dat preavviso di regetto della suddetta istanza di finanziamento;</td></tr>
        <tr><td style="text-align:justify;">- CONSIDERATO che non è pervenuta alcuna risposta alla predetta nota del <?=$campo6?> ;</td></tr>
        <tr><td style="text-align:justify;">- CONSIDERATO che premane la seguente motivazione di inammissibilità: <?=$campo7?> ;</td></tr>
        
                    
    
    
    </table>

    <h5 style="text-align:center">COMINUCA</h5>
    <table>
        <tr><td style="text-align:justify;">a Codesta impresa che il procedimanto amministartivo avviato con l'istanza di ammissione al contributo si è concluso con il</td></tr>
    </table>
    <h5 style="text-align:center">RIGETTO DELLA DOMANDA</h5>
    <table>
        <tr><td style="text-align:justify;">Si comunica altresì che, ai sensi dell'art. 3, comma 4, della legge 7 agosto 1990 n. 241, avverso il presente atto 
        è ammesso ricorso giurisdizionale avantio al competente Tribunale Amministrativo Regionale oppure, in alternativa, ricorso straordinario al Presidente 
        della Republica, rispettivamente entro sessanta e centoventi giorni dal ricevimento dello stesso.</td></tr>
    </table>
    <table style="margin-left:400px;margin-top:50px;text-align:center">
        <tr><td>Il Direttore Generale</td></tr>
        <tr><td>(Dott Vincenzo Cinelli)</td></tr>

    </table>
   
</page>
