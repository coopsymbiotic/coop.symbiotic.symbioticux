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
  });

})(CRM.$, CRM._, CRM.ts('symbioticux'));
