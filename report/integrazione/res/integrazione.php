<page pagegroup="new"  style="font-size:14px" backtop="30mm" backleft="15mm" backright="15mm" backbottom="10mm">
	
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

    table.page_header {
    width: 100%; 
    border: none; 
    background-color: #DDDDFF; 
    border-bottom: solid 1mm #AAAADD; 
    padding: 2mm ;
    font-family: 'Times New Roman', Times, serif;
    }
    table.page_footer {
					width: 91%;
					text-align:"center";
                    
                    font-style: normal !important;
                    font-size:10px;
					border: none; 
					color:#548dd4;
					padding: 1mm; 
					margin-left :10mm;
                    margin-bottom:10px;
					}
    div.note {border: solid 1mm #DDDDDD;background-color: #EEEEEE; padding: 2mm; border-radius: 2mm; width: 100%; }
    ul { width: 95%; list-style-type: square; }
    ul li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
	
  

</style>
    <page_footer>
        <table class="page_footer" >
            <tr style="width:100%;margin-left:20mm;">
                <td style="width:60%; text-align: left;">RAM Logistica Infrastrutture e Trasporti Spa</td>
                <td style="width:40%; text-align: left;">Azionista unico Ministero dell Economia e delle Finanze</td>
            </tr>
            <tr style="width:100%;margin-left:20mm">
                <td style="width:60%; text-align: left;">Via Nomentana, 2 00161 Roma</td>
                <td style="width:40%; text-align: left;">Capitale sociale € 1.000.000,00</td>
            </tr>
            <tr style="width:100%;margin-left:20mm">
                <td style="width:60%; text-align: left;">T +39 06 44124461 / F +39 06 44126168</td>
                <td style="width:40%; text-align: left;">Iscritta al Registro delle Imprese di Roma</td>
            </tr>
            <tr style="width:100%;margin-left:20mm">
            <td style="width:60%; text-align: left;">info@ramspa.it</td>
                <td style="width:40%; text-align: left;">P.Iva e C.F 07926631008</td>
            </tr>
           
        </table>
    </page_footer>
    <page_header> 
        <table width="75%" style="margin-top:30px;margin-left:30px;">
            <tr><td><img style="width:180px;display:inline;"  src="../../images/ram_nuovo_logo.png"></td></tr>
            <tr><td style="font-family: 'Times New Roman', Times, serif;text-align:center;">Direttore Operativo</td>
            </tr>

        </table>
        
	</page_header>

    <table >
         <tr><td>Prot n° </td><td  style="font-weight:bold;"><?=$rep['prot_RAM']?></td></tr>
         <tr><td>Roma li,</td><td><?=date("d/m/Y",strtotime($rep['data_ins']))?></td></tr>
    </table>

    <table style="margin-left:300px;">
        <tr><td>Spett.le</td><td ></td><td></td></tr>
        <tr><td></td><td colspan="2" style="width:100mm;justify-content:left;font-weight:bold;"><?=$user['ragione_sociale']?></td></tr>
        <tr><td></td><td colspan="2" style="width:100mm;justify-content:left;"><?=$user['indirizzo_impr']?>, <?=$user['civico_impr']?></td></tr>
        <tr><td></td><td colspan="2" style="width:100mm;justify-content:left;"><?=$user['cap_impr']?> - <?=$user['comune_impr']?> (<?=$user['prov_impr']?>)</td></tr>
    </table>
    <table>   
        <tr><td style="text-align:right;">Raccomandata via pec all&#39;indirizzo: </td><td  style="font-weight:bold;"> <?=$user['pec_impr']?></td></tr>
    </table>

    <table style="width:70%;margin-right:50mm">
        <tr><td style="font-weight:bold;text-align:justify;vertical-align:top;">Oggetto:</td><td style="width:150mm;font-weight:bold;text-align:justify;">Contributi ai sensi del D.D. 7 agosto 2020 n.145 per le finalità di cui al D.M.
                                                                        12 maggio 2020 n. 203 - &quot;Incentivi agli investimenti nel settore dell&#39;autotrasporto&quot;.</td></tr>
    </table>
    <table>
        <tr><td style="text-align:justify;"> In qualità di soggetto attuatore, per conto del Ministero delle Infrastrutture e della Mobilità Sostenibili
            della gestione operativa del decreto in oggetto, Vi comunichiamo che a seguito di verifiche
            effettuate, per poter istruire la Vostra istanza <b>prot. R.A.M. S.p.a. In <?=$rep['id_RAM']?>/<?=$tipo_istanza['anno']?></b> abbiamo
            necessità di ricevere i seguenti chiarimenti e/o documenti:</td></tr>
    </table>

             
    <table>
        <?php
        //var_dump($dettagli);
        foreach($dettagli as $d){?>
        <tr><td style="text-align:justify;font-weight:bold;">- <?=$d['descrizione']?></td></tr>
       <?php
     }?>                
    
    
    </table>
   


    
    <div style="margin-top:10px;">
    <table >
        <tr><td style="text-align:justify;">Pertanto, ai sensi e per gli effetti dell&#39;art. 12, comma 4 del D.D 7 agosto 2020 n.145,
Vi invitiamo a fornirci la suddetta documentazione <b>entro e non oltre il termine perentorio di
quindici giorni</b> decorrenti dalla data di ricezione della presente, accedendo al gestionale
dedicato sul Portale, già utilizzato per la rendicondazione della domanda.
Il Portale sarà abilitato alla modifica dei dati e, all&#39;interno della Sezione &quot;Richieste
integrazioni&quot;, al caricamento dei documenti contenenti le integrazioni richieste.</td></tr>               
</table >
<table >
        <tr><td style="text-align:justify;">Al fine di porre in condizione codesta spett.le impresa di rispettare pienamente quanto
previsto dal decreto in oggetto specificato, si invita quest&#39;ultima a tenere presenti le
seguenti inderogabili disposizioni:</td></tr>

   
    <tr>
        <td style="text-align:justify;width:150mm">
            <ol>
                <li style="text-align:justify;">la documentazione inviata dovrà rispettare scrupolosamente i criteri di sostanza e
di forma richiesti;</li>
                <li style="text-align:justify;">decorso il termine perentorio suindicato, l&#39;istruttoria verrà conclusa sulla sola base
della documentazione valida disponibile, senza che possa in alcun modo avviarsi
qualsiasi, ulteriore fase di interlocuzione.</li>
            </ol>
        </td>
    </tr>
    <tr><td style="text-align:justify;">Per qualsiasi informazione, potrete rivolgerVi al nostro Help Desk Incentivi (e-mail:
incentivoinvestimenti@ramspa.it).
Cordiali saluti</td></tr>
    </table>
    <table style="margin-left:400px;margin-top:30px;">
    
    <tr><td><img style="width:180px;display:inline;"  src="../../images/firma_fb.png"></td></tr>

    </table>
</div>    
</page>
