<?php ?>

<div class="tnit-portfolio-slider-wrapper tnit-portfolio-arrows-<?php echo $settings->arrows_style;?>">

	<div class="tnit-portfolio-slider owl-carousel xpro-item-before <?php echo $settings->slider_overlay_hvr_effect; ?>">

		<?php  // Main for-loop start

		$default_count = count( $settings->filterable_portfolio );

		for( $i=0; $i < $default_count; $i++ ){

            $item_classes = 'item';
            $item_classes .= ' portfolio-item-' . $i;
            $item_classes .= ' portfolio-preview-inner';

            $item = $settings->filterable_portfolio[$i];

			?>

			<div data-src-preview="<?php echo esc_url($item->preview_link); ?>" data-preview-title="<?php echo $item->portfolio_title; ?>" class="<?php echo $item_classes; ?>">
				<div class="xpro-item-inner">
					<div class="item-img">
						<?php $module->render_featured_image( $item ); ?>
						<div class="slide-caption">
							<div class="slide-caption-body">
								<?php $module->render_overlay_icon( $item ); ?>
								<?php if($settings->slider_overlay_hvr_effect != 'outside-text'): ?>
									<!-- Content -->
									<div class="tnit-overlay-content">
										<?php $module->render_portfolio_title( $item ); ?>
										<?php $module->render_portfolio_description( $item ); ?>
										<?php $module->render_portfolio_button( $item ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php if($settings->slider_overlay_hvr_effect == 'outside-text'): ?>
					<!-- Content -->
					<div class="tnit-bottom-content">
						<?php $module->render_portfolio_title( $item ); ?>
						<?php $module->render_portfolio_description( $item ); ?>
						<?php $module->render_portfolio_button( $item ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php } ?>

	</div>

	<span class="tnit-slider-nav tnit-slide-next"><i class="fas fa-chevron-left"></i></span>
	<span class="tnit-slider-nav tnit-slide-prev"><i class="fas fa-chevron-right"></i></span>

</div>

