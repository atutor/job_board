<?php
/***********************************************************************/
/* ATutor															   */
/***********************************************************************/
/* Copyright (c) 2002-2009											   */
/* Adaptive Technology Resource Centre / Inclusive Design Institute	   */
/* http://atutor.ca													   */
/*																	   */
/* This program is free software. You can redistribute it and/or	   */
/* modify it under the terms of the GNU General Public License		   */
/* as published by the Free Software Foundation.					   */
/***********************************************************************/
// $Id$

/*******
 * doesn't allow this file to be loaded with a browser.
 */
if (!defined('AT_INCLUDE_PATH')) { exit; }

/*******
 * add savant variable
 */
global $savant;
require(AT_INCLUDE_PATH.'../mods/job_board/include/constants.inc.php');	//load constant file right away.
$savant->addPath('template', AT_JB_INCLUDE.'html/');

/******
 * this file must only be included within a Module obj
 */
if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) { exit(__FILE__ . ' is not a Module'); }

/*******
 * assign the instructor and admin privileges to the constants.
 */
define('AT_PRIV_JOB_BOARD',       $this->getPrivilege());
define('AT_ADMIN_PRIV_JOB_BOARD', $this->getAdminPrivilege());

/*******
 * create a side menu box/stack.
 */
//$this->_stacks['pa_photo_gallery'] = array('title_var'=>'pa_photo_gallery', 'file'=>AT_PA_BASE.'side_menu.inc.php');
// ** possible alternative: **
// $this->addStack('social', array('title_var' => 'social', 'file' => './side_menu.inc.php');

/*******
 * if this module is to be made available to students on the Home or Main Navigation.
 */
$_group_tool = $_student_tool = AT_JB_BASENAME.'index.php';

$this->_list['job_board'] = array('title_var'=>'job_board','file'=>AT_JB_BASENAME.'sublinks.php');
$this->_pages[AT_JB_BASENAME.'index.php']['icon']      = 'images/pin.png';

