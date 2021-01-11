    
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#temp').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
};

jQuery("#imgInp").on("change",function() {
  readURL(this);//fonksiyonu çalıştır.
  jQuery("#check").css("display","none");
  jQuery("#text").css("display","none");
});



jQuery("#f_ekle").on("submit", function(e){
 jQuery("#text").css("display","block");
 e.preventDefault();

 jQuery.ajax({
   url  : "upload.php",
   type : "POST",
   data : new FormData(this),
   contentType : false,
   processData : false,

   success: function(cevap){
     if (jQuery.trim(cevap) == "ok") {

      jQuery("#text").html('<div  class="alert alert-info alert-dismissable">Ekledi</div>');
      jQuery("#check").css("display","block");


    }else if(jQuery.trim(cevap) == "format"){

     jQuery("#text").html('<div  class="alert alert-info alert-dismissable">Format Hata!</div>');

   }else if(jQuery.trim(cevap) == "bos"){
    
     jQuery("#text").html('<div  class="alert alert-info alert-dismissable">Resim Seç!</div>');
   }
 }
});
});