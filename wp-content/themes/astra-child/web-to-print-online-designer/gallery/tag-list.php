<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  
?>

<?php
$papersize_ids          = isset($_GET['size']) ? wc_clean($_GET['size']) : '';
$papercorner_ids        = isset($_GET['corners']) ? wc_clean($_GET['corners']) : '';
$orientations_ids       = isset($_GET['orientations']) ? wc_clean($_GET['orientations']) : '';
$filter_sizes           = $papersize_ids != '' ? explode(',', $papersize_ids) : array();
$filter_corners         = $papercorner_ids != '' ? explode(',', $papercorner_ids) : array();
$filter_orientations    = $orientations_ids != '' ? explode(',', $orientations_ids) : array();
$paper_sizes            = get_terms('paper_size', 'hide_empty=0');
$paper_corners          = get_terms('paper_corner', 'hide_empty=0');
$p_orientations         = get_terms('orientation', 'hide_empty=0');


if (is_tax('template_tag')) {
    $term = get_queried_object(); // Get the current term object
    $filter_tags = array($term->term_id); // Get the term ID
}



$selected_paper_size    = isset($_GET['size']) ? get_term_by('id', $filter_sizes[0], 'paper_size') : false;

$showOrientation = true;
if (count($p_orientations) <= 0) $showOrientation = false;
if ($selected_paper_size && $selected_paper_size->slug == '65x65-mm') $showOrientation = false;

ob_start();
?>


