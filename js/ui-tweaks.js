(function($, _, ts){

  /**
   * Make radio buttons more pretty.
   */
  CRM.symbioticuxFormRadiosAsButtons = function(selector, options) {
    options = typeof options !== 'undefined' ? options : {};

    var button_width = options.button_width || '';
    var button_width_class = (button_width ? 'crm-radio-wrapper-' + button_width + 'px' : '');
    var hide_zero_value = options.hide_zero_value || false;
    var mandatory_field = options.mandatory_field || false;

    $(document).on('crmLoad', function(e) {
      if ($('.crm-form-radio', selector).size()) {
        var $new = $('<div>', {'class': 'content symbiocrm-form-radios-as-buttons'});

        $('.crm-form-radio', selector).each(function() {
          var $this = $(this);
          var $label = $('label[for=' + $(this).attr('id') + ']');
          var id = 'crm-radio-' + $this.attr('name') + '-wrapper';
          var $div = $('<div>', {id: id, 'class': 'crm-radio-wrapper ' + button_width_class});

          if ($this.prop('checked')) {
            $div.addClass('selected');
          }

          $this.removeClass('crm-form-radio');
          $div.append($this);
          $div.append($label);
          $new.append($div);

          if (hide_zero_value && $(this).val() == 0) {
            $div.hide();
          }
        });

        // This is to make sure we do not have stray nbsps.
        $(selector).replaceWith($new);
      }

      // Add a 'selected' class on clicked labels
      $('.crm-radio-wrapper > label', selector).on('click', function(e) {
        $this = $(this);
        $tbody = $this.closest(selector);
        var already_selected = $this.parent().hasClass('selected');

        $('.crm-radio-wrapper', $tbody).removeClass('selected');

        // Allow deselecting
        if (already_selected && !mandatory_field) {
          $this.parent().find('input.crm-form-radio').prop('checked', false);
          e.preventDefault();
        }
        else {
          $this.parent().addClass('selected');
        }
      });

      // Add a class on the initial selector, for easier CSS theming, but do it only once
      $(selector).addClass('symbiocrm-form-radios-as-buttons');
    });
  };

})(CRM.$, CRM._, CRM.ts('coop.symbiotic.symbioticux'));
