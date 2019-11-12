(function($, _, ts){

  /**
   * Make radio buttons more pretty.
   */
  CRM.symbioticuxFormRadiosAsButtons = function(selector, options) {
    options = typeof options !== 'undefined' ? options : {};

    var button_width = options.button_width || '';
    var button_width_class = (button_width ? 'crm-radio-wrapper-' + button_width + 'px' : '');
    var hide_zero_value = options.hide_zero_value || false;

    $(document).on('crmLoad', function(e) {
      $('.crm-form-radio:not(.symbiocrm-radioasbuttons-processed)', selector).each(function() {
        var $this = $(this);
        var $parent = $this.parent();
        var $label = $('label[for=' + $(this).attr('id') + ']');
        var id = 'crm-radio-' + $this.attr('name') + '-wrapper';
        var $div = $('<div>', {id: id, 'class': 'crm-radio-wrapper ' + button_width_class});

        if ($this.prop('checked')) {
          $div.addClass('selected');
        }

        $this.addClass('symbiocrm-radioasbuttons-processed');
        $div.append($this);
        $div.append($label);
        $parent.append($div);

        if (hide_zero_value && $(this).val() == 0) {
          $div.hide();
        }
      });

      // Remove any leftover whitespaces
      $(selector).html($(selector).html().replace(/&nbsp;/gi,''));

      // Add a 'selected' class on clicked labels
      $('.crm-radio-wrapper > label', selector).on('click', function(e) {
        $this = $(this);
        $tbody = $this.closest(selector);
        var already_selected = $this.parent().hasClass('selected');

        $('.crm-radio-wrapper', $tbody).removeClass('selected');

        // Allow deselecting
        if (already_selected) {
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
