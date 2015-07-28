<html lang="en">

<head>

    <?php include_once("/includes/header.php"); ?>
    <link rel="stylesheet" href="/Demo_Gallery/css/bootstrap-lightbox.min.css">

    <link rel="stylesheet" href="/Demo_Gallery/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

</head>

<body>

    <?php require_once("/includes/config/db.php");
          require_once("/login/classes/Login.php"); 
          $login = new Login();
          include_once("/includes/nav.php"); ?>

    <?php
        require("/includes/querys.php");
        require("/includes/resize.php");

        //require_once("includes/login/Login.php"); 

        $query_obj = new Querys;
        //$login = new Login();


        $responce = $query_obj->get_images_path();
     ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <img src="">
            <div class="col-lg-12">
                <h1 class="page-header foo-head" id="encab-up">Gallery</h1>
            </div>
            <?php 
            foreach ($responce as $data){
                echo('<div class="col-lg-3 col-md-4 col-xs-6 thumb lightbox-content contendor_imagen" id="contendor_imagen">');
                        echo("<a 'class=thumbnail' href='".$data['image_url']."' rel='prettyPhoto[gallery2]'>");
                        echo("<img class='img-responsive' src='".$data['thumb_url']."' alt=''></a>");
                        
                        if ($login->isUserLoggedIn() == true) {
                            echo('<div class="lightbox-caption record" id="record-'.$data['id'].'">
                                    <a class="delete" href="?data_id='.$data['id'].'">Delete</a>
                                </div> ');
                        }
                        //<!-- <div class="lightbox-caption"><p>Your caption here</p></div> -->
                    //<!-- </a> -->
                echo('</div>');
            } ?>
            
        </div>

    <?php include_once("/includes/footer.php"); ?>
    <script src="/Demo_Gallery/js/bootstrap.min.js"></script>

    <script src="/Demo_Gallery/js/jquery.1.9.0.min.js" type="text/javascript"></script>
    <script src="/Demo_Gallery/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto();
      });
    </script>
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('a.delete').click(function(e) {
            e.preventDefault();
            var parent = $(this).parent();
            var parent_ = $(this).parent().parent();
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    type: 'get',
                    url: 'delete.php',
                    data: 'data_id=' + parent.attr('id').replace('record-',''),
                    beforeSend: function() {
                        parent_.animate({'backgroundColor':'#fb6c6c'},300);
                        parent.animate({'backgroundColor':'#fb6c6c'},300);
                    },
                    success: function() {
                        parent_.slideUp(300,function() {
                            parent.remove();
                        });
                        parent.slideUp(300,function() {
                            parent.remove();
                        });
                    }
                    });
            }
        });
    });
    </script>
</body>

</html>
