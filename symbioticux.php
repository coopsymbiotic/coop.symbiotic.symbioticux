<?php

require_once 'symbioticux.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function symbioticux_civicrm_config(&$config) {
  _symbioticux_civix_civicrm_config($config);

  if (empty(CRM_Utils_Request::retrieveValue('snippet', 'String'))) {
    CRM_Core_Resources::singleton()->addStyleFile('coop.symbiotic.symbioticux', 'css/symbioticux.css');
  }
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function symbioticux_civicrm_install() {
  return _symbioticux_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function symbioticux_civicrm_enable() {
  return _symbioticux_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_buildForm() is a completely overkill way.
 * Searches for an override class named after the initial $formName
 * and calls its buildForm().
 *
 * Ex: for a $formName "CRM_Case_Form_CaseView", it will:
 * - try to find * CRM/Symbioticux/Case/Form/CaseView.php,
 * - require_once the file, instanciate an object, and
 * - call its buildForm() function.
 *
 * Why so overkill? My buildForm() implementations tend to become
 * really big and numerous, and even if I split up into multiple
 * functions, it still makes a really long php file.
 */
function symbioticux_civicrm_buildForm($formName, &$form) {
  $formName = str_replace('CRM_', 'CRM_Symbioticux_', $formName);
  $parts = explode('_', $formName);
  $filename = dirname(__FILE__) . '/' . implode('/', $parts) . '.php';

  if (file_exists($filename)) {
    require_once $filename;
    $foo = new $formName;

    if (method_exists($foo, 'buildForm')) {
      $foo->buildForm($form);
    }
  }
}

/**
 * Implements hook_civicrm_pageRun() is a completely overkill way.
 * Searches for an override class named after the initial $formName
 * and calls its buildForm().
 *
 * Ex: for a $formName "CRM_Case_Form_CaseView", it will:
 * - try to find * CRM/Symbioticux/Case/Page/CaseView.php,
 * - require_once the file, instanciate an object, and
 * - call its pageRun() function.
 *
 * See @symbioticux_civicrm_buildForm() for more background info.
 */
function symbioticux_civicrm_pageRun(&$page) {
  $pageName = get_class($page);
  $pageName = str_replace('CRM_', 'CRM_Symbioticux_', $pageName);
  $parts = explode('_', $pageName);
  $filename = dirname(__FILE__) . '/' . implode('/', $parts) . '.php';

  if (file_exists($filename)) {
    require_once $filename;
    $foo = new $pageName;

    if (method_exists($foo, 'pageRun')) {
      $foo->pageRun($page);
    }
  }
}

/**
 * Implements hook_civicrm_dashboard().
 */
function symbioticux_civicrm_dashboard($contactID, &$contentPlacement) {
  Civi::resources()
    ->addStyleFile('coop.symbiotic.symbioticux', 'css/dashboard.css')
    ->addScriptFile('coop.symbiotic.symbioticux', 'js/dashboard.js');
}
