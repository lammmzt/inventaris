<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('Assets/'); ?>LOGO SMANSA.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('Assets/'); ?>LOGO SMANSA.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('Assets/'); ?>LOGO SMANSA.png" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/')?>vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/')?>vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/')?>vendors/styles/style.css" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/'); ?>src/plugins/sweetalert2/sweetalert2.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            "gtm.start": new Date().getTime(),
            event: "gtm.js"
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != "dataLayer" ? "&l=" + l : "";
        j.async = true;
        j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?= base_url('/'); ?>" class="">
                    <img src="<?= base_url('Assets/')?>LOGO SMANSA.png" alt="" class="img-navbar" /> <span
                        class="text-black header-navbar">Inventory SMANSA</span>
                    <style>
                    .img-navbar {
                        width: 50px;
                        height: 50px;
                        padding: 5px;
                    }

                    .text-black {
                        color: black;
                    }

                    .text-white {
                        color: white;
                    }

                    .header-navbar {
                        margin: 10px;
                        font-size: 20px;
                        font-weight: bold;
                    }
                    </style>
                </a>
            </div>
            <div class="login-menu">

            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url('Assets/')?>vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login</h2>
                        </div>
                        <form id="form_login">
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Username"
                                    name="username" id="username" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********"
                                    name="password" id="password" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <input type="hidden" id="recaptcha_response" name="recaptcha_response" value="">
                            <div class="row pb-30">
                                <!-- <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div> -->

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
                                        <button class="btn btn-primary btn-lg btn-block text-white" id="btn_login"
                                            type="submit">Masuk</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome modal end -->
    <!-- js -->
    <script src="<?= base_url('Assets/')?>vendors/scripts/core.js"></script>
    <script src="<?= base_url('Assets/')?>vendors/scripts/script.min.js"></script>
    <script src="<?= base_url('Assets/')?>vendors/scripts/process.js"></script>
    <script src="<?= base_url('Assets/')?>vendors/scripts/layout-settings.js"></script>

    <script src="<?= base_url('Assets/'); ?>src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script>
    function getSwall(status, message) {
        swal({
            title: message,
            type: status == '200' ? 'success' : 'error',
            showCancelButton: false,
            showConfirmButton: true,
            timer: 1500
        })
    }

    // when type the password add icon on the right side input
    $("#password").on("keyup", function() {
        var value = $(this).val();
        if (value.length > 0) {
            $(this).next().find("i").removeClass("dw dw-padlock1").addClass("dw dw-eye");
        } else if (value.length == 0) {
            if ($(this).attr("type") == "password") {
                $(this).next().find("i").removeClass("dw dw-eye").addClass("dw dw-padlock1");
            } else {
                $(this).next().find("i").removeClass("icon-copy fa fa-eye-slash").addClass("dw dw-padlock1");
                $(this).attr("type", "password");
            }
        }
    });

    // when click the icon change the type of input
    $("#password").next().on("click", function() {
        var input = $(this).prev();
        var icon = $(this).find("i");
        // when class is dw dw dw-pdlock1
        if (icon.hasClass("dw dw-padlock1")) {
            $(this).attr("disabled", "disabled");
        } else {
            if (input.attr("type") == "password") {
                input.attr("type", "text");
                icon.removeClass("dw dw-eye").addClass("icon-copy fa fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("icon-copy fa fa-eye-slash").addClass("dw dw-eye");
            }
        }
    });

    $(document).ready(function() {
        $("#form_login").submit(function(e) {
            e.preventDefault();
            $("#btn_login").attr("disabled", "disabled");
            $("#btn_login").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            var username = $("#username").val();
            var password = $("#password").val();
            $.ajax({
                url: "<?= base_url('Auth/login') ?>",
                type: "POST",
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
                    getSwall(response.status, response.data);
                    if (response.status == '200') {
                        setTimeout(function() {
                            window.location.href =
                                "<?= base_url('Admin/Dashboard') ?>";
                        }, 1500);
                    } else {
                        $("#btn_login").removeAttr("disabled");
                        $("#btn_login").html('Masuk');
                    }
                }
            });
        });
    });
    </script>
</body>

</html>