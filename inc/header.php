<?php
    require('config/config.php');
    session_start(); //start the session

    ##LIGHT/DARK MODE TOGGLE
        //check if theme has been set and if not set it light
        if(!isset($_SESSION['theme'])){$_SESSION['theme'] = 0;}
        //look for the light / dark mode button press and change the theme
        if(isset($_POST['toggle_theme'])){
            if($_SESSION['theme'] == 0){
                $_SESSION['theme'] = 1;
            } else {$_SESSION['theme'] = 0;}
        }
        //set the theme to display based on session thenme
        $theme_address = $themes[$_SESSION['theme']];

    ##INITIATE GAME MODE IF NEEDED
        if(!isset($_SESSION['mode'])){ $_SESSION['mode'] = 0; }

    ##CHECK RESET
        if(isset($_POST['game_reset'])){
            $_SESSION['mode'] = 0; //change from READY to IN PROGRESS
        }

    ##GET LATEST GAS API VALUES
        $gas_api_string = file_get_contents($gas_api_url);
        $gas_api_data = json_decode($gas_api_string);
        $gas_trader_price = $gas_api_data->fastest / 10;
        $gas_fast_price = $gas_api_data->fast / 10;
        $gas_standard_price = $gas_api_data->average / 10;

    ##INITIATE USER STATS
        //initialize the user's balance
        if(!isset($_SESSION['balance'])){
            $_SESSION['balance'] = 10000;
        }

    ##CHECK GAME MODE AND SET BUTTONS
        switch ($_SESSION['mode']){
            case 0:
                ##GET BET
                //INITIALIZE BUTTONS
                //if game mode = ready to start, look for the bet to come through
                if(isset($_POST['bet_up'])){
                    $_SESSION['mode'] = 1; //change from READY to IN PROGRESS
                    $_SESSION['bet_type'] = 'up';
                    $_SESSION['bet_amount_no_fee'] = $_POST['bet_amount'];
                    $_SESSION['bet_amount'] = $_POST['bet_amount'] * (1 + $bet_fee_percentage);
                    $_SESSION['bet_gas_type'] = $_POST['bet_gas_type'];
                    $_SESSION['game_start'] = strtotime('now');
                    //get current gas price again
                        $gas_api_string = file_get_contents($gas_api_url);
                        $gas_api_data = json_decode($gas_api_string);
                        $gas_trader_price = $gas_api_data->fastest / 10;
                        $gas_fast_price = $gas_api_data->fast / 10;
                        $gas_standard_price = $gas_api_data->average / 10;
                        switch($_SESSION['bet_gas_type']){
                            case 'TRADER':
                                $_SESSION['gas_at_start'] = $gas_trader_price;
                                break;
                            case 'FAST':
                                $_SESSION['gas_at_start'] = $gas_fast_price;
                                break;
                            case 'STANDARD':
                                $_SESSION['gas_at_start'] = $gas_standard_price;
                                break;
                            default:
                                echo 'something is broken at setting the starting gas price when bet has been entered';
                                break;
                        }
                    $_SESSION['game_length'] = $_POST['bet_length'];
                    $_SESSION['game_end'] = $_SESSION['game_start'] + intval($_POST['bet_length']);
                    $_SESSION['balance'] -= $_SESSION['bet_amount'];
                }
                if(isset($_POST['bet_down'])){
                    $_SESSION['mode'] = 1; //change from READY to IN PROGRESS
                    $_SESSION['bet_type'] = 'down';
                    $_SESSION['bet_amount_no_fee'] = $_POST['bet_amount'];
                    $_SESSION['bet_amount'] = $_POST['bet_amount'] * (1 + $bet_fee_percentage);
                    $_SESSION['bet_gas_type'] = $_POST['bet_gas_type'];
                    $_SESSION['game_start'] = strtotime('now');
                    //get current gas price again
                        $gas_api_string = file_get_contents($gas_api_url);
                        $gas_api_data = json_decode($gas_api_string);
                        $gas_trader_price = $gas_api_data->fastest / 10;
                        $gas_fast_price = $gas_api_data->fast / 10;
                        $gas_standard_price = $gas_api_data->average / 10;
                        switch($_SESSION['bet_gas_type']){
                            case 'TRADER':
                                $_SESSION['gas_at_start'] = $gas_trader_price;
                                break;
                            case 'FAST':
                                $_SESSION['gas_at_start'] = $gas_fast_price;
                                break;
                            case 'STANDARD':
                                $_SESSION['gas_at_start'] = $gas_standard_price;
                                break;
                            default:
                                echo 'something is broken at setting the starting gas price when bet has been entered';
                                break;
                        }
                    $_SESSION['game_length'] = $_POST['bet_length'];
                    $_SESSION['game_end'] = $_SESSION['game_start'] + intval($_POST['bet_length']);
                    $_SESSION['balance'] -= $_SESSION['bet_amount'];
                }
                break;
            case 1:
                //check to see if time is up, and if so capture end price and compare to start
                if($_SESSION['game_end'] <= intval(strtotime('now'))){
                    $_SESSION['mode'] = 2; //change from IN PROGRESS to GAME OVER
                    ##capture end price
                        //get current gas price again
                        $gas_api_string = file_get_contents($gas_api_url);
                        $gas_api_data = json_decode($gas_api_string);
                        $gas_trader_price = $gas_api_data->fastest / 10;
                        $gas_fast_price = $gas_api_data->fast / 10;
                        $gas_standard_price = $gas_api_data->average / 10;
                        switch($_SESSION['bet_gas_type']){
                            case 'TRADER':
                                $_SESSION['gas_at_end'] = $gas_trader_price;
                                break;
                            case 'FAST':
                                $_SESSION['gas_at_end'] = $gas_fast_price;
                                break;
                            case 'STANDARD':
                                $_SESSION['gas_at_end'] = $gas_standard_price;
                                break;
                            default:
                                echo 'something is broken at setting the end gas price when bet has been pulled';
                                break;
                        };
                    ##compare prices
                        if($_SESSION['gas_at_end'] > $_SESSION['gas_at_start']){
                            $_SESSION['up_down'] = 'up';
                        } elseif ($_SESSION['gas_at_end'] < $_SESSION['gas_at_start']) {
                            $_SESSION['up_down'] = 'down';
                        } elseif ($_SESSION['gas_at_end'] == $_SESSION['gas_at_start']) {
                            $_SESSION['up_down'] = 'nowhere';
                        } else {echo 'something went wrong comparing prices';};
                    ##did you win?
                        if($_SESSION['up_down'] == 'nowhere'){
                            $_SESSION['result'] = 'push';
                            $result_header = '<h5 style="color:var(--secondary);">YOU PUSH:</h5>';
                        } elseif ($_SESSION['up_down'] == $_SESSION['bet_type']) {
                            $_SESSION['result'] = 'win';
                            $result_header = '<h5 style="color:var(--success);">YOU WIN:</h5>';
                        } else {
                            $_SESSION['result'] = 'lose';
                            $result_header = '<h5 style="color:var(--danger);">YOU LOSE:</h5>';
                        };

                    ##calculate the payback
                        switch ($_SESSION['result']){
                            case 'push':
                                $_SESSION['payback'] = $_SESSION['bet_amount_no_fee'];
                                break;
                            case 'win':
                                $_SESSION['payback'] = 2 * $_SESSION['bet_amount_no_fee'];
                                break;
                            case 'lose':
                                $_SESSION['payback'] = 0;
                                break;
                            default:
                                echo 'something went wrong calculating payback';
                                break;
                        };
                    ##pay back the winnings
                        $_SESSION['balance'] += $_SESSION['payback'];
                        
                }
                break;
            case 2:
                //reset game when reset button hit
                if(isset($_POST['game_reset'])){
                    $_SESSION['mode'] = 0; //change from GAME OVER to READY
                }
                break;
            default:
                echo 'something is wrong, no game mode defined';
                break;
        }

    ##REFRESH WHEN GAME TIME IS UP
        if(isset($_SESSION['game_end'])){
            $refresh_page = $_SERVER['PHP_SELF'];
            $refresh_period = intval($_SESSION['game_end']) - intval(strtotime('now'));
            header("Refresh: $refresh_period; url=$refresh_page");
        }

    ##TIMER SETUP
        //if game mode = 1, set time remining to SESSION - time remaining
        if($_SESSION['mode'] == 1){
            $_SESSION['time_remaining'] = $refresh_period;
        } else {$_SESSION['time_remaining'] = 0;};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="true">
    <title>F U GAS | <?php echo $thispage; ?></title>
    <!--stylesheet determined based on $display_mode variable in config/stylesheet.php-->
    <link rel="stylesheet" href="<?php echo $theme_address; ?>">
    <link rel="stylesheet" href="css\style.css">
    <!--fontawesome for icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>
