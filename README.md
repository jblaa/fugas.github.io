# F U GAS

## Revision History

### v0.1 (05 Mar 2021)

1. trial release

### v0.2 (08 Mar 2021)

1. responsive layout for mobile and tablets

2. game over pop-up added

### v0.3 (TBD)

1. games based on global timer

2. inclusion of user database. includes login and account pages

3. add chat window

4. add content to about page

5. updated game stat box (js instead of php)

6. bug fix: game status error on page request after game over

## Files:

### \config\config.php

global parameters and settings

### \inc\

header.php - start session, start session, run game, end game, header content (switches, banner, timer)

footer.php - footer area, scripts (timer update, live price updates game over popup)

game_script.php - cases for the left part of the results area in index.php

game_stats.php - cases for the right part of the results area in index.php

game_over.php - determines the game over pop up image

### \

index.php - main game (price area, place bet area, results area)

account.php - user account page (empty)

about.php - about page (empty)

login.php - login page (empty)

main.js - not used yet (empty)

### \css\style.css

main stylesheet (not including stylesheets from Bootswatch, will download those later)

### \img\ 

game over images (500x500px, png format)
