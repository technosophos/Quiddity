<?php
/**
 * The base command for connecting to the MongoDB database.
 */
 

/**
 * Command for connecting to the MongoDB.
 */
class DocDB extends BaseFortissimoCommand {
  
  public function expects() {
    return $this
      ->description('Get a connection to the MongoDB database.')
      ->usesParam('dbName', 'The name of the database.')
      ->andReturns('The database connection');
  }
  
  public function doCommand() {
    $m = new Mongo();
    $db = $m->selectDB($this->param('dbName', 'quiddity'));
    
    return $db;
  }
  
}