<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
     <!-- Navbar  -->
     <nav class="navbar">
        <div class="container-fluid">
            <div class="col pb-md-4">
                <h4 class="title-navbar"> SMT Slider </h4>
            </div>
            <div class="col pb-md-4 d-flex me-5">
                <button id="dekstopbutton" style="background:transparent;border:none;"><i class="icon fa-solid fa-desktop"></i></button>
                <button id="tabletbutton" style="background:transparent;border:none;"><i class="icon fa-solid fa-tablet mx-3"></i></button>
                <button id="mobilebutton" style="background:transparent;border:none;"><i class="icon fa-solid fa-mobile"></i></button>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="sidebar col-md-3 shadow">
            <!-- sidebar -->
            <div class="col-md-12 d-flex justify-content-between pe-md-3 pt-2">
                <div class="setting-image-icon mx-md-auto text-center" onclick="toggleSettingImageForm()">
                    <i class=" fa-solid fa-image"></i>
                    <h6> Advanced</h6>
                </div>
                <div class="custom-css-icon  text-center me-md-5" onclick="toggleCustomCSSForm()">
                    <i class=" fa-solid fa-border-top-left"></i>
                    <h6>Style</h6>
                </div>
            </div>
            <hr style="margin-top:-5px;">
            <div class="col">
                <div class="setting-image-form" id="settingImageForm">
                    <?php
                    // Ambil nilai ID dari permintaan
                    $id = $_GET['id'];
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'smt_slider';
                    $data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
                    if ($data) {
                    ?>
                    <h6 class="ms-md-4 ms-4 mb-3"> Slider </h6>
                    <div class="form-group px-4 col-md-8">
                        <span>Title</span>
                        <input class="form-field" type="text" value="<?php echo $data->name; ?>" readonly>
                    </div>
                    <div class="form-group px-4 col-md-8 mt-3">
                        <span>Type</span>
                        <input class="form-field" type="text" value="<?php echo $data->type; ?>" readonly>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-container">
                        <div class="form-item">
                            <!-- Delete -->
                            <div class="col d-flex justify-content-between px-md-4 mt-4 ms-4 ms-md-0">
                                <div>
                                    <h6> Image </h6>
                                </div>
                                <form method="post">
                                    <select name="selected_slider">
                                        <?php
                                        global $wpdb;
                                        $table_smt_img = $wpdb->prefix . 'smt_img';
                                        $id = $_GET['id'];
                                        $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id");
                                        if (!empty($data_images)) {
                                            ?>
                                            <option value="">Pilih Slider</option>
                                            <?php foreach ($data_images as $image): ?>
                                                <option value="<?= $image->id_img ?>" data-title="<?= $image->title ?>"><?= $image->title ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="edit_id" value="<?php echo esc_attr($id); ?>">
                                        <button type="submit" name="delete_slider" class="delete-link">Delete</button>
                                        <?php
                                    } else {
                                        echo "Tidak ada slider yang tersedia.";
                                    }
                                    ?>
                                </form>
                            </div> 
                            <!-- End Delete -->
                            <?php
                            $id_slider = $_GET['id']; 
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'smt_img'; 
                            $query = $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE id_slider = %d", $id_slider);
                            $count = $wpdb->get_var($query);
                            $id_slider_exists = ($count > 0);
                            ?>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                const typeOfSlider = "<?php echo $data->type; ?>"; 
                                if (typeOfSlider !== "Paralax") {
                                $('.bg-image-button').hide(); 
                                $('.bg-image-preview-wrapper').hide();
                                }
                                

                                })
                            </script>
                            <?php if ($id_slider_exists) 
                            { 
                            ?>
                            <?php
                            if (  isset( $_POST['image_attachment_id'] ) ) :
                                    update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
                                endif;
                                wp_enqueue_media();
                                ?>
                            <?php
                            $my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

                            global $wpdb;
                            $table_smt_img = $wpdb->prefix . 'smt_img';
                            $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ");
                            ?>
                            <div class="mt-3 ms-md-4 ms-4">
                                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">

                                <!-- // start multiple_form -->
                                <div id="multiple_form">

                                    <!-- start form-container -->
                                    <div class="form-container">
                                        <input type="hidden" name="action" value="insert_img_callback">
                                        <!-- Upload Image  -->
                                            <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
                                            <input type='hidden' name='image_attachment_id[]' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
                                            <div class='image-preview-wrapper mt-3 ms-4 ms-md-4'>
                                                <img id='image-preview' style="border: 2px solid black;" src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='200'>
                                            </div>
                                        <!-- End Upload Image -->
                                        <!-- Upload Background -->
                                            <?php
                                                if (isset($_POST['bg_image_attachment_id'])) {
                                                    update_option('bg_media_selector_attachment_id', absint($_POST['bg_image_attachment_id']));
                                                }
                                                wp_enqueue_media();
                                                $bg_saved_attachment_post_id = get_option('bg_media_selector_attachment_id');
                                            ?>
                                            <input id="upload_bg_image_button" type="button" class="button bg-image-button" value="<?php _e( 'Unggah gambar latar belakang' ); ?>" />
                                            <input type='hidden' name='bg_image_attachment_id[]' id='bg_image_attachment_id' value='<?php echo get_option( 'bg_media_selector_attachment_id' ); ?>'>
                                            <div class='bg-image-preview-wrapper mt-3 ms-4 ms-md-4'>
                                                <img id='bg-image-preview' style="border: 2px solid black;" src='<?php echo wp_get_attachment_url( get_option( 'bg_media_selector_attachment_id' ) ); ?>' width='200'>
                                            </div>
                                        <!-- End BG -->
                                        <div class="form-group px-md-4 px-4 d-flex justify-content-between" >
                                            <label> Title </label>
                                            <input class="form-control" type="text" name ="title[]" placeholder="Title" style="width:50%;height:5px;">
                                        </div>
                                        <div class="form-group px-md-4 px-4 d-flex justify-content-between mt-3" >
                                            <label> Link </label>
                                            <input class="form-control" type="text" name ="link[]" placeholder="Https" autocomplete="off" style="width:50%;height:5px;">
                                        </div>
                                        <div class="ms-md-4 mt-3 ms-4">
                                            <label class="form-label" >Description : </label>
                                            <textarea name="desc[]" id="" cols="21" rows="3" style="border: 1px solid #CDD9ED; color: #99A3BA;">Desc</textarea>
                                        </div>
                                        <hr class="my-3 ms-4" width="85%;">
                                        <input type="hidden" name="id_img[]" value="">

                                        <!-- end form-container -->
                                    </div>

                                    <!-- end multiple form -->
                                </div>


                                <div id="additional_fields">
                                    <!-- Konten hasil copy div field ke sini -->

                                </div>

                                <button type="button" id="add_field">Add Field</button>

                                <div class="col justify-content-between d-flex px-md-5 px-4 mb-4">
                                    <input type="hidden" name="edit_id" value="<?php echo esc_attr($id); ?>">
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=dashboard')); ?>" class="back">Back</a>
                                    <button class="button-18" id="submit" role="button" name="submit">Save</button>
                                </div>

                                </form>
                            </div>
                            <?php 
                            }else{ 
                            ?>
                            <?php
                            if (  isset( $_POST['image_attachment_id'] ) ) :
                                    update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
                                endif;
                                wp_enqueue_media();
                                ?><div class="mt-3 ms-md-4 ms-4">
                                    <form method='post' id="upload_img">
                                    <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
                                </form>
                                </div>
                            <?php
                            $my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
                            ?>
                            <div class="mt-3 ms-md-4 ms-4">
                                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">

                                <!-- start multiple_form -->
                                <div id="multiple_form">
                                    <!-- start form-container -->
                                    <div class="form-container">
                                        <input type="hidden" name="action" value="insert_img_callback">
                                        <!-- Upload Image  -->
                                            <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
                                            <input type='hidden' name='image_attachment_id[]' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
                                            <div class='image-preview-wrapper mt-3 ms-4 ms-md-4'>
                                                <img id='image-preview' style="border: 2px solid black;" src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='200'>
                                            </div>
                                        <!-- End Upload Image -->
                                        <!-- Upload Background -->
                                            <?php
                                                if (isset($_POST['bg_image_attachment_id'])) {
                                                   // update_option('bg_media_selector_attachment_id', absint($_POST['bg_image_attachment_id']));
                                                    echo $_POST['bg_image_attachment_id'];
                                                }
                                                wp_enqueue_media();
                                                $bg_saved_attachment_post_id = get_option('bg_media_selector_attachment_id');
                                            ?>
                                            <input id="upload_bg_image_button" type="button" class="button bg-image-button" value="<?php _e( 'Unggah gambar latar belakang' ); ?>" />
                                            <input type='hidden' name='bg_image_attachment_id[]' id='bg_image_attachment_id' value='<?php echo get_option( 'bg_media_selector_attachment_id' ); ?>'>
                                            <div class='bg-image-preview-wrapper mt-3 ms-4 ms-md-4'>
                                                <img id='bg-image-preview' style="border: 2px solid black;" src='<?php echo wp_get_attachment_url( get_option( 'bg_media_selector_attachment_id' ) ); ?>' width='200'>
                                            </div>
                                        <!-- End BG -->
                                        <div class="form-group px-md-4 px-4 d-flex justify-content-between" >
                                            <label> Title </label>
                                            <input class="form-control" type="text" name ="title[]" placeholder="Title" style="width:50%;height:5px;">
                                        </div>
                                        <div class="form-group px-md-4 px-4 d-flex justify-content-between mt-3" >
                                            <label> Link </label>
                                            <input class="form-control" type="text" name ="link[]" placeholder="Https" autocomplete="off" style="width:50%;height:5px;">
                                        </div>
                                        <div class="ms-md-4 mt-3 ms-4">
                                            <label class="form-label" >Description : </label>
                                            <textarea name="desc[]" id="" cols="21" rows="3" style="border: 1px solid #CDD9ED; color: #99A3BA;">Desc</textarea>
                                        </div>
                                        <hr class="my-3 ms-4" width="85%;">
                                        <input type="hidden" name="id_img[]" value="">
                                        
                                        <!-- end form-container -->
                                    </div>
                                    <!-- end multiple form -->
                                </div>


                                <div id="additional_fields">
                                    <!-- Konten hasil copy div field ke sini -->

                                </div>

                                <button type="button" id="add_field">Add Field</button>

                                <div class="col justify-content-between d-flex px-md-5 px-4 mb-4">
                                    <input type="hidden" name="edit_id" value="<?php echo esc_attr($id); ?>">
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=dashboard')); ?>" class="back">Back</a>
                                    <button class="button-18" role="button" name="submit">Save</button>
                                </div>

                                </form>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="custom-css-form" id="customCSSForm">
                    <form>
                        <h4> Setting css</h4>
                    </form>
                </div>
            </div>
        </div> 
        <!-- View Slider -->
        <div class="content card col-md-9 mt-3" style="background-color:#fafafa;">
            <?php global $wpdb;
                $table_slider = $wpdb->prefix . 'smt_slider';
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = $_GET['id'];
                    $slider_data = $wpdb->get_row("SELECT * FROM $table_slider WHERE id = $id");
                    if ($slider_data) {
                        $type = $slider_data->type;
                        if ($type === 'Paralax') {
                            include 'Paralax.php'; 
                        } elseif ($type === 'Square') {
                            include 'Square.php'; // Ganti 'square.php' dengan nama file sesuai tipe "square"
                        } elseif ($type === 'Popup') {
                            include 'Popup.php'; // Ganti 'Popup.php' dengan nama file sesuai tipe "popup"
                        } else {
                            echo "Tipe tidak dikenali atau terjadi kesalahan.";
                        }
                    } else {
                        echo "Data slider tidak ditemukan.";
                    }
                } else {
                    echo "Parameter id tidak valid.";
                }
            ?>
        </div>       
    </div>

