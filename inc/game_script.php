<?php
    //if top up is clicked add $1000 to their account
        if(isset($_POST['reset_to_starting_balance'])){
            $_SESSION['balance'] = $starting_balance;
        };

    switch ($_SESSION['mode']){
        case 0:
            echo '
                <h5><span style="color:var(--info);">Ready to start new game:</span></h5>
                <h6>Start a new game by <span style="color:var(--primary);">BETTING UP or DOWN</span> on the future price of ETH GAS above</h6><br>
                <h5>Balance: <span style="color:var(--primary);">$'.$_SESSION['balance'].'</span></h5>
                <p>** all bets incur a <span style="color:var(--primary);">'.($bet_fee_percentage * 100).'%</span> fee</p>
            ';
            break;
        case 1:
            echo '
                <h5><span style="color:var(--warning);">Game in progress:<span></h5>
                <div style="display:flex;">
                    <h6>If <span style="color:var(--primary);">'.$_SESSION['bet_gas_type'].'</span> ETH Gas finishes <span style="color:var(--primary);">'.$_SESSION['bet_type'].'</span> from <span style="color:var(--primary);">'.$_SESSION['gas_at_start'].'</span> at <span style="color:var(--primary);">'.date("H:i:s", $_SESSION['game_end']).'(GMT)</span> you win <span style="color:var(--primary);">$'.($_SESSION['bet_amount_no_fee'] * 2).'</span></h6><br>
                </div><br>
                <h5>Balance: <span style="color:var(--primary);">$'.$_SESSION['balance'].'</span></h5>
                <p>** all bets incur a <span style="color:var(--primary);">'.($bet_fee_percentage * 100).'%</span> fee</p>
            ';
            break;
        case 2:
            echo $result_header;
            echo '
                <h6><span style="color:var(--primary);">'.$_SESSION['bet_gas_type'].'</span> ETH Gas went <span style="color:var(--primary);">'.$_SESSION['up_down'].'</span> from <span style="color:var(--primary);">'.$_SESSION['gas_at_start'].'</span> to <span style="color:var(--primary);">'.$_SESSION['gas_at_end'].'</span> at <span style="color:var(--primary);">'.date("H:i:s", $_SESSION['game_end']).'(GMT)</span>, you <span style="color:var(--primary);">'.$_SESSION['result'].'</span> and your payback is $<span style="color:var(--primary);">'.$_SESSION['payback'].'</span>.</h6><br>
                <h5>NEW Balance: <span style="color:var(--primary);">$'.$_SESSION['balance'].'</span></h5>
                <p>** all bets incur a <span style="color:var(--primary);">'.($bet_fee_percentage * 100).'%</span> fee</p>
            ';
            break;
        default:
            echo '<h1>SOMETHING BROKE THIS IS THE DEFAULT CASE IN THE SCRIPT BOX<h1>';
            break;
    }
?>