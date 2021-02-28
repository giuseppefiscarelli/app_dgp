<?php
  function getLog(){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $records = [];
        $sql = 'SELECT * FROM log';
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }
        }
    return $records;

}
  