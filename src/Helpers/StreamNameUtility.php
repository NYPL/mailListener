<?php
namespace NYPL\Services\Helpers\StreamNameUtility;

use NYPL\Services\Helpers\StreamNameUtility;

class StreamNameUtility
{
  /**
   *
   * @return string
   */
  public function getStreamName {
    return ARN; // ljc
  };

  /**
   *
   * @return string
   */
  public function properCaseWithSpace {
    if (getStreamName() == 'Patron') {
      return 'Patron';
    } else if (getStreamName() == 'NewPatron') {
      return 'New Patron';
    }
  };

  /**
   *
   * @return string
   */
  public function camelCase {
    if (getStreamName() == 'Patron') {
      return 'patron';
    } else if (getStreamName() == 'NewPatron') {
      return 'new_patron';
    }
  };

}
