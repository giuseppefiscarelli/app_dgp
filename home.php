<?php
session_start();
require_once 'functions.php';




if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}


/*
require_once 'model/user.php';
$updateUrl = 'userUpdate.php';
$deleteUrl = 'controller/updateUser.php';
*/
require_once 'headerInclude.php';

?>
 <div class="container my-4" style="max-width:95%">
 <?php
    require_once 'controller/displayHome.php';
?>   
        
</div>
     
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>
<script type="text/javascript">
$(document).ready(function() {



var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
      labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu','Lug','Ago','Set','Ott','Nov','Dic'],
      datasets: [{
          label: 'Fondo Residuo (dimostrativo)',
          data: [12000000, 11800000, 11600000, 11000000, 10800000, 10800000,10800000, 10700000, 10700000, 10200000, 10200000, 10000000],
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }]
      }
  }
});


});
</script>
  
</script>

</body>
</html>    