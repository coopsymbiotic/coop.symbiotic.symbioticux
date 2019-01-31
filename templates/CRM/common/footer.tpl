{if call_user_func(array('CRM_Core_Permission','check'), 'access CiviCRM')}
  {if !empty($contactId)}
    {include file="CRM/common/contactFooter.tpl"}
  {/if}

  {capture assign=civilogo}<a href="https://www.symbiotic.coop/{$tsLocale|truncate:2:"":true}" title="{ts domain='coop.symbiotic.symbioticux'}Hosted by Coop SymbioTIC{/ts}" target="_blank" class="empowered-by-link"><div class="empowered-by-logo"><span>CiviCRM</span></div></a>{/capture}

  <div class="crm-public-footer" id="civicrm-footer">
    {ts 1=$civilogo}empowered by %1{/ts}
  </div>
  {include file="CRM/common/notifications.tpl"}
{/if}