<body>
    <!--header-->
    <div id="site_header">
        <!--login, light/dark mode, audio on/off-->
        <form method="POST" class="container" id="settings_panel" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="dropdown">
                <button type="button" name="toggle_menu" value="" class="dropbtn bright_when_hover setting_icon fas fa-bars fa-2x btn"></button>
                <div class="dropdown-content">
                    <a class="map_link" href="index.php">Home</a>
                    <a class="map_link" href="about.php">About</a>
                    <a class="map_link" href="https://forms.gle/edoMkWkzDX4SJ96cA" target="_blank">Report a Bug</a>
                </div>
            </div>
            <!--<button type="submit" name="toggle_user_panel" value="" class="danger_when_hover setting_icon fas fa-user fa-2x btn" disabled></button>-->
            <button type="submit" name="toggle_theme" value="" class="bright_when_hover setting_icon fas fa-moon fa-2x btn"></button>
            <button type="submit" name="toggle_sound" value="" class="danger_when_hover setting_icon fas fa-bullhorn fa-2x btn" disabled></button>
        </form>
        <!--F U GAS TITLE-->
        <div class="container" id="site_title">
            <h1>F U GAS</h1>
        </div>
        <!--counter bar-->
        <div class="container" id="site_timer">
            <p>game time remaining:</p>
            <h2 id="timer">00:00:00</h2><br>

        </div>
    </div>