   <?php    
 $tipi_istanze =getTipiIstanza();
            foreach($tipi_istanze as $ti){
              $params['search3']=$ti['id'];
              $istTotali =countIstanze($params);
              
              $params['search4']='A';
              $totalIstanze= countIstanze($params);

              $params['search4']='C';
              $istRend= countIstanze($params);

              $params['search4']='D';
              $istIstr= countIstanze($params);
              $params['search4']='B';
              $annIstr= countIstanze($params);

              $params['search4']='B';
              $scaIstr= countIstanze($params);



              
require 'card/card1.php';
            }
          /*  $totalIstanze= countIstanze($params);
            $istTotali =countTotIstanze($params);
             $istanze = getIstanze($params);
             $istRend =countRendicontazione(1);
             $istIstr =countRendicontazione(0);*/
?>
   


     