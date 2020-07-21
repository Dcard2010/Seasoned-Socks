<?php 
    session_start();
    //set_include_path('phpFiles');
    ini_set("include_path", '/home3/dcard2010/php:' . ini_get("include_path") );
    ini_set("include_path", '/home3/dcard2010/phpFiles:' . ini_get("include_path") );
    ini_set('display_error', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('America/Los_Angeles');
    //Debugging
    ob_start();

    include ("connect.php");

    $config = parse_ini_file('config.ini.php');

    $db = new Db();

    $error = $db -> error();

    if ($_POST) {
        $mysqli = new mysqli("localhost", $config['username'], $config['password'], $config['dbname']);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        
        if (!($stmt = $mysqli->prepare("INSERT INTO note (note) VALUES (?)"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        
        $note = $_POST['note'];
        
        if (!$stmt->bind_param("s", $note)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        
        $id = $mysqli->insert_id; //Variable to hold the value of the last id from the last inserted info into the database
        
        echo "Note contents: ";
        var_dump($note);
        echo "THE DATE: ";
        var_dump($time);
        echo "LAST ID: ";
        var_dump($id);
        //INSERT INTO table_name (column1,column2, ...) VALUES (value1, value2, ...)
        //INSERT INTO table_name (column1,column2, ...) VALUES (" . $variable . ")
        //$insert = $db -> query("INSERT INTO note (note, email) VALUES (" . $note . ", " . $email . ")");
        
    }

        unset($db);
        
        /* Variable dumping */
        //var_dump($_POST);
        //var_dump($insert);
        //var_dump($error);
        //echo $_SESSION[note];
        $data = ob_get_clean();
        $fp = fopen("result.txt", "w");
        fwrite($fp, $data);
        fclose($fp);
        
?>

<!DOCTYPE html>

<html lang="en">
    
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
      
    <link rel="stylesheet" href="https://seasonedsocks.com/css/slideshow.css"> 
      
    <link rel="stylesheet" href="https://seasonedsocks.com/css/slide-menu.css"> 
      
    <link rel="stylesheet" href="https://seasonedsocks.com/css/main.css">
    
    <link rel="stylesheet" href="https://seasonedsocks.com/css/include.css">
      
    <script src="https://seasonedsocks.com/js/slidemenu.js"></script>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</head>

<style type="text/css">
    
    .content-wrapper {
        padding-top: 46px;
    }

    .content {
    overflow: hidden;
    margin: 0 auto;
    }
    
    .navbar-right-link {
        display: none !important;
    }
    
    
    .left-half-container {
        float: left;
        display: table;
        width: 50%;
        margin: 3% 0 0 5%;
    }
    
    .left-half {
        height: 785px;
        /*display: table-cell;*/
        vertical-align: middle;
    }

    #top-pics-left {
        border: solid;
        height: 255px;
        width: 49%;
        float: left;
        margin-right: 1%;
    }
    
    #top-pics-left img {
        width: 100%;
        height: 250px
    }
    
    #top-pics-right {
        border: solid;
        height: 255px;
        width: 49%;
        float: left;
        margin-left: 1%;
    }
    
    #top-pics-right img {
        width: 100%;
        height: 250px;
    }
    
     #bottom-pic {
        border: solid;
        margin-top: 2%;
        background: url(https://seasonedsocks.com/img/crumpled-note-crop.png);
    }
    
    #bottom-pic img {
        width: 100%;
        height: 512px;
    }
    
    .break {
        clear: both;
    }
    
    .right-half-container {
        float: right;
        width: 44%
    }
    
    .right-half {
        display: block;
        margin: 0 auto;
    }
    
    #order-box {
        text-align: center;
    }
    
    #order-box-title {
        margin-top: 5%;
        font-size: 1.3rem;
    }
    
    #order-box-price {
        font-size: 1.2rem;
    }
    
    #order-box-text-limit {
        margin-bottom: 0;
        margin-top: 2%;
        font-size: .9em;
    }
    
    hr {
        width: 50%;
        background-color: black;
        margin-bottom: 2%;
    }
    
    #divNote {
        background-image: url(https://seasonedsocks.com/img/post-it2.png);
        background-repeat: no-repeat;
        width: 400px;
        margin: 0 auto;
        margin-top: 10%;
        height: 257px;
    }
    
    textarea {
        resize: none;
        height: 200px;
        margin-top: 4%;
        background: transparent;
        border: none;
        outline: none;
    }
    
    #save {
        font-weight: bold;
        color: red;
        text-align: left;
        width: 80%;
        margin: 0 auto;
        margin-top: 4%;
    }
    
    .hide {
        display: none;
    }
    
    #save p {
        margin-bottom: 0;
    }
    
    #paypal {
        padding-top: 10%;
        margin: 0 auto;
        width: 19%;
    }
    
    #button-add-to-cart {
        margin: 3% 12% 2% 0;
        border:none; 
        padding:0!important;
        font-size: 1.2em;
        cursor: pointer;
        width: 61px;
        border-radius: 5px;
        color: white;
        background-color: #0048FF;
        float: right;
    }
    
    #continue {
        border:none; 
        padding:0!important;
        font-size: 1.2em;
        cursor: pointer;
        width: 101px;
        border-radius: 5px;
        color: white;
        background-color: #0048FF;
        height: 40px;
    }
    
        @media (max-width: 1200px) {
            .right-half-container {
                width: auto;
            }
            
            .left-half-container {
                padding-top: 5%;
                width: auto;
            }
            
            .break {
                display: none;
            }
            .left-half {
                width: 70%;
                margin: 0 auto;
                height: auto;
            }
            
            #bottom-pic {
                width: 100%;
                display: inline-block;
            }
            
            #bottom-pic img {
                height: 425px;
            }
            
            #divNote {
                margin-top: 4%;
            }

            .container {
                width: 100%;
            }

            .navbar {
                width: 100%;
                padding: .1rem 0;
            }

            .content-wrapper {
                width: 100%;
                padding-top: 0;
            }

            #content {
                width: 553px;
            }

}

