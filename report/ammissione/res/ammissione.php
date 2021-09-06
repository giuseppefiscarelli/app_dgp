<page pagegroup="new"  style="font-size:12px" backtop="mm" backleft="15mm" backright="15mm" backbottom="9mm">
	
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
    

        <table style="width:50%;">
        <tr><td style="text-align:center;"><img style="width:300px;display:inline;"  src="../../images/intest.png"></td></tr>
        

        </table>
        
        
	

    <table>
    <tr><td>Prot n°</td><td  style="font-weight:bold;"> <?=$prot?></td></tr>
    <tr><td>Roma li,</td><td><?=$data_doc?></td></tr>
    </table>

    <table style="margin-left:400px;">
        <tr><td>Spett.le</td><td ></td><td></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;font-weight:bold;"><?=$user['ragione_sociale']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['indirizzo_impr']?>, <?=$user['civico_impr']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['cap_impr']?> - <?=$user['comune_impr']?> (<?=$user['prov_impr']?>)</td></tr>
        
    </table>
    <table style="margin-top:60px;">
      
        <tr><td style="text-align:right;">Raccomandata via pec all&#39;indirizzo: </td><td  style="font-weight:bold;"> <?=$user['pec_impr']?></td></tr>
    </table>
    <table style="width:70%;margin-right:50mm">
        <tr><td style="font-weight:bold;text-align:justify;vertical-align:top;">Oggetto:</td>
        <td style="width:150mm;font-weight:bold;text-align:justify;"> Contributi ai sensi del D.D. 7 agosto 2020 n.145 per le finalità di cui al D.M.
                                                                        12 maggio 2020 n. 203 - &quot;Incentivi agli investimenti nel settore dell&#39;autotrasporto&quot;.<br>
                                                                        Protocollo Istanza In <?=$rep['id_RAM']?>/2020 Informativa ai sensi dell'art.10-bis legge 241/90</td>
</tr>

    </table>
    <h5 style="text-align:center">IL DIRETTORE GENERALE</h5>
   
    
    <table>
      
      
        <tr><td style="text-align:justify;">- VISTA la domanda di ammissione al contributo di cui all'oggeto presentata da Codesta impresa e acquisista con protocollo n <?=$prot_amm?> del <?=$data_prot?>;</td></tr>
        <tr><td style="text-align:justify;">- VISTO il verbale di riunione della Commissione, istituita ai sensi dell'art. 12, comma 3, del D.D. 7 agosto 2020 n.145 , tenutasi il giorno <?=$data_verb?>;</td></tr>
                    
    
    
    </table>
    <table>
        <tr><td style="text-align:justify;">ferma restando la permanenza dei requisiti da ammissibilità richiesti dalla normativa vigente, dispone per l'istanza di finanziamento dagli investimenti da Codesta impresa la relativa</td></tr>
    </table>
    <h5 style="text-align:center">IL DIRETTORE GENERALE</h5>
    <table>
        <tr><td style="text-align:justify;">per gli importi di seguito ripartiti secondo le categorie e sottocategorie di investimento di cui agli artt. 1 e 2 D.M. 22 luglio 2019 n. 336:</td></tr>
    </table>


    <table style="border-collapse: collapse;border: 1px solid black;font-size:11px;padding:3px;">
       <tr style="text-align:center;border: 1px solid black;">
        <th style="width:35mm; border: 1px solid black;">Categoria Investimenti</th>
        <th style="width:35mm; border: 1px solid black;">Sotto-Categoria Investimenti</th>
        <th style="width:22mm; border: 1px solid black;">Numero acquisizioni finanziabili</th>
        <th style="width:25mm; border: 1px solid black;">Importo contributi ammessi (€)</th>
        <th style="width:22mm; border: 1px solid black;">Eventuali Maggiorazioni (%)</th>
        <th style="width:25mm; border: 1px solid black;">Importo Totale Contributo (€)</th>

       </tr>

       <tr >
        <td style=" border: 1px solid black;padding:3px;" rowspan="4">Art.1, comma 5, lett a)</td>
        <td style=" border: 1px solid black;padding:3px;">Art.3, comma 2, lett a)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt2A?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr2A, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi2A+$rete2A?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot2A, 2, ',', '.').' €' ?></td>
       </tr>
       <tr>
        <td style="border: 1px solid black;border-left: 0px ;padding:3px;">Art.3, comma 2, lett b)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt2B?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr2B, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi2B+$rete2B?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot2B, 2, ',', '.').' €' ?></td>
       </tr> 
       <tr>
        <td style=" border: 1px solid black;border-left: 0px ;padding:3px;" >Art.3, comma 2, lett c)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt2C?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr2C, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi2C+$rete2C?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot2C, 2, ',', '.').' €' ?></td>
       </tr>  
       <tr>
        <td style=" border: 1px solid black;border-left: 0px ;padding:3px;" >Art.3, comma 2, lett d)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt2D?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr2D, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi2D+$rete2D?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot2D, 2, ',', '.').' €' ?></td>
       </tr>              
    



       <tr >
        <td style=" border: 1px solid black;padding:3px;" >Art.1, comma 5, lett b) -1)</td>
        <td style=" border: 1px solid black;padding:3px;">Art.3, comma 3</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt3?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr3, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi3+$rete3?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot3, 2, ',', '.').' €' ?></td>
       </tr>





       <tr >
        <td style=" border: 1px solid black;padding:3px;" >Art.1, comma 5, lett b) -2)</td>
        <td style=" border: 1px solid black;padding:3px;">Art.3, comma 4</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt4?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr4, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi4+$rete4?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot4, 2, ',', '.').' €' ?></td>
       </tr>





       <tr >
        <td style=" border: 1px solid black;padding:3px;" rowspan="3">Art.1, comma 5, lett c)</td>
        <td style=" border: 1px solid black;padding:3px;">Art.3, comma 5, lett a)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5A?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr5A, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi5A+$rete5A?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5A, 2, ',', '.').' €' ?></td>
       </tr>
       <tr>
        <td style="border: 1px solid black;border-left: 0px ;padding:3px;">Art.3, comma 5, lett b)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5B?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr5B, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi5B+$rete5B?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5B, 2, ',', '.').' €' ?></td>
       </tr> 
       <tr>
        <td style=" border: 1px solid black;border-left: 0px ;padding:3px;" >Art.3, comma 5, lett c)</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5C?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr5C, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi5C+$rete5C?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5C, 2, ',', '.').' €' ?></td>
       </tr> 

       
       <tr >
        <td style=" border: 1px solid black;padding:3px;" >Art.1, comma 5, lett d)</td>
        <td style=" border: 1px solid black;padding:3px;">Art.3, comma 7</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt7?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($contr7, 2, ',', '.').' €' ?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$pmi7+$rete7?> %</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot7, 2, ',', '.').' €' ?></td>
       </tr>
       <tr >
        <td style=" border: 1px solid black;padding:3px;text-align:right;"colspan="5" >Totale Contributo finanziabile (€)</td>
        
        <td style="text-align:right; border: 1px solid black;;padding:3px;font-weight:bold;"><?=number_format($totFin, 2, ',', '.').' €' ?></td>
       </tr>
             
    </table>
    </page>
    <page pagegroup="new"  style="font-size:14px" backtop="10mm" backleft="15mm" backright="15mm" backbottom="9mm">
    <p style="text-align:justify;">Si comunica altresì che, ai sensi dell’art. 3, comma 4, della legge 7 agosto 1990 n. 241, avverso il presente atto è
    ammesso ricorso giurisdizionale avanti al competente Tribunale Amministrativo Regionale oppure, in alternativa, ricorso
    straordinario al Presidente della Repubblica, rispettivamente entro sessanta e centoventi giorni dal ricevimento dello
    stesso
    </p>
    <p style="text-align:justify;"><b>AVVERTENZE:</b>
    <br>
    Si ricorda che a norma dell’<b>Art. 1 co. 8 del DM 336/2019 i mezzi oggetti di contributo non possono essere alienati,
