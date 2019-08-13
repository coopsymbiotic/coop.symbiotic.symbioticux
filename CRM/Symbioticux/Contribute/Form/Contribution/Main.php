<?php

class CRM_Symbioticux_Contribute_Form_Contribution_Main {
  function buildForm(&$form) {
    // Change the label on the "name" fields, and make mandatory
    // (they are mandatory for CC transactions, but not shown as such in the form by default
    // because of the 'pay later' option)
    $fields = array('billing_first_name' => ts('First Name'), 'billing_last_name' => ts('Last Name'), 'billing_individual_prefix' => ts('Title'));

    foreach ($fields as $field => $title) {
      if ($form->elementExists($field)) {
        $e =& $form->getElement($field);
        $e->setLabel($title);
        $form->addRule($field, ts('%1 is a required field.', array(1 => $title)), 'required');
      }
    }

    $fields = array('billing_street_address-5', 'billing_city-5', 'billing_country_id-5', 'billing_state_province_id-5', 'billing_postal_code-5');

    foreach ($fields as $field) {
      if ($form->elementExists($field)) {
        $e =& $form->getElement($field);
        $title = $e->getLabel();
        $form->addRule($field, ts('%1 is a required field.', array(1 => $title)), 'required');
      }
    }

    CRM_Core_Region::instance('page-body')->add(array(
      'template' => 'CRM/Symbioticux/Contribute/Form/Contribution/Main.validate.tpl',
    ));

    // Preview & demo sites should encourage to use a test CC number
    // otherwise users do not know what CC to use, and sometimes use their own.
    if (CRM_Utils_Array::value('action', $_REQUEST) == 'preview' || !empty($GLOBALS['symbioticux_demo']) || (isset($form->_paymentProcessors[1]) && CRM_Utils_Array::value('name', $form->_paymentProcessors[1]) == 'Dummy')) {
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/Symbioticux/Contribute/Form/Contribution/Main.billing-explain.tpl',
      ));

      $js = "cj('#credit_card_number').click(function(event) {
               if (! cj(this).val()) {
                 cj(this).val('4111111111111111').trigger('change');
                 cj('#cvv2').val('123').trigger('change');
                 cj('#credit_card_exp_date_m').val('5').trigger('change');
                 cj('#credit_card_exp_date_Y').val('2021').trigger('change');

                 cj('.symbioticux-billing-explain-cc').prependTo('.credit_card_info-section').slideDown();
               }
             });";

      CRM_Core_Resources::singleton()->addScript($js);
    }

    CRM_Core_Region::instance('page-body')->add(array(
      'template' => 'CRM/Symbioticux/Contribute/Form/Contribution/Main.hide-other-amount.tpl',
    ));

    // Remove some CSS classes on the 'submit' button.
    $js = "cj('.crm-submit-buttons .crm-form-submit').addClass('btn btn-primary').removeClass('crm-form-submit').parent().removeClass('crm-button');";
    CRM_Core_Resources::singleton()->addScript($js);

    // Fix the translation of the "Credit Card Information" block
    // c.f. templates/CRM/Core/BillingBlock.tpl
    $smarty = CRM_Core_Smarty::singleton();
    $smarty->assign('paymentTypeLabel', ts('Credit Card Information'));
  }
}
