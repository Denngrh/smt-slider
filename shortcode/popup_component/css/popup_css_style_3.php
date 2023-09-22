<?php
global $wpdb;
$table_smt_css = $wpdb->prefix . 'smt_style';
$data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $project_id ");
$css_data = json_decode($data->style_data, true); {
?>

    <style>
        .row {
            visibility: hidden;
            opacity: 0;
            transition: 0.3s ease;
        }

        .custom-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            margin-left: auto;
            margin-right: auto;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            background-image: url('https://img.freepik.com/free-photo/abstract-background-blue-wallpaper-image_53876-108341.jpg?w=996&t=st=1695195401~exp=1695196001~hmac=6b2b45ea90321eda78cd0215461948dbd8c2a85ef10d9ba4fe035c9c48245302');
            padding: 20px;
            position: relative;
            /* margin-left: 25%;
                margin-right: 25%; */
            width: 500px;
            height: 500px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: row;
        }

        .percobaan {
            flex: 1;
            position: relative;
            display: inline-block;
            justify-content: center;
            align-items: center;

        }

        .popup-text-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: left;
            position: relative;
            top: 50px;
            margin: 0;
        }

        .close-button {
            position: absolute;
            cursor: pointer;
            top: 20px;
            left: 490px;
            height: 30px;
            width: 30px;
            font-size: 24px;
            background: none;
            border: none;
            color: #000;
            padding: 0;
            transition: 0.3s ease;
            box-sizing: border-box;
            opacity: 1;
            z-index: 10;
        }

        .close-button>svg>path {
            fill: #000;
        }

        .close-button:hover {
            color: black;
            background: none;
            opacity: 1;
        }

        .tombol {
            font-family: <?php echo $css_data['btn_fam'] ?>;
            color: <?php echo $css_data['btn_color'] ?>;
            background-color: <?php echo $css_data['btn_bg'] ?>;
            /* width: 59px;
                height: 23px; */
            transition: 0.4s ease;
            font-weight: 400;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 11px;
            width: 10%;
            margin-top: 1px;
            text-align: center;
            letter-spacing: normal;
            line-height: normal;
            gap: 10px;
        }

        .tombol:hover {
            color: <?php echo $css_data['btn_color_hvr'] ?>;
            background-color: <?php echo $css_data['btn_bg_hvr'] ?>;
        }


        .caret-right {
            z-index: 10;
            position: absolute;
            top: 230px;
            left: 490px;
            width: 40px;
            height: 40px;

            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .caret-left {
            z-index: 10;
            position: absolute;
            top: 230px;
            left: 10px;
            width: 40px;
            height: 40px;

            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        svg>path {
            fill: black;
        }

        .div-4 {
            display: inline-flex;
            align-items: flex-start;
            gap: 4px;
            position: absolute;
            top: 500px;
            left: 50%;
        }

        .ellipse {
            background-color: #5d5c5c;
            position: relative;
            width: 8px;
            height: 8px;
            border-radius: 4px;
        }

        .ellipse-2 {
            background-color: #eeeeee;
            position: relative;
            width: 8px;
            height: 8px;
            border-radius: 4px;
        }

        a {
            text-decoration: none !important;
        }

        .text {
            padding: 8px 0;
        }

        .text-wrapper-1 {
            font-family: <?php echo $css_data['title_fam'] ?>;
            color: <?php echo $css_data['title_color'] ?>;
            font-size: 38px;
            font-weight: 800;
            padding: 8px 0;
        }

        .text-wrapper-2 {
            font-family: <?php echo $css_data['desc_fam'] ?>;
            color: <?php echo $css_data['desc_color'] ?>;
            line-height: normal;
            font-size: 11px;
            overflow: hidden;

        }

        .dot {
            cursor: pointer;
            background-color: #5d5c5c;
            transition: background-color 0.6s ease;
        }

        .dot-div {
            text-align: center;
            position: absolute;
            bottom: 10px;
            /* Adjust this value to control the vertical position */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            /* Ensure dots are in front of images */
        }

        .active,
        .dot:hover {
            background-color: <?php echo $css_data['dots_bg_active'] ?>;
        }

        @media (max-width: 850px) {
            .popup-content {
                margin-left: 10%;
                margin-right: 10%;
            }

            .popup-image {
                height: 55vh;
            }
        }

        /* Media query for mobile screens */
        @media (max-width: 480px) {
            .popup-content {
                width: 328px;
                height: 328px;
            }

            .div-4 {
                top: 340px;
            }

            .tombol {
                width: 15%;
            }

            .caret-right {
                top: 142px;
                width: 32px;
                height: 32px;
            }

            .caret-left {
                top: 142px;
                width: 32px;
                height: 32px;
            }

            .caret-right>svg {
                width: 12px;
                height: 22px;
            }

            .caret-left>svg {
                width: 12px;
                height: 22px;
            }

            .caret-right {
                left: 245px;
            }

            .close-button {
                left: 245px;
                top: 16px;
            }

            .text-wrapper-1 {
                font-size: 24px;
            }

            .popup-text-container {
                top: 50px;
            }
        }
    </style>
<?php } ?>