concessi in locazione o in noleggio e devono rimanere nella piena disponibilità del beneficiario</b> del contributo fino a tutto
il 31 dicembre 2022, pena la revoca del contributo erogato. Non si procede all'erogazione del contributo anche nel
caso di trasferimento della disponibilità dei beni oggetto degli incentivi nel periodo intercorrente fra la data di
presentazione della domanda e la data di pagamento del beneficio.
    </p>
    <p style="text-align:justify;">
    Ai fini della liquidazione del contributo spettante, compatibilmente con la disponibilità di cassa e ad esito favorevole
degli accertamenti di legge, dovrà pervenire - <b>nel termine perentorio di 5 (cinque) giorni dal ricevimento della
presente - l’eventuale nuovo IBAN (soltanto in caso di variazione rispetto a quello dichiarato in sede di istanza).</b>
    </p>
    <p style="text-align:justify;">
    <b>Soltanto in caso di contributo spettante di importo superiore ad euro 150.000,00</b> – essendo necessario acquisire
l’informazione antimafia ai sensi del decreto legislativo n. 159/2011 e successive ii e mm – dovrà essere allegata, entro
15 (quindici) giorni lavorativi dal ricevimento della presente:
<ul>
    <li>l’attestazione dell’iscrizione nella “white list”, prevista dalla legge n. 190/2012 e dal D.P.C.M. del 18 aprile 2013;</li>
    <li>oppure, in mancanza dell’iscrizione di cui sopra, dovrà essere trasmessa da codesta Impresa, la dichiarazione sostitutiva
resa da ognuno dei soggetti di cui all’articolo 85 del decreto legislativo n. 159/2011, recante l’indicazione dei propri
conviventi di maggiore età (con i dati anagrafici e i relativi codici fiscali degli stessi), corredata da copia di un
documento di identità, in corso di validità, del sottoscrittore (vedi modello allegato).</li>
</ul>
    </p>
    <p style="text-align:justify;">
    L’eventuale documentazione di cui sopra dovrà essere trasmessa in <b>un unico file PDF (comprensivo del documento di
identità del legale rappresentante dell’impresa)</b>, tramite posta elettronica certificata all’indirizzo <b>dg.ts-div1@pec.mit.gov.it</b>
    </p>
    <p style="text-align:justify;">
    Per qualsiasi informazione, è a disposizione il servizio Help Desk Incentivi (e-mail: <b>incentivoinvestimenti@ramspa.it</b>)
    </p>
    

    <table style="margin-left:400px;margin-top:10px;">
    
    <tr><td><img style="width:75%;display:inline;"  src="../../images/Firma_resp.png"></td></tr>

    </table>
    </page>