/*******
 * add the admin pages when needed.
 */
 if (admin_authenticate(AT_ADMIN_PRIV_JOB_BOARD, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
	$this->_pages[AT_NAV_ADMIN] = array(AT_JB_BASENAME.'index_admin.php');
	$this->_pages[AT_JB_BASENAME.'index_admin.php']['title_var'] = 'job_board';
	$this->_pages[AT_JB_BASENAME.'index_admin.php']['parent']    = AT_NAV_ADMIN;
	$this->_pages[AT_JB_BASENAME.'index_admin.php']['children']    = array(AT_JB_BASENAME.'admin/preferences.php', AT_JB_BASENAME.'admin/categories.php', AT_JB_BASENAME.'admin/employers.php');
		$this->_pages[AT_JB_BASENAME.'admin/preferences.php']['title_var'] = 'jb_preferences';
		$this->_pages[AT_JB_BASENAME.'admin/preferences.php']['parent'] = AT_JB_BASENAME.'index_admin.php';
		$this->_pages[AT_JB_BASENAME.'admin/categories.php']['title_var'] = 'jb_categories';
		$this->_pages[AT_JB_BASENAME.'admin/categories.php']['parent'] = AT_JB_BASENAME.'index_admin.php';
		$this->_pages[AT_JB_BASENAME.'admin/employers.php']['title_var'] = 'jb_employers';
		$this->_pages[AT_JB_BASENAME.'admin/employers.php']['parent'] = AT_JB_BASENAME.'index_admin.php';
		$this->_pages[AT_JB_BASENAME.'admin/view_post.php']['title_var'] = 'jb_view_post';
		$this->_pages[AT_JB_BASENAME.'admin/view_post.php']['parent'] = AT_JB_BASENAME.'index_admin.php';
		$this->_pages[AT_JB_BASENAME.'admin/edit_post.php']['title_var'] = 'jb_edit_post';
		$this->_pages[AT_JB_BASENAME.'admin/edit_post.php']['parent'] = AT_JB_BASENAME.'index_admin.php';
		$this->_pages[AT_JB_BASENAME.'admin/edit_employer.php']['title_var'] = 'jb_edit_employer';
		$this->_pages[AT_JB_BASENAME.'admin/edit_employer.php']['parent'] = AT_JB_BASENAME.'admin/employers.php';
}

/*******
 * instructor Manage section:
 */
//$this->_pages[AT_JB_BASENAME.'index_instructor.php']['title_var'] = 'social';
//$this->_pages[AT_JB_BASENAME.'index_instructor.php']['parent']   = 'tools/index.php';

// ** possible alternative: **
// $this->pages['./index_instructor.php']['title_var'] = 'social';
// $this->pages['./index_instructor.php']['parent']    = 'tools/index.php';

/*******
 * student page.
 */
$this->_pages[AT_JB_BASENAME.'index.php']['title_var'] = 'job_board';
$this->_pages[AT_JB_BASENAME.'index.php']['img']       = AT_JB_BASENAME.'images/jb_icon.png';
//$this->_pages[AT_JB_BASENAME.'index.php']['children'] = array(AT_JB_BASENAME.'view_post.php');
$this->_pages[AT_JB_BASENAME.'employer/login.php']['title_var'] = 'jb_employer_login';
$this->_pages[AT_JB_BASENAME.'employer/login.php']['parent'] = AT_JB_BASENAME.'index.php';
$this->_pages[AT_JB_BASENAME.'employer/registration.php']['title_var'] = 'jb_employer_registration';
$this->_pages[AT_JB_BASENAME.'employer/registration.php']['parent'] = AT_JB_BASENAME.'index.php';
$this->_pages[AT_JB_BASENAME.'employer/password_reminder.php']['title_var'] = 'password_reminder';
$this->_pages[AT_JB_BASENAME.'employer/password_reminder.php']['parent'] = AT_JB_BASENAME.'index.php';

$this->_pages[AT_JB_BASENAME.'employer/home.php']['title_var'] = 'jb_employer_home';
$this->_pages[AT_JB_BASENAME.'employer/home.php']['parent'] = AT_JB_BASENAME.'index.php';
$this->_pages[AT_JB_BASENAME.'employer/home.php']['children'] = array(AT_JB_BASENAME.'employer/add_new_post.php', AT_JB_BASENAME.'employer/profile.php');
$this->_pages[AT_JB_BASENAME.'employer/view_post.php']['title_var'] = 'jb_view_post';
$this->_pages[AT_JB_BASENAME.'employer/view_post.php']['parent'] = AT_JB_BASENAME.'employer/home.php';
$this->_pages[AT_JB_BASENAME.'employer/edit_post.php']['title_var'] = 'jb_edit_post';
$this->_pages[AT_JB_BASENAME.'employer/edit_post.php']['parent'] = AT_JB_BASENAME.'employer/home.php';
$this->_pages[AT_JB_BASENAME.'employer/add_new_post.php']['title_var'] = 'jb_add_new_post';
$this->_pages[AT_JB_BASENAME.'employer/add_new_post.php']['parent'] = AT_JB_BASENAME.'employer/home.php';
$this->_pages[AT_JB_BASENAME.'employer/profile.php']['title_var'] = 'jb_edit_profile';
$this->_pages[AT_JB_BASENAME.'employer/profile.php']['parent'] = AT_JB_BASENAME.'employer/home.php';

$this->_pages[AT_JB_BASENAME.'view_post.php']['title_var'] = 'jb_view_post';
$this->_pages[AT_JB_BASENAME.'view_post.php']['parent'] = AT_JB_BASENAME.'index.php';

$this->_pages[AT_JB_BASENAME.'subscribe.php']['title_var'] = 'jb_subscribe';
$this->_pages[AT_JB_BASENAME.'subscribe.php']['parent'] = AT_JB_BASENAME.'index.php';

/* public pages */
$this->_pages[AT_NAV_PUBLIC] = array(AT_JB_BASENAME.'index.php');
$this->_pages[AT_JB_BASENAME.'index.php']['parent'] = AT_NAV_PUBLIC;

/* my start page pages */
if(isset($_SESSION['member_id']) && $_SESSION['member_id']>0) {
$this->_pages[AT_NAV_START]  = array(AT_JB_BASENAME.'index.php');
$this->_pages[AT_JB_BASENAME.'index.php']['parent'] = AT_NAV_START;
}
?>
