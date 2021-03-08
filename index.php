<?php
    ##php specific for this page
    $thispage = 'Home';
    include 'inc\header.php';

    ##check if there is a stat panel active and if not set to first panel
        if(!isset($_POST['stat'])){
            $_POST['stat'] = 0;
        };
?>
    <!--price area-->
    <div class="container">
        <!--social links-->
        <div id="social_links">
            <i class="social_icon fas fa-bars fa-2x"></i>
            <a href="https://twitter.com/ethgasstation" target="_blank"><i style="color:#55acee;" class="bright_when_hover social_icon fab fa-twitter fa-2x"></i></a>
            <a href="https://discord.gg/mzDxADE" target="_blank"><i style="color:#7289da;" class="bright_when_hover social_icon fab fa-discord fa-2x"></i></a>
            <a href="https://t.me/FUGASofficial" target="_blank"><i style="color:#0088CC;" class="bright_when_hover social_icon fab fa-telegram fa-2x"></i></a>
        </div>
        <!--current price cards-->
        <div class="container jumbotron" id="current_price_area">
            <h6>Current Recommended Gas Prices in Gwei<small> - Prices taken from ETHGasStation – Fast GWEI, refreshes every 10 seconds</small></h6>
            <div id="current_price_cards">
                <!--TRADER -->   
                <div class="card-body" style="border:1px var(--primary) solid;align-items:center;">
                    <h5 id="traderprice"><strong><?php echo $gas_trader_price; ?></strong></h5>
                    <h5 class="card-title"><strong> TRADER</strong><small> < ASAP</small></h5>
                </div>
                <!--FAST -->
                <div class="card-body" style="border:1px var(--primary) solid;align-items:center;">
                    <h5 id="fastprice"><strong><?php echo $gas_fast_price; ?></strong></h5>
                    <h5 class="card-title"><strong> FAST</strong><small> < 2 min</small></h5>
                </div>
                <!--STANDARD -->
                <div class="card-body" style="border:1px var(--primary) solid;align-items:center;">
                    <h5 id="standardprice"><strong><?php echo $gas_standard_price; ?></strong></h5>
                    <h5 class="card-title"><strong> STANDARD<strong><small> < 5 min </small></h5>
                </div>
            </div>
        </div>
    </div>  
    <!--bet area-->
    <div class="container" >
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="bet_buttons">
            <div class=""></div>
            <input type="submit" id="bet_up" name="bet_up" value="Bet Up" class="<?php if(($_SESSION['mode'] == 0)) {echo 'pulse';}; ?> btn btn-secondary btn-lg bet_button btn-success
                <?php
                    if(($_SESSION['mode']) == 0 && ($_SESSION['theme'] == 0)){echo 'pulse_light';} elseif (($_SESSION['mode']) == 0 && ($_SESSION['theme'] == 1)) {echo 'pulse_dark';}
                ?>
            " <?php if(($_SESSION['mode'] != 0)) {echo 'disabled';}; ?>>
            <div class="form-group bet_input">
                <label>Gas Type</label>    
                <select class="custom-select" name="bet_gas_type" required <?php if(($_SESSION['mode'] != 0)) {echo 'disabled';}; ?>>
                    <option value="trader">TRADER</option>
                    <option selected="fast">FAST</option>
                    <option value="standard">STANDARD</option>
                </select>
            </div>
            <div class="form-group bet_input">
                <label>Bet Amount **</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control" id="bet-amount" name="bet_amount" aria-label="Amount (to the nearest dollar)" autofocus required <?php if(($_SESSION['mode'] != 0)) {echo 'disabled';}; ?> max="<?php echo ($_SESSION['balance'] / (1 + $bet_fee_percentage)); ?>">
                </div>
            </div>
            <div class="form-group bet_input">
                <label>Over How Long?</label>
                <select class="custom-select" name="bet_length" required <?php if(($_SESSION['mode'] != 0)) {echo 'disabled';}; ?>>
                    <option value="60">One Minute</option>
                    <option value="300">Five Minutes</option>
                    <option value="3600">One Hour</option>
                </select>
            </div>
            <input type="submit" id="bet_down" name="bet_down" value="Bet Down" class="btn btn-secondary btn-lg bet_button btn-danger 
                <?php
                    if(($_SESSION['mode']) == 0 && ($_SESSION['theme'] == 0)){echo 'pulse_light';} elseif (($_SESSION['mode']) == 0 && ($_SESSION['theme'] == 1)) {echo 'pulse_dark';}
                ?>" <?php if(($_SESSION['mode'] != 0)) {echo 'disabled';}; ?>>
            <div class=""></div>
        </form>
    </div>
    <!--results area-->
    <div class="container" id="results_area">
        <div id="results_left">
            <div id="game_script">
                <?php include 'inc\game_script.php'; ?>
            </div>
        </div>
        <div class="container" id="results_center">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="text-align:center;" class="full_height">
                <button name="reset_to_starting_balance" class="btn btn-secondary btn-lg full_height" <?php if(($_SESSION['mode'] != 0) || ($_SESSION['balance'] >= 10000)) {echo 'disabled';}; ?>>Top Up Balance</button>
            </form>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?> " style="text-align:center;" class="full_height">
                <button class="btn btn-secondary btn-lg full_height
                    <?php
                        if(($_SESSION['mode']) == 2 && ($_SESSION['theme'] == 0)){echo 'pulse_light';} elseif (($_SESSION['mode']) == 2 && ($_SESSION['theme'] == 1)) {echo 'pulse_dark';}
                    ?>
                " name="game_reset" <?php if(($_SESSION['mode'] != 2)) {echo 'disabled';}; ?>>Start A New Game</button>
            </form>
        </div>
        <div id="results_right">
            <form method="post" id="choose_stats" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button value="0" type="submit" name="stat" class="<?php if($_POST['stat'] == 0) {echo 'btn-info';} else {echo 'btn-primary';}; ?> stat_tab fas fa-question-circle fa-2x"></button>
                <button value="1" type="submit" name="stat" class="<?php if($_POST['stat'] == 1) {echo 'btn-info';} else {echo 'btn-primary';}; ?> stat_tab far fa-chart-bar fa-2x"></button>
                <button value="2" type="submit" name="stat" class="<?php if($_POST['stat'] == 2) {echo 'btn-info';} else {echo 'btn-primary';}; ?> stat_tab fab fa-bitcoin fa-2x"></button>
            </form>
            <div id="game_stats">
                <?php include 'inc\game_stats.php'; ?>
            </div>
        </div>
    </div>

<?php include 'inc\footer.php'; ?>
