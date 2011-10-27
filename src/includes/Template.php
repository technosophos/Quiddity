<?php
/**
 * Main template command.
 */

/**
 * This command provides templating support.
 */
class Template extends BaseQuiddityCommand {
  
  public function expects() {
    return $this
      ->description('Provides template support for formatting.')
      ->usesParam('template', 'The filename of the template to use.')
      ->whichIsRequired()
      ->usesParam('basePath', 'The base path in which the template should be found.')
      ->whichHasDefault('./')
      ->usesParam('includeContext', 'Boolean indicating whether or not the context should be imported.')
      ->whichHasDefault(TRUE)
      ->withFilter('boolean')
      ->andReturns('Marked-up content.')
    ;
  }
  
  public function doCommand() {
    // This is available inside of the template.
    $basePath = $this->param('basePath');
    
    $tpl = $basePath . $this->param('template');
    
    if ($this->param('includeContext')) {
      $c = $this->context->toArray();
      extract($c);
    }
    
    if (is_readable($tpl) && is_file($tpl)) {
      // Do we need ob_flush()?
      ob_start();
      include $tpl;
      $str = ob_get_contents();
      ob_end_clean();
      return $str;
    }
    
    return 'Could not read template';
  }
}