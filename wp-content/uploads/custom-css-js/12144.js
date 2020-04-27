<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function( $ ){
  
var today = new Date();
 
  
   $('input#billing_wooccm12.input-text').attr("min", "09:00").attr("max","18:00");
    var b = $('#billing_wooccm11') ;
  var month;
  var day;
  if(today.getMonth()+1 < 10){
    month = '0'+(today.getMonth()+1);
  }else{
    month = (today.getMonth()+1);
  }
  if(today.getDate() < 10){
    day = '0'+today.getDate();
  }else{
    day = today.getDate();
  }
  	 b.attr('value', today.getFullYear()+'-'+month+'-'+day);
     b.attr('min', today.getFullYear()+'-'+month+'-'+day);
	 b.attr('max', (today.getFullYear()+1)+'-'+month+'-'+day);
});
</script>
<!-- end Simple Custom CSS and JS -->