<div class="accordion accordion-flush mb-15" id="coolcardstagsaccordion">
    <h5><?php _e('Choose Filter', 'transparentcard'); ?></h5>
    <?php if (count($paper_sizes) > 0): ?>
        <div class="accordion-item active">
            <h2 class="accordion-header mb-0" id="paperTags">
                <button class="accordion-button collapsed w-full text-start" type="button" data-bs-toggle="collapse" data-bs-target="#transparentPaperSize" aria-expanded="false" aria-controls="transparentPaperSize">
                    <?php _e('Business Card Size', 'transparentcard'); ?>
                </button>
            </h2>
            <div id="transparentPaperSize" class="accordion-collapse collapse" aria-labelledby="paperTags" data-bs-parent="#coolcardstagsaccordion">
                <div class="accordion-body">
                    <div class="nbd-sidebar-con-inner">
                        <ul>
                            <?php foreach (array('85x55-mm', '89x51-mm', '65x65-mm', '85x40-mm') as $spaper):
                                $paper = get_term_by('slug', $spaper, 'paper_size');
                            ?>
                                <li class="nbd-gallery-filter-item">
                                    <a data-type="size" data-value="<?php echo ($paper->term_id); ?>" href="#" class="trns-nbd-tag-list-item <?php if (in_array($paper->term_id, $filter_sizes)) echo 'active'; ?>">
                                        <svg class="before" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4z" />
                                        </svg>
                                        <span><?php esc_html_e($paper->name); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (count($paper_corners) > 0): ?>
        <div class="accordion-item">
            <h2 class="accordion-header mb-0" id="taransparentColorCorner">
                <button class="accordion-button collapsed w-full text-start" type="button" data-bs-toggle="collapse" data-bs-target="#transparentBusinessCardCorner" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <?php _e('Corner', 'coolcards'); ?>
                </button>
            </h2>
            <div id="transparentBusinessCardCorner" class="accordion-collapse collapse" aria-labelledby="taransparentColorCorner" data-bs-parent="#coolcardstagsaccordion">
                <div class="accordion-body">
                    <div class="nbd-sidebar-con-inner">
                        <ul>
                            <?php foreach ($paper_corners as $paper): ?>
                                <li class="nbd-gallery-filter-item">
                                    <a data-type="corners" data-value="<?php echo ($paper->term_id); ?>" href="#" class="trns-nbd-tag-list-item <?php if (in_array($paper->term_id, $filter_corners)) echo 'active'; ?>">
                                        <svg class="before" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4z" />
                                        </svg>
                                        <span><?php esc_html_e($paper->name); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($showOrientation): ?>
        <div class="accordion-item <?php echo count($filter_orientations) > 0 ? 'active' : ''; ?>">
            <h2 class="accordion-header mb-0" id="transparentPaperOrientation">
                <button class="accordion-button collapsed w-full text-start" type="button" data-bs-toggle="collapse" data-bs-target="#transparentPaperrOrin" aria-expanded="false" aria-controls="transparentPaperrOrin">
                    <?php _e('Alignments', 'coolcards'); ?>
                </button>
            </h2>
            <div id="transparentPaperrOrin" class="accordion-collapse collapse" aria-labelledby="transparentPaperOrientation" data-bs-parent="#coolcardstagsaccordion">
                <div class="accordion-body">
                    <div class="nbd-sidebar-con-inner">
                        <ul>
                            <?php foreach ($p_orientations as $orientation): ?>
                                <li class="nbd-gallery-filter-item">
                                    <a data-type="orientations" data-value="<?php echo ($orientation->term_id); ?>" href="#" class="trns-nbd-tag-list-item <?php if (in_array($orientation->term_id, $filter_orientations)) echo 'active'; ?>">
                                        <svg class="before" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4z" />
                                        </svg>
                                        <span><?php esc_html_e($orientation->name); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php if (count($tags) > 0): ?>
        <div class="accordion-item <?php echo count($filter_tags) > 0 ? 'active' : ''; ?>">
            <h2 class="accordion-header mb-0" id="transparentPaperIndustry">
                <button class="accordion-button collapsed w-full text-start" type="button" data-bs-toggle="collapse" data-bs-target="#transparentPaperrOrin" aria-expanded="false" aria-controls="transparentPaperrOrin">
                    <?php _e('Industry', 'coolcards'); ?>
                </button>
            </h2>
            <div id="transparentPaperrOrin" class="accordion-collapse collapse" aria-labelledby="transparentPaperIndustry" data-bs-parent="#coolcardstagsaccordion">
                <div class="accordion-body">
                    <style>
                        .nbd-sidebar-con-inner li a {
                            font-size: 16px;
                        }

                        /* Scroll */
                        .industry-scroll {
                            max-height: 350px;
                            overflow: hidden;
                            overflow-y: scroll;
                        }

                        .industry-scroll::-webkit-scrollbar {
                            width: 8px;
                        }

                        .industry-scroll::-webkit-scrollbar-track {
                            background: #ebebeb;
                        }

                        .industry-scroll::-webkit-scrollbar-thumb {
                            width: 6px;
                            background: #002C2C;
                            border-radius: 5px;
                        }

                        /* Search Form */
                        #industrySearch {
                            margin-bottom: 15px;
                            border-radius: 5px;
                            padding: 10px;
                            color: #333;
                        }

                        #industrySearch:focus {
                            outline: none;
                            border: 1px solid #002C2C;
                        }
                    </style>
                    <div class="nbd-sidebar-con-inner">
                        <form method="get">
                            <input
                                type="search"
                                name="s"
                                placeholder="<?php _e("Search industry", "transparentcard") ?>"
                                id="industrySearch">
                        </form>
                        <div class="industry-scroll">
                            <ul>
                                <?php foreach ($tags as $tag):
                                    parse_str($_SERVER['QUERY_STRING'], $queryParams);
                                    $taglistUrl = add_query_arg(
                                        $queryParams,
                                        esc_url(get_term_link($tag['term_id'], 'template_tag'))
                                    );
                                ?>
                                    <li class="nbd-gallery-filter-item">
                                        <a data-type="tag" data-value="<?php echo ($tag['term_id']); ?>" href="<?php echo esc_url($taglistUrl); ?>" class="trns-nbd-tag-list-item-es-js <?php if (in_array($tag['term_id'], $filter_tags)) echo 'active'; ?>">
                                            <svg class="before" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4z" />
                                            </svg>
                                            <span><?php esc_html_e($tag['name']); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery('#coolcardstagsaccordion .accordion-item:not(.active) > .accordion-collapse').hide();
        jQuery(document.body).find('#coolcardstagsaccordion .accordion-item button').click(function() {
            if (jQuery(this).closest('.accordion-item').hasClass("active")) {
                jQuery(this).closest('.accordion-item').removeClass("active").find('.accordion-collapse').slideUp();
            } else {
                jQuery("#coolcardstagsaccordion .accordion-item.active .accordion-collapse").slideUp();
                jQuery("#coolcardstagsaccordion .accordion-item.active").removeClass("active");
                jQuery(this).closest('.accordion-item').addClass("active").find(".accordion-collapse").slideDown();
            }
            return false;
        });
    })
</script>
<?php echo ob_get_clean(); ?>