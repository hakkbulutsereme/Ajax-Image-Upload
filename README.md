# Ajax-Image-Upload
## Ajax ve PHP ile Fotoğraf Yükleme
Herkese iyi çalışmalar, bu projemizde web sitemizde yada ufak bir projede Ajax ve PHP yardımıyla footoğraf ve resim yükleme yönteminden bahsedeceğim.
Bu proje sayesinde JavaScrit jQuery ile dinamik ve hızlı bir fotoğraf yükleme işlemi yapacak, aynı zamanda seçili fotoğrafımızın anlık görüntüleme işlemini yapacağız.
## Gelelim yapımına;
Projemiz 3 ana dosya üzerinde çalışmakta bunlar; index.php, upload.js ve upload.php 
İndex.php sayfamızda seçili fotoğrafı görüntüleme ve form ile gönderme işlemi yapacağız.
Upload.js ile seçilen fotografı jquery change fonksiyonu ile algılama yaparak ajax ile post etme işlemini barındıracağız
Upload.php dosyasında ise ajax ile post edilen fotoğrafımızı bir dizi işlemden sonra belirtilen dosyaya kaydetme işlemlerini gerçekleşitireceğiz.
İndex.php sayfamız; index sayfasından form içerisinde 4 element bulunuyor Bunlar; input=file, img=fotoğraf arayüzü için, button=submit işlemini başlatmak için.
Ayrıca ilgili işlemin yazı olarak ekrana göndermek için id değeri #text olan div tagımız bulunmakta.
```bash
<form   method="POST"  id="f_ekle" class="wpcf7-form"   enctype="multipart/form-data">
            <div class="col-sm-12">
              <p class=" your-name">
                <input type="file" name="resim" id="imgInp" /><br>
                <i id="check" style="color:green;font-size: 100px;display: block;position: absolute;display: none;" class="fa fa-check"></i>
                <img style="border:1px dotted green;width: 200px; height: auto;" id="temp" src="site.jpg" alt="Fotoğraf seç" />
              </p>
              <div id="text"></div>
            </div>
            <div class="col-sm-12">
              <p class="contact-form-elements"> 
                <button style="text-transform: none;" type="submit"  class=" btn btn-primary ">Ekle</button> 
              </p>
            </div>
            <div class="wpcf7-response-output wpcf7-display-none"></div>
          </form><!-- /.wpcf7-form -->
##Upload.js;
burada öncelikle input=file dosya seçim esnasında değişikliği dinmemiz gerekiyor bunuda id değeri #imgInp ile change fonksiyonunu devreye sokarak readURL() adlı fonksiyonu çağırıyoruz. 
    
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
```
Bu fonksiyonun görevi input ile seçilen fotografın temp dosyasından çağrılarak base64 kodlamasıyla img=src alanına yerleştirmek id değeri #temp olan img tagına yerleştirdik.
Sonraki aşama fotoğrafı submit etmek yani göndermek;
Submit işlemini ekle butonuna basıldığı takdirde id değeri #f_ekle olan form içerisindeki input=file elementimizi ajax ile upload.php sayfasına gönderiyor. Data parametresine formun kendisini new FormData(this) belirterek ve Type parametresini POST olarak tanımlıyoruz.
Son olarak Success parametresini dinleyerek sonucun “ok” olması durumunda index.php sayfasında bir takım uyarılar belirtiyoruz.
```
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
```
## Upload.php;
Upload dosyamızda ajax ile post edilen fotoğrafımızın öncelikle varlığını daha sonra önceden belirlediğimiz formatlar (jpeg,png vs.) olması takdirde işlem dögüsüne devam ediyoruz. Format hatalı ise hata kodunu “format” olarak yazıdrıyoruz.
Format kısmında hata yoksa gönderilen fotoğrafımızın uzantı öncesi adını seo geçersiz karakterlerden arındırarak kendi formatı ile takrar birleşitriyoruz.
Daha sonra yüklenen fotoğrafların aynı dosya olması durumunda, karışıklık olmaması için date güncel tarih ve saat bilgisini fotoğraf adının başına ekleyerek, önceden belirttiğimiz dosya yoluna tarayıcımız tarafından temp klasöründe bekletilen aynı fotoğrafımızı ekliyoruz.
Bu işlemi de```` move_uploaded_file()```` ile gerçekleştiriyoruz.
İşlemin tamamlanması durumunda sonuç olarak “ok” yazdırıyoruz.

```
$whitelist = array('jpg', 'jpeg', 'png', 'gif');//geçerli formatlar
$name      = null;
$error     = 'Resim seçilmedi.';
$resimyol  = 'upload/';//kaydedilecek dosya konumu buradan belirlenir.




if (isset($_FILES)) {

	
	

	if (isset($_FILES['resim']) ) {
		$tmp_name = $_FILES['resim']['tmp_name'];
		$name     = basename($_FILES['resim']['name']);
		$error    = $_FILES['resim']['error'];
		
		if ($error === UPLOAD_ERR_OK) {
			$extension = pathinfo($name, PATHINFO_EXTENSION);

			if (!in_array($extension, $whitelist)) {
				echo 'format';//format desteklemiyor uyarısı
			} else {



	$name1 =  explode('.', $_FILES['resim']['name'],2);//dosyayı iki farklı veri olarak ele alıyoruz


	$name2 = seo($name1[0]);//noktadan önceki veri dosya ismini türkçe karakterden arındırıyoruz.

	$name3 = $name1[1];//noktadan sonraki dosya formatını alıyoruz.

	$name4 = $name2.'.'.$name3;




	$date=date("Ymd_hms"); //tarih ve saat benzersiz bir tanım.

	$benzersizad=$date.$name4;//tarih ve dosyamızın adını birleştiriyoruz.

		if(move_uploaded_file($tmp_name, "$resimyol/$benzersizad")){//bir if sorgusuyla birlikte dosyamızı belitttiğimiz alana yüklüyoruz.


		echo 'ok';//yüklendi
	




	}else {
		echo 'no';
	}

			}
		}
	}else{
		echo 'bos';
	}

}```
