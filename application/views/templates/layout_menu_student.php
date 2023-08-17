<!-- Header Top ==== -->

<header class="header rs-nav">

    <div class="top-bar">

        <div class="container">

            <div class="row d-flex justify-content-between">

                <div class="topbar-left">

                    <ul>

                        <!-- <li><a href="https://www.ukm.my/portal/"><img src="<?= base_url('/'); ?>assets/img/logo.png" width="100" alt=""></li> -->

                        <li><a href="https://www.ukm.my/ukmshape/"><img src="<?= base_url('/'); ?>assets/img/Logo-UKMShape-1.png" width="400" alt=""></li>

                    </ul>

                </div>

                <div class="topbar-right">

                    <ul>
                        <li>
                            <select class="header-lang-bx">
                                <option>English</option>
                                <option>Bahasa Malaysia</option>
                            </select>
                        </li>

                        <li><a href="<?= base_url('/auth/keluar'); ?>">Logout</a></li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

    <div class="sticky-header navbar-expand-lg">

        <div class="menu-bar clearfix">

            <div class="container clearfix">

                <!-- Header Logo ==== -->

                <div class="menu-logo">

                    <a href="<?= base_url('/'); ?>"><img src="<?= base_url('/'); ?>assets/img/CLG.png" alt=""></a>

                </div>

                <!-- Mobile Nav Button ==== -->

                <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">

                    <span></span>

                    <span></span>

                    <span></span>

                </button>

                <!-- Author Nav ==== -->

                <div class="secondary-menu">

                    <div class="secondary-inner">

                        <ul>

                            <li><a href="https://www.facebook.com/ukmshape/" class="btn-link"><i class="fa fa-facebook"></i></a></li>

                            <li><a href="https://twitter.com/pkpukm" class="btn-link"><i class="fa fa-twitter"></i></a></li>

                            <li><a href="https://www.instagram.com/pkpukminsta/" class="btn-link"><i class="fa fa-instagram"></i></a></li>

                            <!-- Search Button ==== -->

                            <li class="search-btn"><button id="quik-search-btn" type="button" class="btn-link"><i class="fa fa-search"></i></button></li>

                        </ul>

                    </div>

                </div>

                <!-- Search Box ==== -->

                <div class="nav-search-bar">

                    <form action="#">

                        <input name="search" value="" type="text" class="form-control" placeholder="Type to search">

                        <span><i class="ti-search"></i></span>

                    </form>

                    <span id="search-remove"><i class="ti-close"></i></span>

                </div>

                <!-- Navigation Menu ==== -->

                <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">

                    <div class="menu-logo">

                        <a href="index.html"><img src="assets/images/logo.png" alt=""></a>

                    </div>

                    <ul class="nav navbar-nav">

                        <li class="active"><a href="<?= base_url('/'); ?>"><button class="btn btn-warning" style="margin: -8px">APPLY NOW !</button></a></li>

                        <li><a href="<?= base_url('/'); ?>">Home </a></li>

                        <li><a href="<?= base_url('/student/profile'); ?>">Category </a></li>

                        <li><a href="javascript:;">Programme <i class="fa fa-chevron-down"></i></a>

                            <ul class="sub-menu">

                                <li><a href="javascript:;">Micro-credential <i class="fa fa-chevron-right"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?= base_url('/main/faqs'); ?>">Info</a></li>
                                        <li><a href="<?= base_url('/main/faqs'); ?>">Programme</a></li>
                                    </ul>
                                </li>


                                <li><a href="javascript:;">Professional Certificate <i class="fa fa-chevron-right"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?= base_url('/main/faqs'); ?>">Info</a></li>
                                        <li><a href="<?= base_url('/main/faqs'); ?>">Programme</a></li>
                                    </ul>
                                </li>

                                <li><a href="javascript:;">Short Course <i class="fa fa-chevron-right"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?= base_url('/main/faqs'); ?>">Info</a></li>
                                        <li><a href="<?= base_url('/main/faqs'); ?>">Programme</a></li>
                                    </ul>
                                </li>

                            </ul>

                        </li>

                        <li><a href="<?= base_url('/main/faqs'); ?>">FAQs </a></li>

                        <li><a href="<?=LMSPATH;?>">eCourse LMS </a></li>

                    </ul>

                </div>

                <!-- Navigation Menu END ==== -->

            </div>

        </div>

    </div>

</header>

<!-- Header Top END ==== -->