
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 



  <title>MYSQL Veritabanı Yönetim Sistemi</title>
  <style type="text/css">

    a,button,  i{
      color:white;
    }
    .box-primary{
      background: #eeefee;
      padding: 10px;
      margin: 10px 0 10px 0;
    }

  </style>

</head>
<body>  <div class="container">

 <section class="content-header">

  <ol class="breadcrumb">

    <li class="active">Fotoğraf Yükleme</li>
  </ol>
</section>

<!-- Main content -->








<section class="content">





  <div class="row">

    <div class="col-md-12">



     <div class="card mb-5">
      <div class="card-header">
        Ajax + Php Fotoğraf Yükleme Sistemi
      </div>

      <div class="card-body">

        <div class="fotograf col-sm-8 section-details">
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
        </div>





        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->

<!-- /.row -->
</section>




<script type="text/javascript" src="upload.js" ></script>

</body>
</html>
