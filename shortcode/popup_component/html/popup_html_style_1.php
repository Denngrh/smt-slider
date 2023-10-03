<div class="row " id="popup">
    <div class="col ">
        <div class="custom-popup ">
            <div class="popup-content">
                <div class="popup-text-container">
                    <?php foreach ($latest_data as $index => $data) : ?>
                    <div class="div_text">
                        <div class="text">
                            <div class="text-wrapper-1">
                            <<?php echo $css_data['title_size']; ?>><?php echo $data->title ?></<?php echo $css_data['title_size']; ?>>
                            </div>
                            <div class="text-wrapper-2">
                                <p>
                                <?php echo $data->desc ?>
                                </p>
                            </div>
                        </div>
                        <div class="link" data-id="0" data-image="<?php echo wp_get_attachment_url($data->img);  ?>">
                            <a href="<?php echo esc_url($data->link) ?>" target="_blank" rel="noopener noreferrer">
                                <div type="button" class="tombol"><?php echo $data->button_link ?></div>
                            </a>
                        </div>
                    <?php endforeach; ?>    
                    </div>
                </div>
                <button title="close" class="close-button"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.2807 14.2193C15.3504 14.289 15.4056 14.3717 15.4433 14.4628C15.4811 14.5538 15.5005 14.6514 15.5005 14.7499C15.5005 14.8485 15.4811 14.9461 15.4433 15.0371C15.4056 15.1281 15.3504 15.2109 15.2807 15.2806C15.211 15.3502 15.1283 15.4055 15.0372 15.4432C14.9462 15.4809 14.8486 15.5003 14.7501 15.5003C14.6515 15.5003 14.5539 15.4809 14.4629 15.4432C14.3718 15.4055 14.2891 15.3502 14.2194 15.2806L8.00005 9.06024L1.78068 15.2806C1.63995 15.4213 1.44907 15.5003 1.25005 15.5003C1.05103 15.5003 0.860156 15.4213 0.719426 15.2806C0.578695 15.1398 0.499634 14.949 0.499634 14.7499C0.499634 14.5509 0.578695 14.36 0.719426 14.2193L6.93974 7.99993L0.719426 1.78055C0.578695 1.63982 0.499634 1.44895 0.499634 1.24993C0.499634 1.05091 0.578695 0.860034 0.719426 0.719304C0.860156 0.578573 1.05103 0.499512 1.25005 0.499512C1.44907 0.499512 1.63995 0.578573 1.78068 0.719304L8.00005 6.93962L14.2194 0.719304C14.3602 0.578573 14.551 0.499512 14.7501 0.499512C14.9491 0.499512 15.1399 0.578573 15.2807 0.719304C15.4214 0.860034 15.5005 1.05091 15.5005 1.24993C15.5005 1.44895 15.4214 1.63982 15.2807 1.78055L9.06036 7.99993L15.2807 14.2193Z" fill="white" />
                    </svg></button>
                <?php foreach ($latest_data as $index => $data) : ?>
                <div class="slides">
                    <div class="caret-right"><svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.3843 14.8843L2.88434 27.3843C2.7682 27.5005 2.63032 27.5926 2.47858 27.6555C2.32684 27.7183 2.16421 27.7507 1.99996 27.7507C1.83572 27.7507 1.67308 27.7183 1.52134 27.6555C1.3696 27.5926 1.23172 27.5005 1.11559 27.3843C0.999449 27.2682 0.907324 27.1303 0.844471 26.9786C0.781617 26.8268 0.749268 26.6642 0.749268 26.5C0.749268 26.3357 0.781617 26.1731 0.844471 26.0213C0.907324 25.8696 0.999449 25.7317 1.11559 25.6156L12.7328 14L1.11559 2.38434C0.881036 2.14979 0.749268 1.83167 0.749268 1.49996C0.749268 1.16826 0.881036 0.850138 1.11559 0.615588C1.35014 0.381037 1.66826 0.249268 1.99996 0.249268C2.33167 0.249268 2.64979 0.381037 2.88434 0.615588L15.3843 13.1156C15.5006 13.2317 15.5928 13.3695 15.6557 13.5213C15.7186 13.673 15.7509 13.8357 15.7509 14C15.7509 14.1642 15.7186 14.3269 15.6557 14.4786C15.5928 14.6304 15.5006 14.7682 15.3843 14.8843Z" fill="white" fill-opacity="0.62" />
                        </svg></div>
                    <div class="caret-left"><svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.8844 25.6156C15.0005 25.7317 15.0926 25.8696 15.1555 26.0213C15.2184 26.1731 15.2507 26.3357 15.2507 26.5C15.2507 26.6642 15.2184 26.8268 15.1555 26.9786C15.0926 27.1303 15.0005 27.2682 14.8844 27.3843C14.7682 27.5005 14.6304 27.5926 14.4786 27.6555C14.3269 27.7183 14.1643 27.7507 14 27.7507C13.8358 27.7507 13.6731 27.7183 13.5214 27.6555C13.3696 27.5926 13.2318 27.5005 13.1156 27.3843L0.615631 14.8843C0.499411 14.7682 0.407213 14.6304 0.344307 14.4786C0.281402 14.3269 0.249023 14.1642 0.249023 14C0.249023 13.8357 0.281402 13.673 0.344307 13.5213C0.407213 13.3695 0.499411 13.2317 0.615631 13.1156L13.1156 0.615588C13.3502 0.381037 13.6683 0.249268 14 0.249268C14.3317 0.249268 14.6498 0.381037 14.8844 0.615588C15.1189 0.850138 15.2507 1.16826 15.2507 1.49996C15.2507 1.83167 15.1189 2.14979 14.8844 2.38434L3.26719 14L14.8844 25.6156Z" fill="white" fill-opacity="0.62" />
                        </svg></div>
                </div>
                <?php endforeach; ?>

                <div class="div-4">
                    <?php foreach ($latest_data as $index => $data) : ?>
                    <div class="ellipse dot" onclick="currentSlide(<?php echo $index ?>); "></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>