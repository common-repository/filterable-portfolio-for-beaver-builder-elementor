<?php ?>

<div class="tnit-portfolio-slider-wrapper tnit-portfolio-arrows-<?php echo $settings->arrows_style;?>">

	<div class="tnit-slider-innovative owl-carousel <?php echo $settings->slider_overlay_hvr_effect; ?>">

		<?php  // Main for-loop start

		$default_count = count( $settings->filterable_portfolio );

		for( $i=0; $i < $default_count; $i++ ){

            $item_classes = 'item';
            $item_classes .= ' portfolio-item-' . $i;
            $item_classes .= ' portfolio-preview-inner';

            $item = $settings->filterable_portfolio[$i];

			if($i % 2 == 0){ ?>

                <div data-src-preview="<?php echo esc_url($item->preview_link); ?>" data-preview-title="<?php echo $item->portfolio_title; ?>" class="<?php echo $item_classes; ?>">
					<div class="item-img">
						<?php $module->render_featured_image( $item ); ?>
						<div class="slide-caption">
							<div class="slide-caption-body">
								<!-- Icon -->
								<?php $module->render_overlay_icon( $item ); ?>
							</div>
						</div>
					</div>
					<div class="item-content">
						<!-- Content -->
						<div class="tnit-right-content">
							<?php $module->render_portfolio_title( $item ); ?>
							<?php $module->render_portfolio_description( $item ); ?>
							<?php $module->render_portfolio_button( $item ); ?>
						</div>
					</div>
				</div>

			<?php }else{ ?>

                <div data-src-preview="<?php echo esc_url($item->preview_link); ?>" data-preview-title="<?php echo $item->portfolio_title; ?>" class="<?php echo $item_classes; ?>">
                    <div class="item-content">
						<!-- Content -->
						<div class="tnit-right-content">
							<?php $module->render_portfolio_title( $item ); ?>
							<span class="tnit-underline"></span>
							<?php $module->render_portfolio_description( $item ); ?>
							<?php $module->render_portfolio_button( $item ); ?>
						</div>
					</div>
					<div class="item-img">
						<?php $module->render_featured_image( $item ); ?>
						<div class="slide-caption">
							<div class="slide-caption-body">
								<!-- Icon -->
								<span class="overlay-icon">
                                     <?php $module->render_overlay_icon( $item ); ?>
                                    </span>
							</div>
						</div>
					</div>
				</div>

			<?php } ?>

		<?php } ?>

	</div>

	<span class="tnit-slider-nav tnit-slide-next"><i class="fas fa-chevron-left"></i></span>
	<span class="tnit-slider-nav tnit-slide-prev"><i class="fas fa-chevron-right"></i></span>

</div>
