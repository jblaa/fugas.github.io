    <!--footer area-->
    <div class="container" id="footer_area">
        <!--site map-->
        <div id="site_map">
            <a class="map_link" href="index.php">Home</a>
            <!--<a class="map_link" href="account.php">Login / My Account</a>-->
            <a class="map_link" href="about.php">About</a>
            <a class="map_link" href="https://forms.gle/edoMkWkzDX4SJ96cA" target="_blank">Bugs?</a>
        </div>
        <!--copyright -->
        <p><strong>&copy; 2021 F U Gas </strong> | <small><?php echo $version; ?> - developed by <a href="https://intransit.site" target="_blank">IN_TRANSIT</a></small></p>
        <!--footer socials-->
        <div id="footer_socials">
            <a href="https://twitter.com/ethgasstation" target="_blank"><i style="color:#55acee;" class="bright_when_hover social_icon fab fa-twitter"></i></a>
            <a href="https://discord.gg/mzDxADE" target="_blank"><i style="color:#7289da;" class="bright_when_hover social_icon fab fa-discord"></i></a>
            <a href="https://t.me/FUGASofficial" target="_blank"><i style="color:#0088CC;" class="bright_when_hover social_icon fab fa-telegram"></i></a>
        </div>
    </div>
    <!--pop up area-->
    <a class="trigger_popup_fricc">Click here to show the popup</a>
    <div class="hover_bkgr_fricc">
        <span class="helper"></span>
        <div>
            <div class="win_popup popupCloseButton">&times;</div>
            <img class ="win_image <?php if ($_SESSION['theme'] == 1) {echo 'inverted';};?>" src="img\win.png" alt="win_image">
            <div class="lose_popup popupCloseButton">&times;</div>
            <img class ="lose_image <?php if ($_SESSION['theme'] == 1) {echo 'inverted';};?>" src="img\lose.png" alt="lose_image">
            <div class="push_popup popupCloseButton">&times;</div>
            <img class ="push_image <?php if ($_SESSION['theme'] == 1) {echo 'inverted';};?>" src="img\push.png" alt="push_image">
        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
    <!--TIMER-->
        <script type="text/javascript">
            //TIMER
            function pad2(number) {return (number < 10 ? '0' : '') + number}//make the number 2 digit if it is only 1
            //display 0 if at ready state
            if(<?php echo $_SESSION['mode']; ?> == 0){
                document.getElementById("timer").innerHTML = "00:00:00";
            };
            //countdown if game is in progress
            if(<?php echo $_SESSION['mode']; ?> == 1){
                var countDownDate = <?php echo $_SESSION['game_end'];?>; // = WHEN GAME ENDS
                var x = setInterval(function() {
                    var currentDate = new Date(); // Get today's date and time
                    var now = Math.floor(currentDate.getTime() / 1000); //convert to integer
                    var distance = countDownDate - now; // Find the distance between now and the count down date
                    // Time calculations for days, hours, minutes and seconds
                    if (distance > 0){
                        var hours = Math.floor(distance / 3600);//get the amount of hours remaining
                        var minutes = Math.floor((distance - (hours * 3600)) / 60);//get the amount of minutes remaining
                        var seconds = Math.floor(distance - (hours * 3600) - (minutes * 60));
                        document.getElementById("timer").innerHTML = pad2(hours) + ":" + pad2(minutes) + ":" + pad2(seconds);
                    } else {
                        document.getElementById("timer").innerHTML = "00:00:00";
                        clearInterval(x);
                    };
                }, 1000); // Update the counter down every 1 second
            };
            //display 0 if game over
            if(<?php echo $_SESSION['mode']; ?> == 2){
                document.getElementById("timer").innerHTML = "00:00:00";
            };
        </script>
    
    <!--LIVE PRICE UPDATES-->
        <script type="text/javascript">
            var x = setInterval(function() {
                fetch('https://ethgasstation.info/api/ethgasAPI.json')
                    .then((response) => {
                        return response.json()
                    })
                    .then((data) => {
                        // Work with JSON data here
                        document.getElementById('traderprice').innerHTML = '<strong>' + data['fastest'] / 10 + '</strong>';
                        document.getElementById('fastprice').innerHTML = '<strong>' + data['fast'] / 10 + '</strong>';
                        document.getElementById('standardprice').innerHTML = '<strong>' + data['average'] / 10 + '</strong>';
                    })
                    .catch((err) => {
                        document.getElementById('traderprice').innerHTML = 'ERR';
                        document.getElementById('fastprice').innerHTML = 'ERR';
                        document.getElementById('standardprice').innerHTML = 'ERR';
                    })
            }, 10000);
        </script>

    <!--GAME RESULT POP UP-->
        <script type="text/javascript">
            //if game mode = 2, trigger pop up
            //check to see if pop up has already been triggered this game, and if so don't pop up
            $(window).load(function () {
                
                $(".trigger_popup_fricc").click(function(){
                    $('.hover_bkgr_fricc').show();
                });
                $('.hover_bkgr_fricc').click(function(){
                    $('.hover_bkgr_fricc').hide();
                });
                $('.popupCloseButton').click(function(){
                    $('.hover_bkgr_fricc').hide();
                });
            });
        </script>
</body>
</html>