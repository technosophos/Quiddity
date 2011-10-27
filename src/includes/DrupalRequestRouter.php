<?php
/**
 * Look up a path against the Drupal node paths.
 *
 */

/**
 * The request router command.
 *
 * This command takes a path and searches the node collection in MongoDB for a node with a matching path.
 */
class DrupalRequestRouter extends BaseQuiddityCommand {
  public function expects() {
    return $this
      ->description('Searches for Drupal nodes with a matching path.')
      ->usesParam('pathCollection', 'The name of the collection where path information is stored.')
      ->usesParam('requestPath', 'The path.')
      ->withFilter('string')
      ->usesParam('nodeHandler', 'The request that should handle loading the node.')
      ->withFilter('string')
      ->andReturns('A populated context. This also redirects to the appropriate request handler.')
    ;
  }
  
  public function doCommand() {
    
    // Get the path
    $path = $this->normalizePath($this->param('requestPath', '/index'));
    
    // Determine what we are going to forward to if we find the node.
    $nodeHandler = $this->param('nodeHandler', 'nodeHandler');
    
    // Build a query to search Mongo
    $query = array('path' => $path);
    
    // Do the search.
    $match = $this->db()->nodes->findOne($query);
    
    // If we have a match, get ready to redirect.
    if (!empty($match)) {
      
      // Add the node to the context
      $this->context->add($this->name, $match);

      // Redirect to the appropriate request handler
      throw new FortissimoForwardRequest($nodeHandler, $this->context);
    }
    
    // If we get here, we missed. Typically, the last command in this request chain
    // should generate a 404.
  }
  
  /**
   * Normalize a path for lookup.
   *
   * @param string $path
   *  The path to normalize.
   * @return string
   *  The normalized path.
   */
  public function normalizePath($path) {
    
    // Strip leading slash.
    if (strpos($path, '/') === 0) {
      $path = substr($path, 1);
    }
    
    return $path;
  }
  
}