<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico" type="image/ico">
    <title>Project Summary Dashboard</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/css/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <link href="<?= base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">

    <style type="text/css">
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

        .login-block {
            background: #FCFAFA;

            background: -webkit-linear-gradient(to bottom, #FCFAFA, #FCFAFA);

            background: linear-gradient(to bottom, #FCFAFA, #FCFAFA);

            float: left;
            width: 100%;
            padding: 50px 0;
        }

        .banner-sec {
            background: base url(assets/images/body4.jpg) no-repeat left bottom;
            background-size: cover;
            min-height: 500px;
            border-radius: 0 10px 10px 0;
            padding: 0;
        }

        .container {
            background: #f7f3f0;
            border-radius: 10px;
            box-shadow: 15px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .carousel-inner {
            border-radius: 0 10px 10px 0;
        }

        .carousel-caption {
            text-align: left;
            left: 5%;
        }

        .login-sec {
            padding: 50px 30px;
            position: relative;
        }

        .login-sec .copy-text {
            position: absolute;
            width: 80%;
            bottom: 20px;
            font-size: 13px;
            text-align: center;
        }

        .login-sec .copy-text i {
            color: #f2741f;
        }

        .login-sec .copy-text a {
            color: #E36262;
        }

        .login-sec h2 {
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 20px;
            color: #DE6262;
        }

        .login-sec h2:after {
            content: " ";
            width: 100px;
            height: 0px;
            background: #FEB58A;
            display: block;
            margin-top: 10px;
            border-radius: 3px;
            margin-left: auto;
            margin-right: auto
        }

        .btn-login {
            background: #DE6262;
            color: #fff;
            font-weight: 600;
        }

        .banner-text {
            width: 70%;
            position: absolute;
            bottom: 40px;
            padding-left: 20px;
        }

        .banner-text h2 {
            color: #fff;
            font-weight: 600;
        }

        .banner-text h2:after {
            content: " ";
            width: 100px;
            height: 10 px;
            background: #FFF;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
        }

        .banner-text p {
            color: #fff;
        }
    </style>
</head>


<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center"><img src="<?= base_url() ?>assets/component-images/logo.png" height="54"></h2>
                <h6 class="text-center" style="color: olive;">Project Summary Dashboard</h6>
                <br>

                <?= form_open('login/auth', ' id="Formulir" '); ?>

                <div class="form-group">
                    <label for="exampleInputEmail1">NRP</label>
                    <input name="username" type="text" class="form-control input-lg"
                        placeholder="Masukkan nomor NRP anda" required autofocus />


                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control input-lg"
                        placeholder="Masukkan password anda" required />

                </div>


                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        <small>Remember Me</small>
                    </label>
                    <button type="submit" class="btn btn-login float-right" id="submitform">Submit</button>
                </div>

                </form>

                <div class="copy-text" style="font-size: 11px;"><b>A-System|Dash 01.2023 <i>02-02-2023</i> </b></div>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="<?= base_url() ?>assets/images/proyek.jpg"
                                alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</section>
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="<?= base_url() ?>assets/javascripts/theme.js"></script>
<script src="<?= base_url() ?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?= base_url() ?>assets/javascripts/theme.init.js"></script>
<script>

    $(function () {

        <?php if (session()->has("warning")) { ?>
            Swal.fire({
                icon: 'warning',
                text: '<?= session("warning") ?>',
                width: '50%',  // Sesuaikan dengan lebar yang diinginkan
                customClass: {
                    content: 'custom-swal-content-class',  // Tambahkan kelas khusus untuk kontennya
                },
            })
        <?php } ?>
    });
    document.getElementById("Formulir").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform").setAttribute('disabled', 'disabled');
        $('#submitform').html('Loading ...');
        var form = $('#Formulir')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                window.setTimeout(function () {
                    document.getElementById("submitform").removeAttribute('disabled');
                    $('#submitform').html('Login');
                    var objek = Object.keys(data.errors);
                    for (var key in data.errors) {
                        if (data.errors.hasOwnProperty(key)) {
                            var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                            $('.' + key).addClass('has-error');
                            $('input[name="' + key + '"]').after(msg);
                        }
                    }
                }, 500);
                return false;
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform").removeAttribute('disabled');
                document.getElementById("Formulir").reset();
                $('#submitform').html('Login');
                Swal.fire({
                    icon: 'success',
                    title: 'Notifikasi',
                    text: "Berhasil login",
                    width: '50%',  // Sesuaikan dengan lebar yang diinginkan
                    customClass: {
                        content: 'custom-swal-content-class',  // Tambahkan kelas khusus untuk kontennya
                    },
                });
                window.location = '<?= base_url() ?>' + data.beranda;
            }
        }).fail(function (data) {
            document.getElementById("submitform").removeAttribute('disabled');
            $('#submitform').html('Login');
            Swal.fire({
                icon: 'error',
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                width: '50%',  // Sesuaikan dengan lebar yang diinginkan
                customClass: {
                    content: 'custom-swal-content-class',  // Tambahkan kelas khusus untuk kontennya
                },
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });

</script>