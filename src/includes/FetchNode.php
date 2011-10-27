<?php
/**
 * Fetch a Drupal node from MongoDB.
 */

/**
 * This command retrieves a Drupal node from MongoDB.
 */
class FetchNode extends BaseQuiddityCommand {
  public function expects() {
    return $this
      ->description('Retrieve a node.')
      ->usesParam('nid', 'The node ID.')
      ->withFilter('int')
      ->whichIsRequired()
      ->andReturns('The node as an associative array.')
    ;
  }
  
  public function doCommand() {
    $nid = $this->param('nid');
    // Note that NID is a string in MongoDB because of the way I imported it.
    $node = $this->db()->nodes->findOne(array('nid' => (string)$nid));
    
    return $node;
  }
}