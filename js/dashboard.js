(function($, _, ts) {

  /**
   * If there is only one dashlet on the dashboard, use 100% of the width.
   */
  $(document).on('crmLoad', function(event) {
    if ($('#civicrm-dashboard > .crm-flex-box > div:last-child > div').size() == 0) {
      $('#civicrm-dashboard > .crm-flex-box > div:first-child').css('min-width', '1200px');
      $('#civicrm-dashboard > .crm-flex-box > div:last-child').css('min-width', '80px');
    }
    else if ($('#civicrm-dashboard > .crm-flex-box > div:first-child > div').size() == 0) {
      $('#civicrm-dashboard > .crm-flex-box > div:first-child').css('min-width', '80px');
      $('#civicrm-dashboard > .crm-flex-box > div:last-child').css('min-width', '1200px');
    }
    else {
      // Reset to what CiviCRM normally does.
      // Because of 'load' events, the dashboard might think it's empty during loading.
      // (or maybe we are just not listening for the right event?)
      $('#civicrm-dashboard > .crm-flex-box > div:first-child').css('min-width', '300px');
      $('#civicrm-dashboard > .crm-flex-box > div:last-child').css('min-width', '450px');
    }
  });

})(CRM.$, CRM._, CRM.ts('symbioticux'));
