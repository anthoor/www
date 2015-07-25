<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
		'addauthor' => array(
				array(
					'field'=>'fname',
					'label'=>'First Name',
					'rules'=>'trim|required|xss_clean|max_length[50]'
				),
				array(
					'field'=>'mname',
					'label'=>'Middle Name',
					'rules'=>'trim|xss_clean|max_length[50]'
				),
				array(
					'field'=>'lname',
					'label'=>'Last Name',
					'rules'=>'trim|required|xss_clean|max_length[50]'
				)
			),
		'addpublisher' => array(
				array(
					'field'=>'pname',
					'label'=>'Publisher Name',
					'rules'=>'trim|required|xss_clean|max_length[200]'
				)
			),
		'addbook' => array(
				array(
					'field'=>'title',
					'label'=>'Book Title',
					'rules'=>'trim|required|xss_clean|max_length[200]'
				),
				array(
					'field'=>'authors[]',
					'label'=>'Authors',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[5]'
				),
				array(
					'field'=>'edition',
					'label'=>'Edition',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|less_than[1000]'
				),
				array(
					'field'=>'year',
					'label'=>'Year of Publication',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[4]'
				),
				array(
					'field'=>'publisher',
					'label'=>'Publisher Name',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[5]'
				)
			),
		'addcopy' => array(
				array(
					'field'=>'title',
					'label'=>'Book Title',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[8]'
				),
				array(
					'field'=>'copies',
					'label'=>'Number of Copies',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|less_than[11]'
				),
				array(
					'field'=>'shelf',
					'label'=>'Shelf Name',
					'rules'=>'trim|required|xss_clean|alpha|exact_length[1]'
				),
				array(
					'field'=>'row',
					'label'=>'Row ID',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|less_than[10]'
				)

			),
		'damagecopy' => array(
				array(
					'field'=>'copyid',
					'label'=>'Copy ID',
					'rules'=>'trim|required|xss_clean|integer|callback_valid_copy'
				)
			),
		'removecopy' => array(
				array(
					'field'=>'copyid',
					'label'=>'Copy ID',
					'rules'=>'trim|required|xss_clean|integer|callback_valid_copy'
				)
			),
		'issuebook' => array(
				array(
					'field'=>'user',
					'label'=>'User',
					'rules'=>'trim|required|xss_clean|integer|callback_user_issueable'
				),
				array(
					'field'=>'copyid',
					'label'=>'Copy ID',
					'rules'=>'trim|required|xss_clean|integer|callback_valid_copy'
				)
			),
		'renewbook' => array(
				array(
					'field'=>'issue[]',
					'label'=>'Issues',
					'rules'=>'trim|required|xss_clean|integer|callback_is_renewable'
				)
			),
		'returnbook' => array(
				array(
					'field'=>'issue[]',
					'label'=>'Issues',
					'rules'=>'trim|required|xss_clean|integer|exact_length[10]'
				)
			),
		'adduser' => array(
				array(
					'field'=>'name',
					'label'=>'Full Name',
					'rules'=>'trim|required|xss_clean|max_length[200]'
				),
				array(
					'field'=>'uname',
					'label'=>'User Name',
					'rules'=>'trim|required|xss_clean|alpha_numeric|max_length[50]|is_unique[user.name]'
				),
				array(
					'field'=>'password',
					'label'=>'Password',
					'rules'=>'trim|required|min_length[6]|max_length[32]'
				),
				array(
					'field'=>'type',
					'label'=>'User Type',
					'rules'=>'trim|required|xss_clean|integer|max_length[5]'
				),
				array(
					'field'=>'email',
					'label'=>'E Mail',
					'rules'=>'trim|required|xss_clean|valid_email|max_length[200]|is_unique[user.email]'
				),
				array(
					'field'=>'mobile',
					'label'=>'Mobile Number',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|max_length[15]'
				)
			),
		'suspenduser' => array(
				array(
					'field'=>'user',
					'label'=>'User',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[5]|callback_is_not_self'
				)
			),
		'revokesuspension' => array(
				array(
					'field'=>'user',
					'label'=>'User',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[5]'
				)
			),
		'removeuser' => array(
				array(
					'field'=>'user',
					'label'=>'User',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|exact_length[5]|callback_is_not_self'
				)
			),
		'editprofile' => array(
				array(
					'field'=>'name',
					'label'=>'Full Name',
					'rules'=>'trim|required|xss_clean|max_length[200]'
				),
				array(
					'field'=>'email',
					'label'=>'E Mail',
					'rules'=>'trim|required|xss_clean|valid_email|max_length[200]|callback_email_check'
				),
				array(
					'field'=>'mobile',
					'label'=>'Mobile Number',
					'rules'=>'trim|required|xss_clean|is_natural_no_zero|max_length[15]'
				)
			),
		'changepassword' => array(
				array(
					'field'=>'opassword',
					'label'=>'Current Password',
					'rules'=>'trim|required|min_length[6]|max_length[32]|callback_password_confirm'
				),
				array(
					'field'=>'npassword',
					'label'=>'New Password',
					'rules'=>'trim|required|min_length[6]|max_length[32]|differs[opassword]'
				),
				array(
					'field'=>'cpassword',
					'label'=>'Confirm Password',
					'rules'=>'trim|required|matches[npassword]'
				)
			),
		'verifylogin' => array(
				array(
					'field'=>'username',
					'label'=>'Username',
					'rules'=>'trim|required|xss_clean|alpha_numeric|max_length[50]'
				),
				array(
					'field'=>'password',
					'label'=>'Password',
					'rules'=>'trim|required|min_length[6]|max_length[32]|callback_check_database'
				)
			)
	);