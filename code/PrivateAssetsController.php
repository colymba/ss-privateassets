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
   * Serve file to user
   * @return SS_HTTPResponse The file to be downloaded
   */
  public function index()
  {
    $file = $this->request->getVar('file');
    $fileAssetPath = substr($file, stripos($file, 'assets'));    
    $fileObj = File::get()->filter(array('Filename' => $fileAssetPath))->first();

    if ( $fileObj )
    {
     $data = file_get_contents( $fileObj->getFullPath() );
     $name = $fileObj->getFilename();
     $response = SS_HTTPRequest::send_file($data, $name);
     return $response;
    }
    else {
      $this->httpError(404);
    }
  }

}