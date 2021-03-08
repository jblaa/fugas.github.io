<?php
    //if game is over, show pop-up
        if(isset($_SESSION['result'])){
            switch ($_SESSION['result']){
                case 'win':
                    echo 'img\win.png';
                    break;
                case 'push':
                    echo 'img\push.png';
                    break;
                case 'lose':
                    echo 'img\lose.png';
                    break;
                default:
                    echo 'no result yet';
                    break;
        };
    };
?>