<?php

class CRM_Symbioticux_Contribute_Form_Contribution_Main {
  function buildForm(&$form) {
    // Preview & demo sites should encourage to use a test CC number
    // otherwise users do not know what CC to use, and sometimes use their own.
    if (CRM_Utils_Array::value('action', $_REQUEST) == 'preview' || $GLOBALS['symbioticux_demo']) {
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/Symbioticux/Contribute/Form/Contribution/Main.billing-explain.tpl',
      ));

      $js = "cj('#credit_card_number').click(function(event) {
               if (! cj(this).val()) {
                 cj(this).val('4111111111111111').trigger('change');
                 cj('#cvv2').val('123').trigger('change');
                 cj('#credit_card_exp_date_m').val('5').trigger('change');
                 cj('#credit_card_exp_date_Y').val('2018').trigger('change');

                 cj('.symbioticux-billing-explain-cc').prependTo('.credit_card_info-section').slideDown();
               }
             });";

      CRM_Core_Resources::singleton()->addScript($js);
    }

    // Remove some CSS classes on the 'submit' button.
    $js = "cj('.crm-submit-buttons .crm-form-submit').removeClass('crm-form-submit').parent().removeClass('crm-button');";
    CRM_Core_Resources::singleton()->addScript($js);
  }
}
