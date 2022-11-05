<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title; ?></title>
  </head>
  <body>
    <!-- navbar -->
    <?= $this->include('layout/navbar'); ?>
  <div class="container">

    <?= $this->renderSection('content'); ?>

  </div>
  <script>
    function previewImg(){
      const sampul = document.querySelector('#sampul');
      const imagePreview = document.querySelector('.img-preview');
      // const sampulLabel = document.querySelector('.custom-file-label');
  
      // sampulLabel.textContent = sampul.files[0].name;
      const fileSampul = new FileReader();
      fileSampul.readAsDataURL(sampul.files[0]);
      fileSampul.onload = function(e){
        imagePreview.src = e.target.result
      }
    }


  </script>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>