/* screw writing importants, just stick it in max width since these classes are not shared between sizes */
    @media (max-width:767px) { 
        .left-half-container {
            margin-left: 1%;
        }
        
        .right-half-container {
            width: 100%;
        }
        
        .left-half {
            width: 90%;
        }
        
        .left-half div {
            width: 100%;
            margin-top: 8%;
        }
        
         #top-pics-left {
            height: 176px;
        }
        
        #top-pics-left img {
            height: 170px;
        }
        
         #top-pics-right {
            height: 176px;
        }
        
        #top-pics-right img {
            height: 170px;
        }
        
        #bottom-pic img {
            height: 325px;
        }
    
        #divNote {
            position: relative;
            right: 14px;
            width: 380px;
        }

        #note {
            width: 80%;
            background-color: #FFD52D;
            background-image: none;
            height: auto;
        }

        #button-add-to-cart {
            margin: 3% 7% 4% 6%;
        }

        #slide-nav .container {
            margin: 0!important;
            padding: 0!important;
          height:100%;
        }
        #slide-nav .navbar-header {
            margin: 0 auto;
            padding: 0 15px;
        }
        #slide-nav .navbar.slide-active {
            position: absolute;
            width: 80%;
            top: -1px;
            z-index: 1000;
        }
        #slide-nav #slidemenu {
            background: #f7f7f7;
            left: -100%;
            width: 40%;
            min-width: 0;
            position: absolute;
            padding-left: 0;
            z-index: 2;
            top: -8px;
            margin: 0;
        }

        #slide-nav #slidemenu .navbar-nav {
            min-width: 0;
            width: 100%;
            margin: 0;
        }
        #slide-nav #slidemenu .navbar-nav .dropdown-menu li a {
            min-width: 0;
            width: 80%;
            white-space: normal;
        }
        #slide-nav {
            border-top: 0
        }
        #slide-nav.navbar-inverse #slidemenu {
            background: #333
        }

        .navbar-right-link {
            float: none !important;
            padding: 0 !important;
        }

        .navbar-right-link a {
            display: block;
            padding: 14px;
            font-size: 1.1rem;
        }

        .navbar-nav li {
            float: none;
            text-align: center;
            padding: 15px 0;
            display: block;
        }

        .navbar-nav li a {
            display: block;
        }

        /* this is behind the navigation but the navigation is not inside it so that the navigation is accessible and scrolls*/
        #navbar-height-col {
            position: fixed;
            top: 0;
            height: 100%;
          bottom:0;
            width: 80%;
            left: -80%;
            background: #f7f7f7;
        }
        #navbar-height-col.inverse {
            background: #333;
            z-index: 1;
            border: 0;
        }
        #slide-nav .navbar-form {
            width: 100%;
            margin: 8px 0;
            text-align: center;
            overflow: hidden;
            /*fast clearfixer*/
        }
        #slide-nav .navbar-form .form-control {
            text-align: center
        }
        #slide-nav .navbar-form .btn {
            width: 100%
        }
        .navbar-toggle {
            margin: 5px 10px 0 0 !important;
        }
}
        @media (min-width:768px) { 
        #page-content {
            left: 0!important
        }
        .navbar.navbar-fixed-top.slide-active {
            position: fixed
        }
        .navbar-header {
            left: 0!important
        }

        .navbar-toggle {
            display: none;
        }

 }
        @media (max-width:320px) {
            textarea {
                position: relative;
                left: 20px
            }
            
            #divNote {
                width: 97%;
            }
            
            #save {
                margin-top: 5%;
            }
            
            #button-add-to-cart {
                margin: 5% 0 0 0; 
            }
}
    
