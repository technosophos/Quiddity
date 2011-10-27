<?php
/**
 * Sends content to standard output.
 */
 

/**
 * This command writes a string out output to STDOUT.
 *
 * Why is this done as a second step? So that we can provide caching implementations that 
 * work independently of the theming system. Theming happens in one step, and writing happens in
 * another. This command could then be replaced with a Cache and Flush option that cached this content,
 * and then flushed it to output. Another step could then retrieve from the cache and flush.
 */
class FlushContent extends BaseQuiddityCommand {
  public function expects() {
    return $this
      ->description('Flush a named buffer to STDOUT. Typically, this is used to dump template contents.')
      ->usesParam('data', 'The data to flush.')
      ->whichHasDefault('')
      ->andReturns('Nothing. Data is printed to STDOUT.')
    ;
  }
  
  public function doCommand() {
    $out = $this->param('data');
    print $out;
  }
}