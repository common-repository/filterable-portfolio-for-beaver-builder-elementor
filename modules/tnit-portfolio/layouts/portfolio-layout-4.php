<?php ?>

<div class="tnit-slick-slider-full">

	<div class="tnit-right-content">
		<!--Slick Slider-->
		<div class="tnit-slick-detail-image">

			<?php

			$default_count = count( $settings->filterable_portfolio );

			for( $i=0; $i < $default_count; $i++ ) {

				$item = $settings->filterable_portfolio[ $i ]; ?>

				<div class="slider-slide">
					<div class="tnit-slide-image">
						<?php $module->render_featured_image( $item ); ?>
					</div>
				</div>

			<?php }?>

		</div>
	</div>

	<div class="tnit-left-content">
		<!--Slick Slider-->
		<div class="tnit-slick-detail">

			<?php

			$default_count = count( $settings->filterable_portfolio );

			for( $i=0; $i < $default_count; $i++ ) {

                $item_classes = 'slider-slide';
                $item_classes .= ' portfolio-item-' . $i;
                $item_classes .= '  portfolio-preview-' . $settings->preview_type;

                $item = $settings->filterable_portfolio[$i];

				?>

                <div data-src-preview="<?php echo esc_url($item->preview_link); ?>" data-preview-title="<?php echo $item->portfolio_title; ?>" data-image-url="<?php $module->render_featured_image_url($item); ?>" class="<?php echo $item_classes; ?>">
					<div class="tnit-slider-content">
						<?php $module->render_portfolio_title( $item ); ?>
						<?php $module->render_portfolio_description( $item ); ?>
						<?php $module->render_portfolio_button( $item ); ?>
					</div>

				</div>

			<?php }?>

		</div>

	</div>

	<!--Slider Arrows-->
	<div class="tnit-slider-arrows tnit-portfolio-arrows-<?php echo $settings->arrows_style;?> <?php echo ($settings->nav_arrows_medium) ? '' : ' arrows-md-none'; ?> <?php echo ($settings->nav_arrows_responsive) ? '' : ' arrows-sm-none'; ?>">
		<span class="tnit-slider-nav tnit-slide-prev"><i class="fas fa-angle-left"></i></span>
		<span class="tnit-slider-nav tnit-slide-next"><i class="fas fa-angle-right"></i></span>
	</div>

</div>
