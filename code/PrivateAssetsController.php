<?php
/**
 * SilverStripe 3.1 Private Assests
 * Requires login to view/download file from assets/private/** folder
 *
 * @author  Thierry Francois @colymba thierry@colymba.com
 * @copyright Copyright (c) 2013, Thierry Francois
 *
 * @license http://opensource.org/licenses/BSD-3-Clause BSD Simplified
 *
 * @package private_assets
 */
class PrivateAssetsController extends Controller
{
  public static $allowed_actions = array ();

  /**
   * Controller inititalisation
   * Check if user is logged in, if not redirect to login form
   */
  public function init()
  {
    parent::init();

    if ( !Member::currentUserID() )
    {
      Security::permissionFailure();
    }
  }

  /**
   * Output file to user.
   * Send file content to browser for download progressively.
   */
  public function index()
  {
    $file          = $this->request->getVar('file');
    $fileAssetPath = substr($file, stripos($file, 'assets'));
    $fileObj       = File::get()->filter(array('Filename' => $fileAssetPath))->first();

    if ( $fileObj )
    {
      $filePath = $fileObj->getFullPath();
      $mimeType = HTTP::get_mime_type($filePath);
      $name     = $fileObj->Name;

      header("Content-Type: $mimeType");
      header("Content-Disposition: attachment; filename=\"$name\"");
      header("Pragma: public");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

      set_time_limit(0);
      $file = @fopen($filePath,"rb");
      while(!feof($file))
      {
        print(@fread($file, 1024*8));
        ob_flush();
        flush();
      }
      exit;
    }
    else {
      $this->httpError(404);
    }
  }

}