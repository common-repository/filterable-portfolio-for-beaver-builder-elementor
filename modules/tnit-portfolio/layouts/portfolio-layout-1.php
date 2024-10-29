<?php if($settings->enable_filter == '1'){

	// Filter Area
	$portfolio_filter_class  = 'tnit-portfolio-filter';
	$portfolio_filter_class .= ( 'always' === $settings->filter_dropdown ) ? ' tnit-portfolio-dropdown' : '';
	$portfolio_filter_class .= ( 'medium-small' === $settings->filter_dropdown ) ? ' tnit-md-dropdown' : '';
	$portfolio_filter_class .= ( 'small' === $settings->filter_dropdown ) ? ' tnit-sm-dropdown' : '';

	?>

	<!-- Gallery Filters -->
	<div class="<?php echo $portfolio_filter_class; ?>">
		<!-- select content dropdown -->
		<div class="select-option">
			<span class="select-content"></span>
			<i class="select-icon fas fa-chevron-down"></i>
		</div>
		<!-- Filters List -->
		<ul class="cbp-l-filters-button tnit-portfolio-filter-list">

			<li class="cbp-filter-item-active cbp-filter-item" data-filter="*"><?php echo $settings->all_filter_custom_text; ?></li>

			<?php $filter_name = $settings->filter_name;

			foreach($filter_name as $filter_label){
				$filter_class = $module->clean($filter_label); ?>
				<li class="cbp-filter-item" data-filter=".<?php echo "fc-" . $filter_class; ?>"><?php echo $filter_label; ?></li>
			<?php } ?>

		</ul>
	</div>


<?php } ?>

<div class="cbp tnit-cbp-portfolio tnit-portfolio-wrapper tnit-portfolio-layout-<?php echo $settings->portfolio_layout; ?>">

	<?php

	$default_count = count( $settings->filterable_portfolio );


	// Main for-loop start
	for( $i=0; $i < $default_count; $i++ ){

		$item_classes = 'cbp-item';
        $item_classes .= ' portfolio-item-' . $i;
        $item_classes .= '  portfolio-preview-' . $settings->preview_type;

		$item = $settings->filterable_portfolio[$i];

		// Filter label class
		if ( $settings->enable_filter && !empty($item->multi_filter_category) ) {
			foreach ($item->multi_filter_category as $filter_cat){
				$item_classes .= " " . $module->clean($filter_cat);
			}
		}

		?>

		<!--Item-->
        <div data-src-preview="<?php echo esc_url($item->preview_link); ?>" data-preview-title="<?php echo $item->portfolio_title; ?>" class="<?php echo $item_classes; ?>">
			<div class="cbp-caption">
				<div class="cbp-caption-defaultWrap">
					<?php $module->render_featured_image( $item ); ?>
				</div>
				<div class="cbp-caption-activeWrap">
					<div class="cbp-l-caption-alignCenter">
						<!-- Overlay -->
						<div class="cbp-l-caption-body">
							<?php $module->render_overlay_icon( $item ); ?>

							<?php if($settings->overlay_hover_effect != 'outside-text'): ?>
								<!-- Content -->
								<div class="tnit-overlay-content">
									<?php $module->render_portfolio_title( $item ); ?>
									<?php if($settings->overlay_hover_effect == 'innovative-top-bottom'){?>
										<span class="tnit-underline"></span>
									<?php } ?>
									<?php $module->render_portfolio_description( $item ); ?>
									<?php $module->render_portfolio_button( $item ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if($settings->overlay_hover_effect == 'outside-text'): ?>
				<!-- Content -->
				<div class="tnit-bottom-content">
					<?php $module->render_portfolio_title( $item ); ?>
					<?php $module->render_portfolio_description( $item ); ?>
					<?php $module->render_portfolio_button( $item ); ?>
				</div>
			<?php endif; ?>

		</div>

	<?php
        if ($i == 7) break; } ?>

</div>


