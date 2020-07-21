<?php 
    session_start();
    ini_set("include_path", '/home3/dcard2010/php:' . ini_get("include_path") );
    ini_set("include_path", '/home3/dcard2010/phpFiles:' . ini_get("include_path") );
    ini_set('display_error', 0);
    ini_set('display_startup_errors', 0);
    //error_reporting(E_ALL);

    //Debugging
    ob_start();

    include ("connect.php");

    $config = parse_ini_file('config.ini.php');

    $db = new Db();

    $error = $db -> error();

    $mysqli = new mysqli("localhost", $config['username'], $config['password'], $config['dbname']);

    //$id = $mysqli->insert_id;

    //$sql = "SELECT note FROM note WHERE orderID='" . $id . "'";
    $sql = "SELECT note, orderID FROM note ORDER BY orderID DESC LIMIT 1";
    $note = $mysqli->query($sql);

    /*
    $note = $db -> quote($_POST['note']);
    $email = $db -> quote($_POST['email']);
    */
    
    echo "Sql: ";
    var_dump($sql);
    echo "Note contents: ";
    var_dump($note);
    echo "LAST ID: ";
    var_dump($id);
    //INSERT INTO table_name (column1,column2, ...) VALUES (value1, value2, ...)
    //INSERT INTO table_name (column1,column2, ...) VALUES (" . $variable . ")
    //$insert = $db -> query("INSERT INTO note (note, email) VALUES (" . $note . ", " . $email . ")");



    unset($db);

    /* Variable dumping */
    //var_dump($_POST);
    //var_dump($insert);
    //var_dump($error);
    //echo $_SESSION[note];
    $data = ob_get_clean();
    $fp = fopen("review.txt", "w");
    fwrite($fp, $data);
    fclose($fp);

?>

<!DOCTYPE html>

<html lang="en">
    
<head>
    <!-- Required meta tags always come first -->
    <title>Seasoned Socks - Review Your Note</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
      
    <link rel="stylesheet" href="css/slideshow.css"> 
      
    <link rel="stylesheet" href="css/slide-menu.css"> 
      
    <link rel="stylesheet" href="css/main.css">
    
    <link rel="stylesheet" href="css/include.css">
      
    <script src="js/slidemenu.js"></script>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</head>

<style type="text/css">
    
    .content {
        overflow: hidden;
        width: 829px;
        margin: 0 auto; 
    }

    .info {
        padding: 8% 0 2% 0;
    }
    
    #note-header {
        text-align: center;
    }
    
    #divNote {
        background-image: url(img/post-it2.png);
        background-repeat: no-repeat;
        background-size: contain;
        width: 351px;
        margin: 0 auto;
        height: 257px;
    }
    
    textarea {
        resize: none;
        height: 200px;
        margin: 8% 0 0 10%;
        background: transparent;
        border: none;
        outline: none;
        width: 80%;
    }
    
    #bottom-buttons {
        margin: 0 auto;
        width: 35%;
        height: 40px;
    }
    
    #left-half {
        width: 50%;
        float: left;
    }
    
    #right-half {
        width: 50%;
        float: right;
    }
    
    #paypal {
        float: right;
        margin-right: 8%;
    }
    
    #goback {
        border:none; 
        padding:0!important;
        font-size: 1em;
        cursor: pointer;
        width: 97px;
        border-radius: 5px;
        color: white;
        background-color: #0048FF;
        height: 40px;
    }
    
    #bottom-buttons form {
        width: 100%;
    }

    #bottom-buttons p {
        float: left;
        margin-right: 2%;
        margin-top: 2%;
    }

        @media (max-width: 1200px) {

            .container {
                width: 100%;
            }

            .navbar {
                width: 100%;
                padding: .1rem 0;
            }

            .content-wrapper {
                width: 100%;
            }    

        }

        @media (max-width: 850px) {
            .content {
                padding-top: 2%;
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            #bottom-buttons {
                width: 38%;
            }   
        }
    
        @media (max-width: 600px) {
            #bottom-buttons {
                width: 49%;
            }   
        }
    
        @media (max-width: 470px) {
            #bottom-buttons {
                width: 64%;
            }   
        }
    
         @media (max-width: 320px) {
            #bottom-buttons {
                width: 83%;
            }
             
             #paypal {
                 margin-right: 0;
             }
             
             #divNote {
                 position: relative;
                 right: 8px;
             } 
        }

        /*--- SLIDE MENU ---*/

        /* screw writing importants, just stick it in max width since these classes are not shared between sizes */
        @media (max-width:767px) { 
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
                display: block;
            }

            .navbar-right-link a {
                display: block;
                font-size: 1.1rem;
            }

            .navbar-nav li {
                float: none;
                text-align: center;
                padding: 15px 0;
                width: 100%;
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
            
                
</style>
    
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
                <a class="navbar-brand" href="index.html"><img src="img/sock.png" id="sock">Seasoned Socks</a>
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
                 <li><a href="samples.html">Samples</a></li>
                 <li class="navbar-right-link"><a class="btn btn-primary btn-sm" href="buy.php">Buy</a></li>
                </ul>

               </div>
              </div>
            </div>
        
        <div class="clear"></div>
        
        <div class="content-wrapper">
            <div class="content">
                <div class="info">
                    <h3 id="note-header">Here's your note</h3>
                </div>
                <div id="divNote">
                    <textarea maxlength="130" type="text" name="note" id="note-contents" readonly><?php if ($note->num_rows > 0) { while($row = $note->fetch_assoc()) { $text = $row["note"]; filter_var($text, FILTER_SANITIZE_STRING); echo $text; $id = $row["orderID"]; }}?></textarea>
                </div>
                
                <div id="bottom-buttons">
                    <div id="left-half">
                        <form action="https://seasonedsocks.com/buy.php">
                            <input type="submit" value="Go back" id="goback" class="hide">
                        </form>
                    </div>
                        
                    <div id="right-half">
                        <div id="paypal">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="ZKLAUTSW9C2HJ">
                                <input type="hidden" name="business" value="EZBUFKHRZ6YQJ">
                                <input type="hidden" name="item_name" value="Seasoned Sock <? echo "$id: " . "$text"; ?>">
                                <input type="hidden" name="amount" value="9.99">
                                <input type="hidden" name="memo" value="Note: <? echo "$text"; ?>"</input>
                                <input type="hidden" name="cancel_return" value="https://seasonedsocks.com/shop.html">
                                <input type="image" src="img/button.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>
                        </div>
                    </div>
                </div>
            <div class="clear"></div>    
                
            <div class="footer"></div>
            </div>
    </body>
    
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
            
            $(function(){
            $(".footer").load("footer.html");
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