</body>

</html>

<style>
    #adminmenuback,
    #adminmenuwrap {
        display: none;
    }

    #wpcontent {
        margin-left: -20px !important;
        width: 100%;
    }

    #wpfooter {
        display: none;
    }

    body {
        background-color: white;
        overflow-x: hidden;
        overflow-y: hidden;


    }

    .navbar {
        background: #4fb359;
        width: 102%;
        height: 40px;
    }

    .title-navbar {
        color: #ffffff;
        font-size: 20px;

    }

    .icon {
        height: 30px;
        color: #ffffff;
        font-size: 20px;
    }

    h6 {
        font-size: 15px;
    }

    .sidebar {
        overflow-y: auto;
        height: 90vh;
    }

    .setting-image-icon,
    .custom-css-icon {
        padding: 10px;
        cursor: pointer;
    }

    .setting-image-form,
    .custom-css-form {
        display: none;
        /* Sembunyikan form secara default */
        padding: 10px;
    }

    /* Gaya ikon menggunakan Font Awesome */
    .setting-image-icon i,
    .custom-css-icon i {
        font-size: 20px;
    }

    :root {
        --input-color: #99A3BA;
        --input-border: #CDD9ED;
        --input-background: #fff;
        --input-placeholder: #CBD1DC;

        --input-border-focus: #275EFE;

        --group-color: var(--input-color);
        --group-border: var(--input-border);
        --group-background: #EEF4FF;

        --group-color-focus: #fff;
        --group-border-focus: var(--input-border-focus);
        --group-background-focus: #678EFE;
    }

    .form-field {
        display: block;
        width: 100%;
        height: 10px;
        padding: 8px 16px;
        line-height: 25px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
        -webkit-appearance: none;
        color: var(--input-color);
        border: 1px solid var(--input-border);
        background: var(--input-background);
        transition: border .3s ease;

        &::placeholder {
            color: var(--input-placeholder);
        }

        &:focus {
            outline: none;
            border-color: var(--input-border-focus);
        }
    }

    .form-group {
        position: relative;
        display: flex;
        width: 100%;

        &>span,
        .form-field {
            white-space: nowrap;
            display: block;

            &:not(:first-child):not(:last-child) {
                border-radius: 0;
            }

            &:first-child {
                border-radius: 6px 0 0 6px;
            }

            &:last-child {
                border-radius: 0 6px 6px 0;
            }

            &:not(:first-child) {
                margin-left: -1px;
            }
        }

        .form-field {
            position: relative;
            z-index: 1;
            flex: 1 1 auto;
            width: 1%;
            margin-top: 0;
            margin-bottom: 0;
        }

        &>span {
            height: 30px;
            text-align: center;
            padding: 0px 10px;
            font-size: 14px;
            line-height: 25px;
            color: var(--group-color);
            background: var(--group-background);
            border: 1px solid var(--group-border);
            transition: background .3s ease, border .3s ease, color .3s ease;
        }

        &:focus-within {
            &>span {
                color: var(--group-color-focus);
                background: var(--group-background-focus);
                border-color: var(--group-border-focus);
            }
        }
    }

    /* CSS */
    .button-18 {
        align-items: center;
        background-color: #0A66C2;
        border: 0;
        border-radius: 30px;
        box-sizing: border-box;
        color: #ffffff;
        cursor: pointer;
        font-family: Futura MD BT;
        font-size: 13px;
        font-weight: 550;
        line-height: 20px;
        max-width: 400px;
        min-height: 35px;
        overflow: hidden;
        padding: 0px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        touch-action: manipulation;
        transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
        user-select: none;
        -webkit-user-select: none;
        vertical-align: middle;
    }

    .button-18:hover,
    .button-18:focus {
        background-color: #678EFE;
        color: #ffffff;
    }

    .button-18:active {
        background: #09223b;
        color: rgb(255, 255, 255, .7);
    }

    .button-18:disabled {
        cursor: not-allowed;
        background: rgba(0, 0, 0, .08);
        color: rgba(0, 0, 0, .3);
    }

    .back {
        text-decoration: none;
        cursor: pointer;
    }

    .content {
        height: 80vh;
    }

    /* Gaya untuk tampilan desktop */
    .content.card {
        /* Gaya untuk card di tampilan desktop */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var settingImageForm = document.getElementById("settingImageForm");
        settingImageForm.style.display = "block";
    });

    function toggleSettingImageForm() {
        var settingImageForm = document.getElementById("settingImageForm");
        var customCSSForm = document.getElementById("customCSSForm");

        settingImageForm.style.display = "block";
        customCSSForm.style.display = "none";
    }

    function toggleCustomCSSForm() {
        var settingImageForm = document.getElementById("settingImageForm");
        var customCSSForm = document.getElementById("customCSSForm");

        settingImageForm.style.display = "none";
        customCSSForm.style.display = "block";
    }
