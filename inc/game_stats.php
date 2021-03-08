<?php
    switch ($_POST['stat']){
        case 0:
            echo '<h6>F U GAS is a game where you can bet on the future price of ETH Gas. Enter the <span style="color:var(--warning);">Gas Type</span>, <span style="color:var(--warning);">Bet Amount</span>, <span style="color:var(--warning);">Over How Long</span> you want the bet to be, and then <span style="color:var(--success);">Bet Up</span> or <span style="color:var(--danger);">Bet Down</span>. If you guess correctly, you\'ll double your money (minus our fee of course).</h6>';
            break;
        case 1:
            echo '<h6>Future updates will feature personal stats like: HIGH SCORE, GAMES PLAYED, WIN / LOSS, LAST 10</h6>';
            echo '<h6>Future updates may also feature global leaderboards and other community stats</h6>';
            break;
        case 2:
            echo '<h6>Get on the Token Sale Whitelist and get info on the token release</h6>';
            echo '<a href="https://docs.google.com/forms/d/e/1FAIpQLSfIHn-bARU9Lw_nou6gud2NxeGAOOZ-Q3tvpTAOxiJgeQwMpg/viewform" target="_blank"><button type="button" class="btn btn-primary btn-lg">Token Sale Whitelist</button></a>';
            break;
        default:
            echo '<h6>F U GAS is a game where you can bet on the future price of ETH Gas. Enter the <span style="color:var(--warning);">Gas Type</span>, <span style="color:var(--warning);">Bet Amount</span>, <span style="color:var(--warning);">Over How Long</span> you want the bet to be, and then <span style="color:var(--success);">Bet Up</span> or <span style="color:var(--danger);">Bet Down</span>. If you guess correctly, you\'ll double your money (minus our fee of course).</h6>';
            break;
    }
?>