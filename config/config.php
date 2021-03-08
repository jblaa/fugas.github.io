<?php
    ##GLOBAL VALUES
        $version = 'v0.2';
        $themes = ['https://bootswatch.com/4/cerulean/bootstrap.min.css', 'https://bootswatch.com/4/cyborg/bootstrap.min.css']; //0=light, 1=dark
        $modes = ['ready to start', 'in progress', 'game over']; //game modes: 0 = READY TO START, 1 = IN PROGRESS, 2 = GAME OVER
        $gas_api_url = 'https://ethgasstation.info/api/ethgasAPI.json';
        $starting_balance = 10000; //the starting fake money value that can be called on in a reset
        $bet_fee_percentage = 0.05; //the fee that is charged per bet (percentage per bet, for example 0.05 = 5% fee)

    ##USER SETTINGS##
        $is_logged_in = 'no'; //set to yes if user is logged in
        $is_sound_on = 'off'; //on or off basd on user pref, putton press

    ##GAS API REQUEST
        $gas_address = "https://ethgasstation.info/api/ethgasAPI.json"; //ETH GAS Endpoint
        $gas_data = ['collection' => 'gas_prices'];

    ##SOCIAL LINKS
?>