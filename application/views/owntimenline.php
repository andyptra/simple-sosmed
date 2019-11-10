<div class="col-lg-6">
    <div class="loadMore">

        <?php foreach ($timeline as $val) {
            ?>
            <div class="central-meta item">
                <div class="user-post">
                    <div class="friend-info">
                        <figure>
                            <?php
                                $is_url = substr($val->photo, 0, 4);
                                if ($is_url == 'http') {
                                    ?>
                                <img src="<?php echo $val->photo; ?>" alt="">
                            <?php
                                } else {
                                    ?>
                                <img src="<?php echo base_url() . 'public/uploads/' . $val->photo; ?>" alt="">
                            <?php
                                }

                                ?>

                        </figure>
                        <div class="friend-name">
                            <ins><a href="#" title=""><?php echo $val->full_name; ?></a></ins>
                            <span>published: <?php echo date('d F Y', strtotime($val->date));
                                                    echo "&nbsp;" . date('h:i A', strtotime($val->date)); ?> Genre Music</span>
                        </div>
                        <div class="post-meta">
                            <div class="we-video-info">

                            </div>
                            <div class="description">

                                <?php
                                    $dt = getPost($val->post);
                                    if (is_array($dt)) {
                                        echo $dt['post'];
                                        if (!empty($dt['img'])) {
                                            foreach ($dt['img'] as $val) {
                                                echo "<img src=" . $val . " alt=''>";
                                            }
                                        }
                                    }

                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div><!-- centerl meta -->