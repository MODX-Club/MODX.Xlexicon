<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
  $(function(){
    $.ajax({
      url:'assets/components/xlexicon/connectors/connector.php'
      ,type:'post'
      ,data:{
        pub_action:'dictionary/getfield'
        ,res:5
        ,field:'pagetitle'
        ,cultureKey:'[[!++cultureKey]]'
      }  
    })
    return false;
  })
</script>