</script>

<script>
    jQuery(document).ready(function($) {
        // Fungsi untuk mengubah ukuran card
        function dekstopsize() {
            var card = $('.content.card');
            // Tambahkan logika untuk mengubah lebar dan tinggi card sesuai yang Anda inginkan
            // Misalnya, Anda dapat menggunakan metode .css() untuk mengubah properti CSS
            card.css('width', '925px');
            card.css('height', '526px');
            card.css('margin', 'auto');
        }

        // Panggil fungsi untuk mengatur ukuran card saat halaman dimuat
        dekstopsize();

        // Tindakan ketika tombol "Mobile" diklik
        $('#mobilebutton').on('click', function() {
            // Tambahkan logika untuk mengubah ukuran card sesuai tampilan mobile
            // Contoh:
            var card = $('.content.card');
            card.css('width', '260px');
            card.css('height', '503px');
            card.css('margin', 'auto');
        });

        // Tindakan ketika tombol "Tablet" diklik
        $('#tabletbutton').on('click', function() {
            // Tambahkan logika untuk mengubah ukuran card sesuai tampilan tablet
            // Contoh:
            var card = $('.content.card');
            card.css('width', '668px');
            card.css('height', '503px');
            card.css('margin', 'auto');
        });

        // Tindakan ketika tombol "Dekstop" diklik
        $('#dekstopbutton').on('click', function() {
            // Panggil fungsi dekstopsize() untuk mengubah ukuran card sesuai tampilan desktop
            dekstopsize();
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteLinks = document.querySelectorAll(".delete-link");
        deleteLinks.forEach((link) => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const id = this.parentElement.querySelector("select[name='selected_slider']").value;
                const title = this.parentElement.querySelector("select[name='selected_slider']").selectedOptions[0].innerText;
                const url = `admin-post.php?action=delete_img&selected_slider=${id}&edit_id=<?php echo $_GET['id']; ?>`;
                this.setAttribute("data-id", id); // Update the data-id attribute
                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert this for slider "${title}"!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel",
                    iconHtml: '<i class="fa fa-trash"></i>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function() {
                            window.location.href = url;
                        }, 1000);
                        // Show success alert immediately
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    });
</script>


<script type="text/javascript">
    $('.form-container').on('click', '#upload_image_button', function(event) {
        event.preventDefault();

        var container = $(this).closest('.form-container');
        var file_frame = container.data('file_frame');

        if (!file_frame) {
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Pilih gambar',
                button: {
                    text: 'Gunakan gambar ini'
                },
                multiple: false 
            });

            container.data('file_frame', file_frame);
        }

        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            container.find('#image-preview').attr('src', attachment.url);
            container.find('#image_attachment_id').val(attachment.id);
        });

        file_frame.open();
    });
