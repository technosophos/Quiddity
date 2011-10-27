<?php
/**
 * Base class for Quiddity commands.
 */

/**
 * Base class for Quiddity commands.
 */
abstract class BaseQuiddityCommand extends BaseFortissimoCommand {
  
  /**
   * @return MongoDB
   *  Initialized MongoDB connection.
   */
  protected function db() {
    return $this->context('db');
  }
  
}