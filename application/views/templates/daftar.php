<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Absensi QR-Code</title>
        <link rel="icon" type="image/ico" href="<?=base_url()?>assets/admin/non-angular/assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/css/animsition.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->

    </head>


    <body id="minovate" class="appWrapper">


        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="<?=base_url()?>assets/admin/non-angular/http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">




            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">WELCOME to </span></h3></div>
                <div class="text-center">
                    <h4 style="color: white;"><span style="font-size: 24px;">e-mulsi: electronic modul farmasi fisika unfari</span></h4>
                </div>
                <form method="POST" action="<?= base_url() ?>register/register">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-white">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Masukan email anda" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-white">Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Masukan nama anda" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-white">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukan password anda" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-white">Ulangi Password</label>
                                            <input type="password" id="UlangiPassword" class="form-control" placeholder="Masukan passowrd anda" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-white">No Telepon</label>
                                            <input type="number" name="notelp" class="form-control" placeholder="Masukan no telepon anda" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-white">Alamat</label>
                                            <textarea name="alamat" class="form-control" placeholder="Masukan alamat anda" required=""></textarea>
                                        </div>
                                    </div>
                                </div> 
                                <br>
                                <br>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <button class="btn btn-greensea b-0 br-2 mr-5" type="submit" id="daftar">DAFTAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
                </form>
            </div>



        </div>
        <!--/ Application Content -->














        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/admin/non-angular/https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/screenfull/screenfull.min.js"></script>
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(() =>
            {
                $('#UlangiPassword').on('change', () =>
                {
                    $('#daftar').removeAttr('disabled')
                    
                    let passwordBaru        = $('#UlangiPassword').val()
                    let passowrdLama        = $('#password').val()

                    if(passwordBaru != passowrdLama)
                    {
                        alert('Password tidak sama')
                        $('#daftar').attr('disabled', 'disabled')
                    }
                })
            })
        </script>
        <!--/ Page Specific Scripts -->





        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

    </body>
</html>
