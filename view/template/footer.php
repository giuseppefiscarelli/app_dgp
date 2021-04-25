<!-- JS -->

<script type="text/javascript">
        $(document).ready(function() {
           $('#message').delay(3000).fadeOut();
          
        });
        $(window).on( 'scroll', function(){
            var team = $('#header_menu').offset().top;
            if ($(window).scrollTop() >= team) {
            $('#li_logo').show()
            }else{
            $('#li_logo').hide()
            } 
        });
        var myVar= $('[id^=nav-vertical-tab-bg]').find("active")
       
  


</script>        