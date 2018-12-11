<!DOCTYPE html>
<html lang="en">

<head>
    <title>LogTranSawit</title>
    <link rel="icon" href="logoa.png"/>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>

    <link href="slider/js-image-slider.css" rel="stylesheet"/>

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="css/960.css" />    
    <script src="slider/js-image-slider.js" type="text/javascript"></script>
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->

    <nav class="navbar navbar-custom navbar-fixed-top" style="padding-top:0%;" role="navigation">
        <div class="garisitem container ">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <img src="logo2.png" width="150" height="70" />     
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse ">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="teksmenu">
                        <a href="<?php echo e(route('home')); ?>">Beranda</a>
                    </li>
                    
                    <li class="  teksmenu">
                        <a href="<?php echo e(route('login.register')); ?>" title="Silahkan Pilih untuk Reservasi Kamar">Daftar</a>
                    </li>
                    
                    <li class="  teksmenu">
                        <a href="<?php echo e(route('login.home')); ?>">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        
        
    <div class="container_16">
        
        <header class="intro layeratas turundikit">
            <div class="layeratas">
                        <h1 class=" ">
                             SELAMAT DATANG
                        </h1>
                        <p class="intro-text" style="font-weight:bold;font-size:45%;">Di LogTranSawit</p>
            </div>
        </header>   
            
    </div>
    </nav>

    <div id="sliderFrame">
        <div id="slider">
            <img src="kebun.jpg" />
            <img src="kebun2.jpg" />
            <img src="kebun3.jpg" />
            <img src="kebun4.jpg" />
        </div>
        <div style="text-align:center;padding:20px;z-index:20;">
            <a onclick="imageSlider.previous()" class="group2-Prev"></a>
            <a id='auto' onclick="switchAutoAdvance()"></a>
            <a onclick="imageSlider.next()" class="group2-Next"></a>
        </div>
    </div>

   
    <script type="text/javascript">
        //The following script is for the group 2 navigation buttons.
        function switchAutoAdvance() {
            imageSlider.switchAuto();
            switchPlayPauseClass();
        }
        function switchPlayPauseClass() {
            var auto = document.getElementById('auto');
            var isAutoPlay = imageSlider.getAuto();
            auto.className = isAutoPlay ? "group2-Pause" : "group2-Play";
            auto.title = isAutoPlay ? "Pause" : "Play";
        }
        switchPlayPauseClass();
    </script>
<div class="footer">
    <p>COPYRIGHT 2018 - LogTranSawit<br/>
</div>

</body>

</html>
