<?php ?>

<div class="tnit-slider-full">
	<div class="tnit-full-content">
		<div class="tnit-image-area"></div>
		<!--Menu-->
		<ul class="tnit-portfolio-menu">

			<?php

            $default_count = count( $settings->filterable_portfolio );

			for( $i=0; $i < $default_count; $i++ ) {

                $item_classes = ' portfolio-item-' . $i;
                $item_classes .= '  portfolio-preview-' . $settings->preview_type;

                $item = $settings->filterable_portfolio[$i];

				?>
				<li class="<?php echo esc_attr($item_classes); ?>" data-src-preview="<?php echo esc_url($item->preview_link); ?>" data-preview-title="<?php echo $item->portfolio_title; ?>"><a data-text="<?php echo $item->portfolio_title; ?>" data-image-url="<?php $module->render_featured_image_url($item); ?>" href="javascript:void(0);"><?php echo $item->portfolio_title; ?></a></li>
			<?php } ?>

		</ul>
	</div>
</div>
