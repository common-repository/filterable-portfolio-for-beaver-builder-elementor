(function($){
		"use strict";

		var portfolioItemNum,
			node;

		FLBuilder.registerModuleHelper('tnit-portfolio', {

			init: function()
			{
				var form    			= $('.fl-builder-settings'),
					id   = form.data('node'),
					a		= form.find('.fl-builder-settings-tabs a'),
					preview_popup		= form.find('.tnit-portfolio-popup-preview');

				// get slide index number
				$('#fl-field-filterable_portfolio').on('click', '.fl-form-field-edit[data-type="portfolio_form"]', function()
				{
					portfolioItemNum = $(this).index('.fl-form-field-edit[data-type="portfolio_form"]');

					return portfolioItemNum;

				});

				preview_popup.on('click', $.proxy( this._renderPreviewPopup, this ) );

				a.on('click', this._openPreviewPopup);

				$( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._openPreviewPopupRender );
				// $( '.fl-builder-content' ).on( 'fl-builder.preview-rendered', this._openPreviewPopupRender );

				$('.fl-builder-settings .tnit-portfolio-filter-dropdown-preview').on('click', this._renderFiltersDropdownPreview);
				$('.fl-builder-settings .tnit-portfolio-filters-dropdown-toggle').on('click', this._toggleFiltersDropdown);


				this._openPreviewPopupRender();
				this._liteDisable();

			},

			_liteDisable: function() {

				var form		 	= $('.fl-builder-settings');
				form.find('option[value^="disable"]').attr("disabled", true);

			},

			/**
			 * Shows the UI when it's hidden.
			 * @return void
			 */
			_renderFiltersDropdownPreview: function(e) {
				e.stopPropagation();

				var form = $('.fl-builder-settings'),
					id   = form.data('node');

				$('.fl-node-' + id + ' .tnit-portfolio-dropdown,.fl-node-' + id + ' .tnit-md-dropdown,.fl-node-' + id + ' .tnit-sm-dropdown')
					.addClass('active');

				var mode = FLBuilderResponsiveEditing._mode;

				if( 'responsive' === mode ) {
					e.stopPropagation();

					FLBuilderResponsiveEditing._clearPreview();
					FLBuilderResponsiveEditing._switchAllSettingsToCurrentMode();

				}else{

					// Switching modes
					FLBuilderResponsiveEditing._switchTo('responsive');
					FLBuilderResponsiveEditing._switchAllSettingsToCurrentMode();
				}
			},

			_toggleFiltersDropdown: function(e) {
				e.stopPropagation();

				var form = $('.fl-builder-settings'),
					id   = form.data('node');

				$('.fl-node-' + id + ' .tnit-portfolio-dropdown').toggleClass('active');
			},

			_renderPreviewPopup: function(e) {
				e.stopPropagation();

				var form = $('.fl-builder-settings'),
					id   = form.data('node');

				if ( $('.xpro-preview-active').length > 0 ) {
					$('.xpro-preview-close').click();
				} else {
					$('.fl-node-'+ id +' .portfolio-preview-popup').first().click();
				}

			},

			_openPreviewPopupRender: function() {

				var form = $('.fl-builder-settings'),
					id   = form.data('node'),
					anchorHref = $(this).attr('href'),
					anchorActiveHref = jQuery( '.fl-builder-settings-tabs' ).children('.fl-active').attr( 'href' );

				if(anchorActiveHref === '#fl-builder-settings-tab-preview_tab')
				{
					if ( $('.xpro-preview-active').length > 0 ) {
						$('.xpro-preview-close').click();
					}

					setTimeout(function (){
						if ( $('.xpro-preview-active').length === 0 ) {
							$('.fl-node-'+ id +' .portfolio-preview-popup').first().click();
						}
					},500);

				}
				else{
					if ( $('.xpro-preview-active').length > 0 ) {
						$('.xpro-preview-close').click();
					}
				}
			},

			_openPreviewPopup: function() {

				var form = $('.fl-builder-settings'),
					id   = form.data('node'),
					anchorHref = $(this).attr('href'),
					anchorActiveHref = jQuery( '.fl-builder-settings-tabs' ).children('.fl-active').attr( 'href' );

				if( anchorHref === '#fl-builder-settings-tab-preview_tab')
				{

					if ( $('.xpro-preview-active').length === 0 ) {
						$('.fl-node-'+ id +' .portfolio-preview-popup').first().click();
					}

				}
				else{
					if ( $('.xpro-preview-active').length > 0 ) {
						$('.xpro-preview-close').click();
					}
				}
			},

		});

		FLBuilder.registerModuleHelper('portfolio_form', {

			init: function()
			{
				new SlimSelect({
					select: '.tnit-filter-cat',
					onChange: (info) => {
						$('.tnit-filter-cat option').removeAttr("selected");
						$.each(info, function(index, item) {
							$('.tnit-filter-cat option[value=' + item.value + ']').prop("selected", true);
						});
					}
				});

				var form    			= $('.fl-builder-settings'),
					id  				= form.data('node'),
					portfolio_enable		= form.find('select[name=enable_filter]').val(),
					portfolio_layout		= form.find('select[name=portfolio_layout]').val(),
					preview_type		= form.find('select[name=preview_type]').val(),
					portfolio_category	= form.find('.tnit-filter-cat');

				$('#fl-field-multi_filter_category').parents('.fl-builder-settings-section-content').show();

				if('carousel' === portfolio_layout || portfolio_enable === '0'){
					$('#fl-field-multi_filter_category').parents('.fl-builder-settings-section-content').hide();
				}

				$("#fl-field-filter_name input").each(function(index){
					var input = $(this); // This is the jquery object of the input, do what you will
					var filter_category = '<option value="fc-'+(input.val()).toLowerCase().replace(/[^a-zA-Z0-9]+/g, "-") +'">'+input.val()+'</option>';

					portfolio_category.append(filter_category);
				});

				var portfolioItem = $('.fl-node-' + id +' .portfolio-item-' + portfolioItemNum );

				if(portfolioItem.length){

					var classList = portfolioItem.attr('class').split(/\s+/);

					$.each(classList, function(index, item) {
						$('.tnit-filter-cat option[value=' + item + ']').attr("selected","selected");
					});

				}

				if(preview_type === 'popup'){
					$('#fl-builder-settings-tab-preview_tab #fl-builder-settings-section-general').show();
					$('#fl-builder-settings-tab-preview_tab #fl-builder-settings-section-media').show();
					$('#fl-builder-settings-tab-preview_tab #fl-builder-settings-section-link').hide();
				}else{
					$('#fl-builder-settings-tab-preview_tab #fl-builder-settings-section-general').hide();
					$('#fl-builder-settings-tab-preview_tab #fl-builder-settings-section-media').hide();
					$('#fl-builder-settings-tab-preview_tab #fl-builder-settings-section-link').show();
				}
			}

		});

	})(jQuery);
