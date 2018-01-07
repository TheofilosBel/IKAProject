<header>
    <!-- LOGO -->
    <img src="img/logo.png" height="75" width="75">

    <ul class="nav_menu">
        <li><a class="non-ddown" href="./"><img src="img/home.png" height="20" width="20">Αρχική</a></li>
        <li><div class="dropdown">
                <div class="ddown" href="#"><img src="img/search.png" height="20" width="20">Αναζήτηση</div>

                <div class="search-bar">
                     <input type="text" name="search" placeholder="Search..">
                </div>
        </div></li>
        <li><a class="non-ddown" href="#"><img src="img/menu.png" height="20" width="20">Μενού</a></li>
        <li><div class="dropdown">
                <div class="ddown" href="#"><img src="img/globe.png" height="20" width="20">Γλώσσα &#9660;</div>

                <div class="dropdown-content">
                    <a href="#"><span>Ελληνικά</span> <img src="img/greek.png" height="20" widht="20"></a>
                    <a href="#"><span>English</span>  <img src="img/english.png" height="15" widht="15"></a>
                </div>
        </div></li>

        <!-- Check if we have a logged in user and change the header's layout -->
        <?php if (!isset($_COOKIE["username"])){ ?>
          <li><a class="non-ddown" href="./login.php"><img src="img/login.png" height="20" width="20">Είσοδος/Εγγραφή</a></li>
        <?php } else { ?>
          <li><div class="dropdown">
                  <div class="ddown" href="#"><?php echo $_COOKIE["username"];?> &#9660;</div>

                  <div class="dropdown-content">
                      <a href="profile.php"><span>Προφίλ</span></a>
                      <a href="logout.php"><span>Έξοδος</span></a>
                  </div>
          </div></li>
        <?php } ?>
    </ul>
</header>