</script>

<script type='text/javascript'>
    jQuery(document).ready(function($) {
        $('.form-container').on('click', '#upload_bg_image_button', function(event) {
            event.preventDefault();

            var container = $(this).closest('.form-container');
            var bg_file_frame = container.data('bg_file_frame');

            if (!bg_file_frame) {
                bg_file_frame = wp.media.frames.bg_file_frame = wp.media({
                    title: 'Pilih gambar latar belakang',
                    button: {
                        text: 'Gunakan gambar ini'
                    },
                    multiple: false
                });

                container.data('bg_file_frame', bg_file_frame);
            }

            bg_file_frame.on('select', function() {
                var bg_attachment = bg_file_frame.state().get('selection').first().toJSON();
                container.find('#bg-image-preview').attr('src', bg_attachment.url);
                container.find('#bg_image_attachment_id').val(bg_attachment.id);
            });

            bg_file_frame.open();
        });
    });
</script>


// script buat copas div untuk multiple field
<script type='text/javascript'>
    $(document).ready(function() {
        var fieldCounter = 1; // To generate unique IDs for each field
        
        // the function below is to foreach based on data in db
        function populateFormFields(savedData) {
            savedData.forEach(function(data) {
                var additionalFields = $("#additional_fields");
                var multiFormDiv = $("#multiple_form").clone();

                // Populate fields with saved data
                multiFormDiv.find("input[name='title[]']").val(data.title);
                multiFormDiv.find("textarea[name='desc[]']").val(data.desc);
                multiFormDiv.find("input[name='link[]']").val(data.link);
                multiFormDiv.find("input[name='image_attachment_id[]']").val(data.img);
                multiFormDiv.find("input[name='bg_image_attachment_id[]']").val(data.bg_img);
                multiFormDiv.find("input[name='id_img[]']").val(data.id_img);

                // Modify attributes and IDs of the cloned elements
                multiFormDiv.find("input[name='title[]']").attr({
                    name: "title[]",
                    id: "field_title_" + fieldCounter
                });

                multiFormDiv.find("input[name='desc[]']").attr({
                    name: "desc[]",
                    id: "field_desc_" + fieldCounter
                });

                multiFormDiv.find("input[name='link[]']").attr({
                    name: "link[]",
                    id: "field_link_" + fieldCounter
                });

                multiFormDiv.find("img[id='image-preview']").attr({
                    src: data.img_url
                });

                multiFormDiv.find("img[id='bg-image-preview']").attr({
                    src: data.bg_img_url
                });

                var br = $("<br>");

                var deleteButton = $("<button>")
                .attr({
                    type: "submit",
                    id: "field_id_" + fieldCounter,
                    "data-id": data.id_img,
                    "data-title": data.title
                })
                .addClass("delete-button")
                .text("Delete Field")
                .click(function(event) {
                    // multiFormDiv.remove();
                    // br.remove();
                    event.preventDefault();

                    const id = $(this).data("id");
                    const title = $(this).data("title");
                    const url = `admin-post.php?action=delete_img&selected_slider=${id}&edit_id=<?php echo $_GET['id']; ?>`;

                    Swal.fire({
                        title: "Are you sure?",
                        text: `You won't be able to revert this for slider "${title}"!`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "Cancel",
                        iconHtml: '<i class="fa fa-trash"></i>',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setTimeout(function() {
                                window.location.href = url;
                            }, 1000);
                            // Show success alert immediately
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        }
                    });
                });
                

                // Append the populated form fields
                additionalFields.append(multiFormDiv);
                multiFormDiv.append(deleteButton);
                additionalFields.append(br);

                

                fieldCounter++;
            });
        }

        var savedData = [
            // Example saved data objects
            <?php foreach ($data_images as $key => $data) : ?>
            { title: "<?php echo $data->title ?>", desc: "<?php echo $data->desc ?>", link: "<?php echo $data->link ?>", img: "<?php echo $data->img ?>", img_url: "<?php echo wp_get_attachment_url( $data->img ) ?>" , bg_img_url: "<?php echo wp_get_attachment_url( $data->bg_img ) ?>" ,bg_img: "<?php echo $data->bg_img ?>" , id_img: "<?php echo $data->id_img ?>"  },
            <?php endforeach; ?>
            // Add more saved data objects as needed
        ];

        if (<?php echo $id_slider_exists ?>) {
            populateFormFields(savedData);
            $('#multiple_form').hide();
        } else {            
            $('#multiple_form').css('display', 'block');
        }

        $("#add_field").click(function() {
            var additionalFields = $("#additional_fields");

            if (<?php echo $id_slider ?>) {
                $('#multiple_form').css('display', 'block');
            }

            var multiFormDiv = $("#multiple_form").clone(); // Clone the original div
            
            // Reset values of cloned input fields
            multiFormDiv.find("input[name='title[]']").val('');
            multiFormDiv.find("input[name='link[]']").val('');
            multiFormDiv.find("textarea[name='desc[]']").val('Desc');
            multiFormDiv.find("img[name='image_attachment_id[]']").val('');

            // Modify attributes and IDs of the cloned elements
            multiFormDiv.find("input[name='title[]']").attr({
                name: "title[]",
                id: "field_title_" + fieldCounter
            });

            multiFormDiv.find("textarea[name='desc[]']").attr({
                name: "desc[]",
                id: "field_desc_" + fieldCounter
            });

            multiFormDiv.find("input[name='link[]']").attr({
                name: "link[]",
                id: "field_link_" + fieldCounter
            });

            var br = $("<br>");

            var deleteButton = $("<button>").attr({
                type: "button"
            }).text("Delete Field").click(function() {
                multiFormDiv.remove(); // Remove the cloned div
                br.remove();
            });

            additionalFields.append(multiFormDiv);
            multiFormDiv.append(deleteButton);
            additionalFields.append(br);


            fieldCounter++; // Increment the field counter for the next field

            if (<?php echo $id_slider ?>) {
                $('#multiple_form').css('display', 'none');
            }
        });

        $('#submit').on('click', function() {
            $('#multiple_form').remove();
        });


    });
</script>




