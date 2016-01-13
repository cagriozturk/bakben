<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'Hesap Başarıyla düzenlendi';
$lang['account_creation_unsuccessful'] 	 	 = 'Hesap Oluştur Açılamıyor';
$lang['account_creation_duplicate_email'] 	 = 'E-Posta zaten kullanılıyor ya da geçersiz';
$lang['account_creation_duplicate_username'] = 'Kullanıcı adı zaten kullanılıyor ya da geçersiz';

// Password
$lang['password_change_successful'] 	 	 = 'Parola Başarıyla Değiştirildi';
$lang['password_change_unsuccessful'] 	  	 = 'Parola Değiştirilemedi';
$lang['forgot_password_successful'] 	 	 = 'Parola sıfırlama E-Posta gönderildi.';
$lang['forgot_password_unsuccessful'] 	 	 = 'Parola Sıfırlama Açılamıyor';

// Activation
$lang['activate_successful'] 		  	     = 'Hesap Aktif Edildi.';
$lang['activate_unsuccessful'] 		 	     = 'Hesap etkinleştirme yapılamıyor';
$lang['deactivate_successful'] 		  	     = 'Hesap Devredışı';
$lang['deactivate_unsuccessful'] 	  	     = 'Hesap devredışı bırakılamıyor';
$lang['activation_email_successful'] 	  	 = 'Aktivasyon E-Posta gönderildi';
$lang['activation_email_unsuccessful']   	 = 'Aktivasyon E-Posta gönderilemiyor';

// Login / Logout
$lang['login_successful'] 		  	         = 'Başarıyla Giriş Yapıldı';
$lang['login_unsuccessful'] 		  	     = 'Yanlış Giriş';
$lang['login_unsuccessful_not_active'] 		 = 'Hesap Etkin Değil';
$lang['login_timeout']                       = 'Geçiçi olarak kilitlendi. Daha sonra tekrar deneyin.';
$lang['logout_successful'] 		 	         = 'Çıkış Yapıldı';

// Account Changes
$lang['update_successful'] 		 	         = 'Hesap bilgileri başarıyla güncellendi';
$lang['update_unsuccessful'] 		 	     = 'Hesap Bilgilerini Güncelleme açılamıyor';
$lang['delete_successful']               = 'Kullanıcı silindi';
$lang['delete_unsuccessful']           = 'Kullanıcı silinemiyor';

// Groups
$lang['group_creation_successful']  = 'Grup başarıyla oluşturuldu';
$lang['group_already_exists']       = 'Grup Adı zaten alınmış';
$lang['group_update_successful']    = 'Grup detayları güncellendi';
$lang['group_delete_successful']    = 'Grup silindi';
$lang['group_delete_unsuccessful'] 	= 'Grup silinemiyor';
$lang['group_name_required'] 		= 'Grup Adı gerekli bir alan';

// Activation Email
$lang['email_activation_subject']            = 'Hesap Aktivasyonu';
$lang['email_activate_heading']    = 'Hesabı Etkinleştirmek için %s';
$lang['email_activate_subheading'] = 'Lütfen Linke Tıklayın to %s.';
$lang['email_activate_link']       = 'Hesabınızı Etkinleştirin';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Unutulan Parolayı Doğrulama';
$lang['email_forgot_password_heading']    = 'Parola sıfırlamak için %s';
$lang['email_forgot_password_subheading'] = 'Lütfen linke tıklayın %s.';
$lang['email_forgot_password_link']       = 'Parola Sıfırlama';

// New Password Email
$lang['email_new_password_subject']          = 'Yeni Parola';
$lang['email_new_password_heading']    = 'Yeni Parola için %s';
$lang['email_new_password_subheading'] = 'Parola sıfırlama için: %s';
