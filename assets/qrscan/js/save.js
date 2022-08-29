$(document).ready(function(){
  $("#app").load(function(){
  function autoSave()  
  {  
       var scan_pic = [document.getElementById("hasilscan")];
       
       if(scan_pic != '')  
       {  
            $.ajax({  
                 url:"save_scan.php",  
                 method:"POST",  
                 data:{postScan:scan_pic},  
                 dataType:"text",  
                 success:function(data)  
                 {   
                  $('#autoSave').text("Post save as draft");  
                  setInterval(function(){  
                    $('#autoSave').text('');  
                  }, 100);  
                 }  
            });  
       }            
  }  
  setInterval(function(){   
   autoSave();   
   }, 100);
  });
});
