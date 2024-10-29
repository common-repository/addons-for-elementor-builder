jQuery(document).ready(function ($) {
  $(document).off('keyup', '.afeb-elements-search-input')
    .on('keyup', '.afeb-elements-search-input', function () {
      let filter = $(this).val();

      $('.afeb-element-search-section').each(function () {
        if ($(this).find('.afeb-element-search-text').text().trim().search(new RegExp(filter, "i")) < 0) {
          $(this).fadeOut(150);
        } else {
          $(this).fadeIn(150);
        }
      });
    });
  $(document).off('click', '.afeb-elements-activate-all-btn')
    .on('click', '.afeb-elements-activate-all-btn', function () {
      $('.afeb-element-status').removeClass('afeb-element-status-deactive');
      $('.afeb-element-checkbox-box').removeClass('afeb-deactive-checkbox');
      $('.afeb-element-section .afeb-checkbox').prop("checked", true);
    });
  $(document).off('click', '.afeb-elements-deactivate-all-btn')
    .on('click', '.afeb-elements-deactivate-all-btn', function () {
      $('.afeb-element-status').addClass('afeb-element-status-deactive');
      $('.afeb-element-checkbox-box').addClass('afeb-deactive-checkbox');
      $('.afeb-element-section .afeb-checkbox').prop("checked", false);
    });
  $(document).off('change', '.afeb-element-checkbox-box .afeb-checkbox')
    .on('change', '.afeb-element-checkbox-box .afeb-checkbox', function () {
      if ($(this).is(':checked')) {
        $(this).parent().removeClass('afeb-deactive-checkbox');
        $(this).parent().parent().parent().find('.afeb-element-status').removeClass('afeb-element-status-deactive');
      } else {
        $(this).parent().addClass('afeb-deactive-checkbox');
        $(this).parent().parent().parent().find('.afeb-element-status').addClass('afeb-element-status-deactive');
      }
    });

  // ==== Edit Nav Menu ==== \\
  $('.afeb-edit-advanced-menu-field-icon').fontIconPicker({ emptyIconValue: '' });
  $('.afeb-colorpicker').wpColorPicker()
  $(document).off('click', '.afeb-edit-advanced-menu-activation>label')
    .on('click', '.afeb-edit-advanced-menu-activation>label', function () {
      let mgm_fields = $(this).parent().parent().find('.afeb-edit-advanced-menu-fields');
      let checkbox = $(this).parent().find('.afeb-edit-advanced-menu-activation-checkbox');
      let txt = $(this).text();
      let parent = $(this).closest('.menu.ui-sortable');
      let advanced_sub_menu_wrap = parent.find('.afeb-edit-advanced-sub-menu-wrap');

      $(this).text($(this).data('label'));
      $(this).data('label', txt);

      if (checkbox.is(":checked")) {
        checkbox.prop("checked", false);
        $(this).parent().addClass('afeb-edit-advanced-menu-deactive');
        mgm_fields.slideUp();
        advanced_sub_menu_wrap.hide();
      } else {
        mgm_fields.find('.afeb-edit-advanced-menu-field-icon').fontIconPicker({ emptyIconValue: '' });
        mgm_fields.find('.afeb-colorpicker').wpColorPicker();
        checkbox.prop("checked", true);
        $(this).parent().removeClass('afeb-edit-advanced-menu-deactive');
        mgm_fields.slideDown();
        advanced_sub_menu_wrap.show();
      }
    });
  $(document).off('change', '#afeb-edit-megamenu-field-mgm-type')
    .on('change', '#afeb-edit-megamenu-field-mgm-type', function () {
      let value = this.value;

      if (value == 'custom') {
        $(this).parent().parent().parent().find('.afeb-edit-megamenu-field-template-id-wrap').show();
        $(this).parent().parent().parent().find('.afeb-edit-megamenu-field-shortcode-wrap').hide();
      } else if (value == 'custom_code') {
        $(this).parent().parent().parent().find('.afeb-edit-megamenu-field-shortcode-wrap').show();
        $(this).parent().parent().parent().find('.afeb-edit-megamenu-field-template-id-wrap').hide();
      } else {
        $(this).parent().parent().parent().find('.afeb-edit-megamenu-field-template-id-wrap, .afeb-edit-megamenu-field-shortcode-wrap').hide();
      }
    });
  $(document).off('click', '.afeb-edit-advanced-sub-menu-activation>label')
    .on('click', '.afeb-edit-advanced-sub-menu-activation>label', function () {
      let fields = $(this).parent().parent().find('.afeb-edit-advanced-sub-menu-fields');
      let checkbox = $(this).parent().find('.afeb-edit-advanced-menu-activation-checkbox');

      if (checkbox.is(":checked")) {
        checkbox.prop("checked", false);
        $(this).parent().addClass('afeb-edit-advanced-sub-menu-deactive');
        fields.slideUp();
      } else {
        fields.find('.afeb-edit-advanced-menu-field-icon').fontIconPicker({ emptyIconValue: '' });
        checkbox.prop("checked", true);
        $(this).parent().removeClass('afeb-edit-advanced-sub-menu-deactive');
        fields.slideDown();
      }
    });

  setInterval(function () {
    $('.menu.ui-sortable').find('.menu-item').each(function () {
      let item = $(this);
      let depth_match = item.attr('class').match(/menu-item-depth-[0-9]{0,}/ig);
      let advanced_menu_wrap = item.find('.afeb-edit-advanced-menu-wrap');
      let items = advanced_menu_wrap.find('.afeb-edit-megamenu-field-mgm-type-wrap,' +
        '.afeb-edit-megamenu-field-template-id-wrap,' +
        '.afeb-edit-megamenu-field-shortcode-wrap,' +
        '.afeb-edit-megamenu-field-width-wrap');
      let heading = item.find('.afeb-edit-advanced-menu-field-heading-wrap');
      let depth = item.find('#afeb-edit-advanced-menu-field-depth');

      depth_match = typeof depth_match[0] != 'undefined' ? parseInt(depth_match[0].replace('menu-item-depth-', '')) : '';
      depth.val(depth_match);

      if (depth_match != 0) {
        if (depth_match == 1) heading.show();
        items.each(function () { $(this).hide(); })
      } else {
        heading.hide();
        $(items.get(0)).show();
        let mgm_type = $(items.get(0)).find('#afeb-edit-megamenu-field-mgm-type');
        let mgm_type_val = mgm_type.val();

        if (mgm_type_val != '') $(items.get(3)).show();
        if (mgm_type_val == 'custom') $(items.get(1)).show();
        if (mgm_type_val == 'custom_code') $(items.get(2)).show();
      }
    });
  }, 250);
});