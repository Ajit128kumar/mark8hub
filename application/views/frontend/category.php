<script>
    function myFunctionn(id) {
        var x = document.getElementById(id);
        var y = document.getElementById('fa_val_'+id);
        if (x.style.display === "none") {
            x.style.display = "block";
            y.classList.add("fa-arrow-circle-up");
            y.classList.remove("fa-arrow-circle-down");

        } else {
            x.style.display = "none";
            y.classList.add("fa-arrow-circle-down");
            y.classList.remove("fa-arrow-circle-up");

        }
    }
</script>
<div class="" style="background-color: #f5f8fa;">
    <div class="container margin_80_55">
        <div class="main_title_2" style="margin-bottom: 45px;">
            <span><em></em></span>
            <h2><?php echo get_phrase('popular_categories'); ?></h2>
        </div>
        <div class="row justify-content-center">
            <?php
            $this->db->order_by('name', 'asc');
            $categories = $this->crud_model->get_categories()->result_array();
            $parent_categories = $this->crud_model->get_parent_categories();
            foreach ($parent_categories as $category):
                $count = $this->crud_model->get_listing_count_from_category($category['id']);
                ?>

                <div class="col-md-4 mb-3 cat_in_page_">
                    <div class="cat_in_pgimg_">
                        <img src="<?php echo base_url('uploads/category_thumbnails/' . $category['thumbnail']); ?>"/>
                        <div class="category-title">
                            <a href="<?php echo site_url('home/filter_listings?category=' . slugify($category['name']) . '&&amenity=&&video=0&&status=all'); ?>"
                             style="color: unset;"><?php echo $category['name']; ?> <small
                             style='font-size: 12px; margin-left: 5px;'>(<?php echo $count; ?>)</small></a>&nbsp;&nbsp;&nbsp;&nbsp;
                             <?php

                             $this->db->order_by('name', 'asc');
                             $sub_categories = $this->crud_model->get_sub_categories($category['id']);
//                        echo '<pre>';
//                        print_r($sub_categories);
//                        echo '</pre>';
                             if (count($sub_categories->result_array())>0):
                                ?>
                                <i class="fa fa-arrow-circle-down" id="fa_val_<?= $category['id'] ?>" onclick="myFunctionn(<?= $category['id'] ?>)"><span style="margin-left: 5px;">Sub</span></i>
                                <?php
                            endif;
                            ?>

                        </div>
                    </div>

                    <div class="cat_drop_dwn_" style="display: none;" id="<?= $category['id'] ?>">
                        <?php
                        foreach ($sub_categories->result_array() as $sub_category):
                            $sub_count = $this->crud_model->get_listing_count_from_category($sub_category['id']);
                            ?>
                            <a href="<?php echo site_url('home/filter_listings?category=' . slugify($sub_category['name']) . '&&amenity=&&video=0&&status=all'); ?>"
                             class="sub-category-link">
                             <div class="sub-category">
                                <span class="sub-category-number"> <i
                                    class="<?php echo $sub_category['icon_class']; ?>"></i> </span>
                                    <span class="sub-category-title"> <?php echo $sub_category['name']; ?> (<?php echo $sub_count; ?>)</span>
                                    <span class="sub-category-arrow"><i class="fa fa-arrow-right"></i></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>


                <?php

            endforeach;



            ?>
        </div>
    </div>
</div>

