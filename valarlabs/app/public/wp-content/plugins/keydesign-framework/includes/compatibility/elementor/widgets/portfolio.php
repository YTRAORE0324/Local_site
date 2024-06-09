<?php
namespace KeyDesign\Compatibility\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class KD_Widget_Portfolio extends Widget_Base {

	private $_query = null;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'portfolio-grid';
	}

	public function get_title() {
		return __( 'Portfolio Grid', 'keydesign-framework' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'general' );
	}

	public function get_script_depends() {
		return [
			'imagesloaded',
		];
	}

	public function get_query() {
		return $this->_query;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'keydesign-framework' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'grid_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Layout', 'keydesign-framework' ),
				'default' => 'grid',
				'options' => [
					'grid' => esc_html__( 'Grid', 'keydesign-framework' ),
					'masonry' => esc_html__( 'Masonry', 'keydesign-framework' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'aspect_ratio',
			[
				'label' => esc_html__( 'Aspect Ratio', 'keydesign-framework' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.5,
						'max' => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid-item__img' => 'aspect-ratio: {{SIZE}}',
				],
				'condition' => [
					'grid_layout' => 'grid',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'keydesign-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				],
				'prefix_class' => 'elementor-grid%s-',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'keydesign-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 99,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => esc_html__( 'Items', 'keydesign-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_design',
			[
				'label' => esc_html__( 'Item Design', 'keydesign-framework' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Minimal',
					'2' => 'Detailed',
				],
				'default' => '1',
			]
		);

		$this->add_control(
			'item_spacing',
			[
				'label' => esc_html__( 'Item Spacing', 'keydesign-framework' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'0' => '0px',
					'10' => '10px',
					'20' => '20px',
					'30' => '30px',
					'40' => '40px',
					'50' => '50px',
				],
				'default' => '30',
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid-item' => 'margin-bottom: {{SIZE}}px',
					'{{WRAPPER}} .keydesign-portfolio-grid' => '--portfolio-gap: {{SIZE}}px',
				],
				'prefix_class' => 'keydesign-portfolio-gutter-',
			]
		);

		$this->start_controls_tabs( 'text_colors' );

		$this->start_controls_tab(
			'text_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'keydesign-framework' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'keydesign-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid .keydesign-portfolio-grid-item__wrapper .keydesign-portfolio-grid-item__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Category Color', 'keydesign-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid .keydesign-portfolio-grid-item__wrapper .keydesign-portfolio-grid-item__categories a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'keydesign-framework' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Color', 'keydesign-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid .keydesign-portfolio-grid-item__wrapper .keydesign-portfolio-grid-item__title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .keydesign-portfolio-item-design-2 .keydesign-portfolio-grid-item__wrapper:hover .keydesign-portfolio-grid-item__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .keydesign-portfolio-item-design-2 .keydesign-portfolio-grid-item__wrapper:hover .keydesign-portfolio-grid-item__title:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_color_hover',
			[
				'label' => esc_html__( 'Category Color', 'keydesign-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid .keydesign-portfolio-grid-item__wrapper .keydesign-portfolio-grid-item__categories a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_filter',
			[
				'label' => esc_html__( 'Filter Bar', 'keydesign-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_filter',
			[
				'label' => esc_html__( 'Color', 'keydesign-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid__filters li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'color_filter_active',
			[
				'label' => esc_html__( 'Active Color', 'keydesign-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .keydesign-portfolio-grid__filters li.active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .keydesign-portfolio-grid__filters li:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .keydesign-portfolio-grid__filters.portfolio_filter-design-1 li.active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .keydesign-portfolio-grid__filters.portfolio_filter-design-1 li:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .keydesign-portfolio-grid__filters.portfolio_filter-design-2 li.active:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label' => __( 'Settings', 'keydesign-framework' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_filter_bar',
			[
				'label' => esc_html__( 'Show Filter', 'keydesign-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide', 'keydesign-framework' ),
				'label_on' => esc_html__( 'Show', 'keydesign-framework' ),
				'return_value' => 'yes',
                'default' => 'yes',
			]
		);

		$this->add_control(
			'filter_design',
			[
				'label' => esc_html__( 'Filter Design', 'keydesign-framework' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Boxed',
					'2' => 'Underline',
				],
				'default' => '1',
				'condition' => [
					'show_filter_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_all_filter_label',
			[
				'label' => esc_html__( 'Show "All" Filter Label', 'keydesign-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'keydesign-framework' ),
				'label_off' => esc_html__( 'Hide', 'keydesign-framework' ),
				'return_value' => 'yes',
                'default' => 'yes',
				'condition' => [
					'show_filter_bar' => 'yes',
				],
			]
		);

		$this->add_control(
            'filter_all_label',
            [
                'label' => esc_html__( '"All" Filter Label', 'keydesign-framework' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'All', 'keydesign-framework' ),
				'condition' => [
					'show_filter_bar' => 'yes',
					'show_all_filter_label' => 'yes',
				],
            ]
        );

		$this->end_controls_section();

	}

	protected function get_posts_tags() {
		foreach ( $this->_query->posts as $post ) {

			if ( taxonomy_exists( 'keydesign-portfolio-category' ) ) {
				$tags = wp_get_post_terms( $post->ID, 'keydesign-portfolio-category' );

				$tags_slugs = [];

				foreach ( $tags as $tag ) {
					$tags_slugs[ $tag->term_id ] = $tag;
				}

				$post->tags = $tags_slugs;
			} else {
				$post->tags = [];
			}
		}
	}

	public function query_posts() {
		$query_params = array(
            'post_type' => 'keydesign-portfolio',
            'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'desc',
            'posts_per_page' => $this->get_settings( 'posts_per_page' ),
			'taxonomy' => 'keydesign-portfolio-category',
        );

		$wp_query = new \WP_Query( $query_params );

		$this->_query = $wp_query;
	}

	protected function render_grid_filter() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'filter-wrapper', [
			'class' => [ 'keydesign-portfolio-grid__filters', 'portfolio_filter-design-' . $settings['filter_design'],  ]
		] );

		$terms = [];

		foreach ( $this->_query->posts as $post ) {
			$terms += $post->tags;
		}

		if ( empty( $terms ) ) {
			return;
		}

		usort( $terms, function( $a, $b ) {
			return strcmp( $a->name, $b->name );
		} );

		?>
		<ul <?php $this->print_render_attribute_string( 'filter-wrapper' ); ?>>
			<?php if ( $settings['show_all_filter_label'] == 'yes' ) : ?>
				<li class="keydesign-portfolio-grid__filter active" data-filter="*"><?php echo esc_html( $settings['filter_all_label'] ); ?></li>
			<?php endif; ?>
			<?php foreach ( $terms as $term ) : ?>
				<li class="keydesign-portfolio-grid__filter-label" data-filter=".portfolio-filter-<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></li>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	protected function render_grid_header() {
		$settings = $this->get_settings_for_display();
		?>
		<div id="keydesign-portfolio-<?php echo $this->get_id(); ?>">
		<?php

		if ( $settings['show_filter_bar'] ) {
			$this->render_grid_filter();
		}

		$this->add_render_attribute( 'wrapper', [
			'class' => [ 'keydesign-portfolio-grid', 'elementor-grid', 'keydesign-portfolio-layout-' . $settings['grid_layout'], 'keydesign-portfolio-item-design-' . $settings['item_design'],  ]
		] );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
		<?php
	}

	protected function render_grid_footer() {
		?>
		</div>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->query_posts();

		$wp_query = $this->get_query();

		if ( ! $wp_query->have_posts() ) {
			return;
		}

		$this->get_posts_tags();

		$this->render_grid_header();

		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();

			$this->render_post();
		}

		$this->render_grid_footer();

		wp_reset_postdata();

		if ( $settings['show_filter_bar'] ) {
			$this->render_filtering_init();
		}

	}

	protected function render_post_header() {
		global $post;

		if ( ! $post->tags ) {
			$tags_classes[] = '';
		} else {
			$tags_classes = array_map( function( $tag ) {
				return 'portfolio-filter-' . $tag->term_id;
			}, $post->tags );
		}

		$classes = [
			'keydesign-portfolio-grid-item',
			implode( ' ', $tags_classes ),
		];
		?>
		<article <?php post_class( $classes ); ?>>
		<div class="keydesign-portfolio-grid-item__wrapper">
		<?php
	}

	protected function render_thumbnail() {
		if ( has_post_thumbnail() ) : ?>
		<a class="keydesign-portfolio-grid-item__link" href="<?php echo get_permalink(); ?>">
			<div class="keydesign-portfolio-grid-item__img">
				<?php the_post_thumbnail(); ?>
			</div>
		</a>
		<?php endif;
	}

	protected function render_post_content_header() {
		?>
		<div class="keydesign-portfolio-grid-item__content">
		<?php
	}

	protected function render_title() {
		?>
		<a class="keydesign-portfolio-grid-item__link" href="<?php echo get_permalink(); ?>">
			<h4 class="keydesign-portfolio-grid-item__title"><?php the_title(); ?></h4>
		</a>
		<?php
	}

	protected function render_categories_names() {
		global $post;

		if ( ! $post->tags ) {
			return;
		}

		$tags_array = [];

		foreach ( $post->tags as $tag ) {
			$tags_array[] = '<a href="' . get_term_link( $tag ) . '"><span class="keydesign-portfolio-grid-item__categories__category">' . esc_html( $tag->name ) . '</span></a>';
		}

		?>
		<div class="keydesign-portfolio-grid-item__categories">
			<?php echo implode( ' ', $tags_array ); ?>
		</div>
		<?php
	}

	protected function render_post_content_footer() {
		?>
		</div>
		<?php
	}

	protected function render_post_footer() {
		?>
		</div>
		</article>
		<?php
	}

	protected function render_post() {
		$this->render_post_header();
		$this->render_thumbnail();
		$this->render_post_content_header();
		$this->render_title();
		$this->render_categories_names();
		$this->render_post_content_footer();
		$this->render_post_footer();
	}

	protected function render_filtering_init() {
		$settings = $this->get_settings_for_display();
       	?>
       	<script>
           ( function($) {
               	$( function() {
				   	var $portfolio = $('#keydesign-portfolio-<?php echo esc_attr( $this->get_id() ); ?>');
                   	var $grid = $portfolio.find('.keydesign-portfolio-grid');
					var $portfolio_filter = $portfolio.find('.keydesign-portfolio-grid__filters');

                   	$grid.imagesLoaded( function() {
						$grid.isotope({
							itemSelector: '.keydesign-portfolio-grid-item',
							masonry: {
    							gutter: <?php echo esc_attr( $settings['item_spacing'] ); ?>
  							}
						})
                   	});

					$portfolio_filter.on( "click", "li", ( function() {
						var filterValue = $(this).attr('data-filter');
 					   	$portfolio_filter.find("li").removeClass("active"),
 					   	$(this).addClass("active"),
 					   	$grid.isotope({
 						   filter: filterValue
 					   })
					}));
               	});
           	}( jQuery ) );
       	</script>
       	<?php
   	}

}