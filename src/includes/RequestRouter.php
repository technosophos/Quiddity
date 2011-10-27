<?php
/**
 * This contains the command for implementing a front controller for Quiddity.
 *
 * This takes a path and attempts to match it to some pattern in the database. If a suitable
 * pattern is found, the request is forwarded to the appropriate request handler.
 *
 * Substitution rules for parameters:
 * - Parameters may have sprintf-style substitution rules indexed numerically.
 * - Example: %1$s is replaced with the first item in a path, stored as a string.
 * - %1$d will convert the first item in the path to a digit, first. Similar with %1$f for float.
 * - See {@link http://us2.php.net/manual/en/function.sprintf.php} and {@link http://us2.php.net/manual/en/function.vsprintf.php}
 */

/**
 * The request router command.
 * This command acts basically like a front controller. It takes a URI and maps the 
 * URI onto a particular request handler, configuring the environment appropriately.
 */
class RequestRouter extends BaseQuiddityCommand {
  public function expects() {
    return $this
      ->description('Acts as the front controller for the application.')
      ->usesParam('pathCollection', 'The name of the collection where path information is stored.')
      ->usesParam('requestPath', 'The path.')
      ->withFilter('string')
      ->andReturns('A populated context. This also redirects to the appropriate request handler.')
    ;
  }
  
  public function doCommand() {
    
    // Get path
    $path = $this->normalizePath($this->param('requestPath', '/index'));
    
    //print "Path::" . $path . '::';
    
    $path_parts = explode('/', $path, 256);
    
    // Look it up. We just want the best match.
    $query = array(
      'path' => array('$in' => $this->buildWildcardPattern($path_parts))
    );
    $matches = $this->db()->paths->find($query)->sort(array('path' => -1))->limit(1);
    
    // If we have a match, get ready to redirect.
    if ($matches->count() > 0) {
      // We only need top match.
      $matches->next();
      $match = $matches->current();

      // Populate the context with data from the paths table and the URL.
      if (!empty($match['params'])) {
        foreach ($match['params'] as $param => $value) {
          $this->context->add($param, vsprintf($value, $path_parts));
        }
      }

      // Redirect to the appropriate request handler
      throw new FortissimoForwardRequest($match['request'], $this->context);
    }
    
    // If we get here, we missed. Typically, the last command in this request chain
    // should generate a 404.
  }
  
  /**
   * Convert a path to a normalized form.
   * This does things like strip leading slashes.
   * 
   * @param string $path
   *  The path to normalize.
   * @return string
   *  The normalized path.
   */
  public function normalizePath($path) {
    if (empty($path)) {
      $path = 'index';
    }
    // Remove leading slash
    elseif (strpos($path, '/') === 0) {
      $path = substr($path, 1);
    }
    
    return $path;
  }
  
  /**
   * Parse a path and build a wildcard pattern.
   *
   * This takes a single path and builds all necessary wildcard patterns.
   *
   * E.g. if the path is foo/bar/baz, this will return an array with the following values:
   * - foo/bar/baz
   * - foo/bar / *
   * - foo/ * / *
   * - * / * / *
   *
   * (Note: spaces above added to prevent code parse errors -- they are not in generated content.)
   *
   * @param array $path
   *  The path as an array. E.g. foo/bar/baz becomes array('foo', 'bar', 'baz').
   * @return array
   *  An array of string patterns.
   */
  protected function buildWildcardPattern($path_parts) {
    $dest = array(implode('/', $path_parts));
    
    $plength = count($path_parts);
    if ($plength > 1) {
      for($i = $plength; $i > 0; --$i) {
        $path_parts[$i -1] = '*';
        $dest[] = implode('/', $path_parts);
      }
    }
    
    return $dest;
  }
}