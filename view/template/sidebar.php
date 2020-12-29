        <div id="header_menu"class="it-header-navbar-wrapper affix-top" style="z-index:1;">
          <div class="container ">
            <div class="row ">
              <div class="col-12 ">
                <!--start nav-->
                <nav class="navbar navbar-expand-lg has-megamenu " >
                  <button class="custom-navbar-toggler" type="button" aria-controls="nav1" aria-expanded="false" aria-label="Toggle navigation" data-target="#nav1">
                    <svg class="icon">
                      <use xlink:href="svg/sprite.svg#it-burger"></use>
                    </svg>
                  </button>
                  <div class="navbar-collapsable" id="nav1" style="display: none;">
                    <div class="overlay" style="display: none;"></div>
                    <div class="close-div sr-only">
                      <button class="btn close-menu" type="button"><span class="it-close"></span>close</button>
                    </div>
                    <div class="menu-wrapper">
                       
                      <ul class="navbar-nav">
                      
                        <li id="li_logo" style="display:none;">
                          <div class="row">
                          <img src="images/logo-ram-2018.png" alt="Home" style="height: 50px">
                            <img src="images/logo.svg" alt="Home" style="max-height: 50px;    padding: 7px;">
                              <div class="it-brand-text">
                                <b class="no_toc" style="color:white;">Ministero</b>
                                <b class="no_toc d-none d-md-block" style="color:white;font-size: 11px;">delle Infrastrutture e dei Trasporti</b>
                              </div>
                          </div>
                        </li>
                        <li class="nav-item active"><a class="nav-link <?=basename($_SERVER["PHP_SELF"])=='home.php'?'active':''?>" href="home.php"><span><i class="fa fa-home" aria-hidden="true"></i> Home</span><span class="sr-only">current</span></a></li>
                        <li class="nav-item"><a class="nav-link <?=basename($_SERVER["PHP_SELF"])=='users.php'?'active':''?>" href="users.php"><span><i class="fa fa-users" aria-hidden="true"></i> Gestione Utenti </span></a></li>
                        <li class="nav-item"><a class="nav-link <?=basename($_SERVER["PHP_SELF"])=='istanze.php'?'active':''?>" href="istanze.php"><span><i class="fa fa-list" aria-hidden="true"></i> Istanze </span></a></li>
                        <li class="nav-item"><a class="nav-link <?=basename($_SERVER["PHP_SELF"])=='comunicazioni.php'?'active':''?>" href="comunicazioni.php"><span><i class="fa fa-inbox" aria-hidden="true"></i> Help Desk</span></a></li>
                        
                      </ul>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>