</style>
    
<body>
    
    <body data-spy="scroll" data-target=".navbar" data-offset="50">
         <div class="navbar navbar-fixed-top" role="navigation" id="slide-nav">
              <div class="container-fluid">
               <div class="navbar-header">
                <a class="navbar-toggle"> 
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                 </a>
                <a class="navbar-brand" href="index.html"><img src="https://seasonedsocks.com/img/sock.png" id="sock">Seasoned Socks</a>
               </div>

               <div id="slidemenu">
                 <!--
                      <form class="navbar-form navbar-right" role="form">
                        <div class="form-group">
                          <input type="search" placeholder="search" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                      </form>
                 -->
                <ul class="nav navbar-nav">
                 <li><a href="index.html">Home</a></li>    
                 <li><a href="about.html">About</a></li>
                 <li><a href="contact.html">Contact</a></li>
                 <li><a href="shop.html">Shop</a></li>
                 <li class="navbar-right-link"><a class="btn btn-primary btn-sm" href="buy.php">Buy</a></li>
                </ul>

               </div>
              </div>
            </div>
        
        <div class="clear"></div>
        
        <div class="content-wrapper">
            <div class="content">
                <div class="left-half-container">
                    <div class="left-half">
                        <div id="top-pics-left">
                            <a href="https://seasonedsocks.com/img/sock-note.jpg"><img src="https://seasonedsocks.com/img/sock-note.jpg"></a>
                        </div>
                        <div id="top-pics-right">
                            <a href="https://seasonedsocks.com/img/seasoned-sock.jpg"><img src="https://seasonedsocks.com/img/seasoned-sock.jpg"></a>
                        </div>
                        <div class="break"></div>
                        <div id="bottom-pic">
                            <a href="https://seasonedsocks.com/img/crumpled-not-crop.png"><img src="https://seasonedsocks.com/img/crumpled-not-crop.png"></a>
                        </div>
                    </div>
                </div>

                <div class="right-half-container">
                    <div class="right-half">
                        <div id="order-box">
                            <p id="order-box-title">Personalize Your Seasoned Sock</p>
                            <hr>
                            <p id="order-box-price">$9.99 + Shipping</p>
                            <div style="text-align: left; width: 60%; margin: 0 auto; display: block">
                                <!--<p>Send a seasoned sock with your personlaized note inside to whoever you want in the U.S!</p>-->
                                <p>To order a seasoned sock:</p>
                                <ol style="padding-left: 5%">
                                    <li>Write your note below</li>
                                    <li>Click Save</li>
                                    <iframe name="garbage" style="display:none;"></iframe>
                                    <form method="post" id="form-validate" target="garbage">
                                        <fieldset>
                                            <!--<li>Enter your email: <input type="email" name="email" id="email" required></li> -->
                                            <li>Enter <span style="font-weight: bold">your email address</span> and the <span style="font-weight: bold">recipients shipping address</span> on the checkout page and finish your purchase</li>
                                </ol>
                            </div>
                            <div id="divNote">
                                <p id="order-box-text-limit">Please limit note to 130 characters</p>
                                
                                    <textarea maxlength="130" type="text" name="note" id="note-contents"></textarea>
                                <div class="clear"></div>
                                <div id="save" class="hide"><p>If you don't click Save your note will not be saved!</p></div>
                                    <button type="submit" id="button-add-to-cart">Save</button>
                                </fieldset>
                                </form>
                            </div>                                
                            <!--Sandbox
                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="EBBNTFSQVJH2A">
                                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>-->
                            
                            <!--Changed the successful paymen return url    
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="ZKLAUTSW9C2HJ">
                                <input type="image" src="http://seasonedsocks.com/img/button.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>
                            -->
                            
                            <!--
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="CLKVQ4QJURWXE">
                            <input type="hidden" name="business" value="EZBUFKHRZ6YQJ">
                            <input type="hidden" name="item_name" value="Seasoned Sock">
                            <!--<input type="hidden" name="item_number" value="[% orderid %]">
                            <input type="hidden" name="custom" value="[% hash %]">
                            <input type="hidden" name="invoice" value="[% orderid %]">
                            <input type="hidden" name="rm" value="2">
                            <input type="hidden" name="amount" value="9.99">
                            <!--<input type="hidden" name="shipping" value="[% shipping | format '%3.2f' %]">
                            <input type="hidden" name="tax" value="[% tax | format '%3.2f' %]">
                            <input type="hidden" name="page_style" value="HDI">
                            <input type="hidden" name="no_note" value="1">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="bn" value="PP-ShopCartBF">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="cancel_return" value="https://seasonedsocks.com">
                            <input type="image" src="https://seasonedsocks.com/img/button.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                                    
                            -->
                            <div class="clear"></div>
                            <form action="https://seasonedsocks.com/review.php">
                                <input type="submit" value="Continue" id="continue" class="hide">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer"></div>
        </div>
        
        <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <script type="text/javascript">
            
            $(function(){
            $(".footer").load("footer.html");
        })
            
            $("#note-contents").keypress(function() {
                $("#save").removeClass("hide");
            })
            
            $("#button-add-to-cart").click(function() {
                $("#continue").removeClass("hide");  
            })
            
            // Auto validates form elements e.g. email
            $('#form-validate').validate();
            
            $(document).ready(function () {
                
                //stick in the fixed 100% height behind the navbar but don't wrap it
                $('#slide-nav.navbar-inverse').after($('<div class="inverse" id="navbar-height-col"></div>'));

                $('#slide-nav.navbar-default').after($('<div id="navbar-height-col"></div>'));  

                // Enter your ids or classes
                var toggler = '.navbar-toggle';
                var pagewrapper = '#page-content';
                var navigationwrapper = '.navbar-header';
                var menuwidth = '100%'; // the menu inside the slide menu itself
                var slidewidth = '40%';
                var menuneg = '-100%';
                var slideneg = '-80%';


                $("#slide-nav").on("click", toggler, function (e) {

                    var selected = $(this).hasClass('slide-active');

                    $('#slidemenu').stop().animate({
                        left: selected ? menuneg : '0px'
                    });

                    $('#navbar-height-col').stop().animate({
                        left: selected ? slideneg : '0px'
                    });

                    $(pagewrapper).stop().animate({
                        left: selected ? '0px' : slidewidth
                    });

                    $(navigationwrapper).stop().animate({
                        left: selected ? '0px' : slidewidth
                    });


                    $(this).toggleClass('slide-active', !selected);
                    $('#slidemenu').toggleClass('slide-active');


                    $('#page-content, .navbar, body, .navbar-header').toggleClass('slide-active');


                });


                var selected = '#slidemenu, #page-content, body, .navbar, .navbar-header';


                $(window).on("resize", function () {

                    if ($(window).width() > 767 && $('.navbar-toggle').is(':hidden')) {
                        $(selected).removeClass('slide-active');
                    }

                });

            });
            
        </script>
</body>    