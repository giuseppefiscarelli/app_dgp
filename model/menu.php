<?php


function getNewticket(){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $records = [];

        

        $sql ="SELECT * FROM comunicazioni where read_msg = 0";
       
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;

}
function getNewticketmsg(){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $records = [];

        

        $sql ="SELECT * FROM cron_comunicazioni where read_msg = 0 and role='user'";
       
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;

}