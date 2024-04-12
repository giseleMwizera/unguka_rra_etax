    <?php

    include("../config/config.php");
    include("../helpers/functions.php");

    $content = isset($_GET['content']) ? $_GET['content'] : 'dashboard';
    ?>
    <!DOCTYPE html>
    <html class="no-js" lang="en" data-theme="light">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="MobileOptimized" content="320" />
        <meta name="HandheldFriendly" content="True" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Unguka e-tax</title>

        <meta name="msapplication-tap-highlight" content="no" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/apexcharts.css" />
        <link rel="stylesheet" href="../css/tippy/tippy.css" />
        <link rel="stylesheet" href="../css/flatpickr.min.css" />
        <link rel="stylesheet" href="../css/select2.min.css" />
        <link rel="stylesheet" href="../css/quill/quill.snow.css" />
        <link rel="stylesheet" href="../css/quill/quill.core.css" />
        <link rel="stylesheet" href="../css/filepond.min.css" />
        <link rel="stylesheet" href="../css/filepond-plugin-image-preview.min.css" />
        <link rel="stylesheet" href="../css/swiper-bundle.min.css" />
        <link rel="stylesheet" href="../css/photoswipe.css" />
        <link rel="shortcut icon" href="../img/UB.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="../css/main.css" rel="stylesheet">
    </head>

    <body>

        <div class="page-wrapper">
            <aside class="sidebar">
                <div class="sidebar__container">
                    <div class="sidebar__top" style="display:flex; flex-direction:column; align-items:center;">
                        <div class="container container--sm" style="margin-top:4em;">
                            <a class="sidebar__logo" href="./">
                                <img src="../img/UB.png" height="90px" width="140px" alt="#" />
                            </a>
                        </div>

                    </div>
                    <div class="sidebar__content" data-simplebar="data-simplebar">
                        <nav class="sidebar__nav" style="margin-top: 5em;">
                            <ul class="sidebar__menu">
                                <li class="sidebar__menu-item">
                                    <a class="sidebar__link" href="./?content=dashboard" aria-expanded="false">
                                        <span class="sidebar__link-icon">
                                            <svg class="icon-icon-dashboard">
                                                <use xlink:href="../img/icons/icon-dashboard.svg#icon-dashboard"></use>
                                            </svg>
                                        </span>
                                        <span class="sidebar__link-text">Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar__menu-item"><a class="sidebar__link" data-toggle="collapse" data-target="#Payers" aria-expanded="false"><span class="sidebar__link-icon">
                                            <svg class="icon-icon-user">
                                                <use xlink:href="../img/icons/icon-user.svg#icon-user"></use>

                                            </svg></span><span class="sidebar__link-text">Payers</span><span class="sidebar__link-arrow">
                                            <i class="uil uil-angle-down"></i>

                                        </span></a>

                                    <div class="collapse hide" id="Payers">
                                        <ul class="sidebar__collapse-menu">
                                            <li class="sidebar__menu-item">
                                                <a class="sidebar__link" href="./?content=register" aria-expanded="true">
                                                    <span class="sidebar__link-icon">
                                                        <i class="uil uil-plus-circle"></i>
                                                    </span>
                                                    <span class="sidebar__link-text">Register</span>
                                                </a>
                                            </li>
                                            <li class="sidebar__menu-item">
                                                <a class="sidebar__link" href="./?content=deregister" aria-expanded="true">
                                                    <span class="sidebar__link-icon">
                                                        <svg class="icon-icon-trash">
                                                            <use xlink:href="../img/icons/icon-trash.svg#icon-trash"></use>
                                                        </svg>
                                                    </span>
                                                    <span class="sidebar__link-text">Deregister</span>
                                                </a>
                                            </li>


                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar__menu-item"><a class="sidebar__link" data-toggle="collapse" data-target="#Transactions" aria-expanded="false"> <span class="sidebar__link-icon">
                                            <svg class="icon-icon-invoice">
                                                <use xlink:href="../img/icons/icon-invoice.svg#icon-invoice"></use>
                                            </svg>
                                        </span><span class="sidebar__link-text">Transactions</span><span class="sidebar__link-arrow">
                                            <i class="uil uil-angle-down"></i>

                                        </span></a>

                                    <div class="collapse hide" id="Transactions">
                                        <ul class="sidebar__collapse-menu">
                                            <li class="sidebar__menu-item">
                                                <a class="sidebar__link" href="./?content=register" aria-expanded="true">
                                                    <span class="sidebar__link-icon">
                                                        <i class="uil uil-eye"></i>
                                                    </span>
                                                    <span class="sidebar__link-text">View payments</span>
                                                </a>
                                            </li>
                                            <li class="sidebar__menu-item">
                                                <a class="sidebar__link" href="./?content=newPayment" aria-expanded="true">
                                                    <span class="sidebar__link-icon">
                                                        <i class="uil uil-plus-circle"></i>
                                                    </span>
                                                    <span class="sidebar__link-text">New payment</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>


                                <li class="sidebar__menu-item"><a class="sidebar__link" href="controllers/logout.php" aria-expanded="false"><span class="sidebar__link-icon">
                                            <i class="uil uil-sign-out-alt"></i></span><span class="sidebar__link-text">Logout</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </aside>
            <main class="page-content">

                <div class="container">

                    <?php if ($content === 'dashboard') : ?>
                        <div class="toolbox">
                            <div class="toolbox__row row gutter-bottom-xs">
                                <div class="toolbox__left col-12 col-lg">
                                    <div class="toolbox__left-row row row--xs gutter-bottom-xs">
                                        <div class="form-group form-group--inline col-12 col-sm-auto">
                                            <label class="form-label">Show</label>
                                            <div class="input-group input-group--white input-group--append">
                                                <input class="input input--select" type="text" value="10" size="1" data-toggle="dropdown" readonly><span class="input-group__arrow">
                                                    <svg class="icon-icon-keyboard-down">
                                                        <use xlink:href="../img/icons/icon-keyboard-down.svg#icon-keyboard-down"></use>
                                                    </svg></span>
                                                <div class="dropdown-menu dropdown-menu--right dropdown-menu--fluid js-dropdown-select"><a class="dropdown-menu__item active" href="#" tabindex="0" data-value="10">10</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="15">15</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="20">20</a>
                                                    <a class="dropdown-menu__item" href="#" tabindex="0" data-value="25">25</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="50">50</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group--inline col col-sm-auto">
                                            <div class="input-group input-group--white input-group--prepend input-group--append">
                                                <div class="input-group__prepend">
                                                    <svg class="icon-icon-calendar">
                                                        <use xlink:href="../img/icons/icon-calendar.svg#icon-calendar"></use>
                                                    </svg>
                                                </div>
                                                <input class="input input--select js-datepicker" type="text" value="<?= date("d.m.y") ?> / <?= date("d.m.y") ?>"><span class="input-group__arrow">
                                                    <svg class="icon-icon-keyboard-down">
                                                        <use xlink:href="../img/icons/icon-keyboard-down.svg#icon-keyboard-down"></use>
                                                    </svg></span>
                                            </div>
                                        </div>
                                        <div class="form-group form-group--inline col-12 col-sm-auto d-none d-sm-block">
                                            <div class="toolbox__status input-group input-group--white input-group--append">
                                                <input class="input input--select" type="text" value="Originator" data-toggle="dropdown" readonly><span class="input-group__arrow">
                                                    <svg class="icon-icon-keyboard-down">
                                                        <use xlink:href="img/icons/icon-keyboard-down.svg#icon-keyboard-down"></use>
                                                    </svg></span>
                                                <div class="dropdown-menu dropdown-menu--right dropdown-menu--fluid js-dropdown-select"><a class="dropdown-menu__item active" href="#" tabindex="0" data-value="Originator"><span class="marker-item"></span> Originator</a>
                                                    <a class="dropdown-menu__item" href="#" tabindex="0" data-value="RRA"><span class="marker-item color-green"></span> RRA</a><a class="dropdown-menu__item" href="#" tabindex="0" data-value="Unguka"><span class="marker-item color-blue"></span> Unguka</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="toolbox__right col-12 col-lg-auto">
                                    <div class="toolbox__right-row row row--xs flex-nowrap">
                                        <div class="col col-lg-auto">
                                            <form class="toolbox__search" method="GET">
                                                <div class="input-group input-group--white input-group--prepend">
                                                    <div class="input-group__prepend">
                                                        <svg class="icon-icon-search">
                                                            <use xlink:href="../img/icons/icon-search.svg#icon-search"></use>
                                                        </svg>
                                                    </div>
                                                    <input class="input" type="text" placeholder="Search payers">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-wrapper">
                            <div class="table-wrapper__content table-orders table-collapse scrollbar-thin scrollbar-visible" data-simplebar>
                                <table class="table table--lines">
                                    <colgroup>
                                        <col class="colgroup-1">
                                        <col class="colgroup-2">
                                        <col class="colgroup-3">
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead class="table__header">
                                        <tr class="table__header-row">

                                            <th class="d-none d-lg-table-cell"><span>RequestId</span>
                                            </th>
                                            <th class="table__th-sort d-none d-sm-table-cell" style="margin-left: 30px;"><span class="align-middle">Customer Name</span><span class="sort sort--down"></span>
                                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">TIN</span><span class="sort sort--down"></span>
                                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">Account</span><span class="sort sort--down"></span>
                                            </th>
                                            <th class="table__th-sort"><span class="align-middle">Currency</span><span class="sort sort--down"></span>
                                            </th>

                                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">NID</span><span class="sort sort--down"></span>
                                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">Originator</span><span class="sort sort--down"></span>
                                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">Action</span><span class="sort sort--down"></span>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $query = "select * from etaxpayers";
                                        $result = mysqli_query($db_mysql, $query);

                                        while ($row = mysqli_fetch_array($result)) {
                                            $nid = $row['Nid'];
                                            $requestId = $row['RequestId'];
                                            $tin = $row['Tin'];
                                            $names = $row['Names'];
                                            $account = $row['Account'];
                                            $currency = $row['Currency'];
                                            $originator = $row['originator'];
                                            $vphone = $row['Phone'];
                                        ?>

                                            <tr class="table__row">
                                                <td class="d-none d-lg-table-cell table__td"><span class="text-grey"><?= $requestId ?></span></td>
                                                <td class="d-none d-lg-table-cell table__td"><span class="text-grey"><?= $names ?></span></td>
                                                <td class="table__td"><span class="text-grey"><?= $tin ?></span></td>
                                                <td class="table__td"><span class="text-grey"><?= $account ?></td>
                                                <td class="table__td"><span class="text-grey"><?= $currency ?></td>
                                                <td class="table__td"><span class="text-grey"><?= $nid ?></td>
                                                <td class="table__td"><span class="text-grey"><?= $originator ?></td>

                                                <td class="table__td table__actions">
                                                    <div class="items-more">
                                                        <button class="items-more__button">
                                                            <svg class="icon-icon-more">
                                                                <use xlink:href="img/icons/icon-more.svg#icon-more"></use>
                                                            </svg>
                                                        </button>


                                                        <div class="dropdown-items dropdown-items--right">
                                                            <div class="dropdown-items__container">
                                                                <ul class="dropdown-items__list">
                                                                    <li class="dropdown-items__item"><a class="dropdown-items__link detail_button" href="./?content=clientsDetails&requestId=<?= $requestId ?>"><span class="dropdown-items__link-icon">
                                                                                <svg class="icon-icon-view">
                                                                                    <use xlink:href="img/icons/icon-view.svg#icon-view"></use>
                                                                                </svg></span>Details</a>
                                                                    </li>

                                                                    <li class="dropdown-items__item"><a class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                                                                <svg class="icon-icon-trash">
                                                                                    <use xlink:href="img/icons/icon-trash.svg#icon-trash"></use>
                                                                                </svg></span>Deregister</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>

                            </div>


                        </div>

                    <?php
                    elseif ($content === 'register') : ?>
                        <?php include("views/forms/registration_form.php") ?>
                    <?php elseif ($content === 'deregister') : ?>
                        <?php include("views/forms/deregistration_form.php") ?>
                    <?php elseif ($content === 'newPayment') : ?>
                        <?php include("views/forms/payment_form.php"); ?>
                    <?php elseif ($content === 'clientsDetails') : ?>
                        <?php include("views/client_details.php"); ?>
                    <?php elseif ($content === 'logout') : ?>
                        <?php include("controllers/logout.php"); ?>
                    <?php endif; ?>

                </div>
            </main>
        </div>

        <script src="../js/photoswipe/photoswipe-lightbox.esm.min.js" type="module"></script>
        <script src="../js/global.js"></script>
        <script src="../js/photoswipe/photoswipe.esm.min.js" type="module"></script>
        <script src="../js/gsap/gsap.min.js"></script>
        <script src="../js/gsap/ScrollToPlugin.min.js"></script>
        <script src="../js/gsap/ScrollTrigger.min.js"></script>
        <script src="../js/vendor/popper.min.js"></script>
        <script src="../js/vendor/jquery.min.js"></script>
        <script src="../js/vendor/bootstrap.bundle.min.js"></script>
        <script src="../js/vendor/imagesloaded.pkgd.min.js"></script>
        <script src="../js/vendor/simplebar.min.js"></script>
        <script src="../js/vendor/tippy-bundle.umd.min.js"></script>
        <script src="../js/vendor/grid/masonry.pkgd.min.js"></script>
        <script src="../js/vendor/grid/isotope.pkgd.min.js"></script>
        <script src="../js/vendor/charts/circle-progress.min.js"></script>
        <script src="../js/vendor/charts/echarts.common.min.js"></script>
        <script src="../js/vendor/charts/apexcharts/apexcharts.min.js"></script>
        <script src="../js/vendor/cleave/cleave.min.js"></script>
        <script src="../js/vendor/cleave/addons/cleave-phone.us.js"></script>
        <script src="../js/vendor/fitty.min.js"></script>
        <script src="../js/vendor/jqvmap/jquery.vmap.min.js"></script>
        <script src="../js/vendor/jqvmap/jquery.vmap.world.js"></script>
        <script src="../js/vendor/jqvmap/jquery.vmap.sampledata.js"></script>
        <script src="../js/vendor/jquery.star-rating-svg.min.js"></script>
        <script src="../js/vendor/calendar/flatpickr/flatpickr.min.js"></script>
        <script src="../js/vendor/calendar/flatpickr/en.js"></script>
        <script src="../js/vendor/select2.min.js"></script>
        <script src="../js/vendor/editors/quill.min.js"></script>
        <script src="../js/vendor/filepond/filepond-plugin-image-preview.min.js"></script>
        <script src="../js/vendor/filepond/filepond.min.js"></script>
        <script src="../js/vendor/swiper-bundle.min.js"></script>
        <script src="../js/vendor/scrollmagic/ScrollMagic.min.js"></script>
        <script src="../js/vendor/scrollmagic/debug.addIndicators.min.js"></script>
        <script src="../js/components.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/common.js"></script>
    </body>

    </html>