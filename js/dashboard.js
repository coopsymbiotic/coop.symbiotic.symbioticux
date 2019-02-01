(function($, _, ts) {

  /**
   * If there is only one dashlet on the dashboard, use 100% of the width.
   */
  $(document).on('crmLoad', function(event) {
    if ($('#civicrm-dashboard > #column-1 > li.widget').size() == 0) {
      $('#civicrm-dashboard > #column-1').hide();
      $('#civicrm-dashboard > #column-0').css('width', '100%');
    }
    else if ($('#civicrm-dashboard > #column-0 > li.widget').size() == 0) {
      $('#civicrm-dashboard > #column-0').hide();
      $('#civicrm-dashboard > #column-1').css('width', '100%');
    }
    else {
      // Reset to what CiviCRM normally does.
      // Because of 'load' events, the dashboard might think it's empty during loading.
      // (or maybe we are just not listening for the right event?)
      $('#civicrm-dashboard > #column-0').show();
      $('#civicrm-dashboard > #column-0').css('width', '40%');
      $('#civicrm-dashboard > #column-1').show();
      $('#civicrm-dashboard > #column-1').css('width', '60%');
    }
  });

})(CRM.$, CRM._, CRM.ts('symbioticux'));
