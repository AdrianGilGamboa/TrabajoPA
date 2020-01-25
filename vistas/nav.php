<?php
include_once ("../CRUD/CRUDSeccion.php");
$secciones = readAllSeccion();
?>
<link href="css.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<nav class="main-menu">
    <div class="settings"></div>
    <div class="scrollbar" id="style-1">

        <ul>

            <li>                                   
                <a href="portada.php">
                    <i class="fa fa-home fa-lg"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>   

            <li>                                 
                <a href="inicioSesion.php">
                    <i class="fa fa-user fa-lg"></i>
                    <span class="nav-text">Login</span>
                </a>
            </li>   


            <li>                                 
                <a href="cuenta.php">
                    <i class="fa fa-envelope-o fa-lg"></i>
                    <span class="nav-text">Contact</span>
                </a>
            </li>   



            <li>
                <a href="http://startific.com">
                    <i class="fa fa-heart-o fa-lg"></i>

                    <span class="share"> 


                        <div class="addthis_default_style addthis_32x32_style">

                            <div style="position:absolute;
                                 margin-left: 56px;top:3px;"> 




                                <a href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank" class="share-popup"><img src="http://icons.iconarchive.com/icons/danleech/simple/512/facebook-icon.png" width="30px" height="30px"></a>

                                <a href="https://twitter.com/share" target="_blank" class="share-popup"><img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/512/Twitter_alt.png" width="30px" height="30px"></a>

                                <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=_URL_&title=_TITLE_
                                   " target="_blank" class="share-popup"><img src="http://icons.iconarchive.com/icons/danleech/simple/512/google-plus-icon.png" width="30px" height="30px"></a>   



                            </div>
                            <script type="text/javascript">var addthis_config = {"data_track_addressbar": true};</script>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ff17589278d8b3a"></script>





                    </span>
                    <span class="twitter"></span>
                    <span class="google"></span>
                    <span class="fb-like">  
                        <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fstartific&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>

                    </span>
                    <span class="nav-text">
                    </span>

                </a>

            </li>



            <ul>
                <?php
                foreach ($secciones as $seccion) {
                    ?>
                    <li class="darkerlishadow">
                        <i class="fa fa-book fa-lg"></i>
                        <span class="nav-text"><a href="seccion.php?idSeccion=<?php echo $seccion['idSeccion']; ?>"><?php echo $seccion['categoria']; ?></a></span>                            
                    </li>
                    <?php
                }
                ?>
            </ul>
            <li>
                <a href="registro.php">
                    <i class="fa fa-question-circle fa-lg"></i>
                    <span class="nav-text">REGISTER</span>
                </a>
            </li>   


            <ul class="logout">
                <li>
                    <a href="logout.php">
                        <i class="fa fa-lightbulb-o fa-lg"></i>
                        <span class="nav-text">
                            LOGOUT
                        </span>
                    </a>
                </li>  
            </ul>

            </nav>