<div class="col-lg-6">
  <div class="central-meta">
    <div class="frnds">
      <h5>Following</h5>
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active fade show " id="frends">
          <ul class="nearby-contct">
            <?php foreach ($followings as $val) {
              ?>

              <li>
                <div class="nearly-pepls">
                  <figure>
                    <a href="<?php echo base_url($val['username']) ?>" title=""> <?php
                                                                                    $is_url = substr($val['photo'], 0, 4);
                                                                                    if ($is_url == 'http') {
                                                                                      ?>
                        <img width="60" height="60" src="<?php echo $val['photo']; ?>" alt="">
                      <?php
                        } else {
                          ?>
                        <img width="60" height="60" src="<?php echo base_url() . 'public/uploads/' . $val['photo']; ?>" alt="">
                      <?php
                        }
                        ?></a>
                  </figure>
                  <div class="pepl-info">
                    <h4><a href="<?php echo base_url($val['username']) ?>" title=""><?php echo $val['full_name']; ?></a></h4>
                    <span>Genre Music : <?php echo "jazz" ?></span>
                    <?php if ($val['type'] == 1) {
                        ?>
                      <a href="<?php echo base_url() . 'follow/' . $val['username'] ?>" title="" class="add-butn" data-ripple="">Friends</a>
                    <?php
                      } else {
                        ?>
                      <a href="<?php echo base_url() . 'follow/' . $val['username'] ?>" title="" class="add-butn" data-ripple="">Following</a>
                    <?php
                      }
                      ?>
                  </div>
                </div>
              </li>
            <?php
            } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div><!-- centerl meta -->