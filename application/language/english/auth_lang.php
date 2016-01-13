<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Giriş';
$lang['login_subheading']      = 'Lütfen Kullanıcı Adı veya E-Posta girin';
$lang['login_identity_label']  = 'E-Posta/Kullanıcı Adı:';
$lang['login_password_label']  = 'Şifre:';
$lang['login_remember_label']  = 'Beni Hatırla:';
$lang['login_submit_btn']      = 'Giriş';
$lang['login_forgot_password'] = 'Şifremi Unuttum?';

// Index
$lang['index_heading']           = 'Kullanıcı';
$lang['index_subheading']        = 'Kullanıcı Listesi Aşağıdadır';
$lang['index_fname_th']          = 'Ad';
$lang['index_lname_th']          = 'Soyad';
$lang['index_email_th']          = 'E-Posta';
$lang['index_groups_th']         = 'Grup';
$lang['index_status_th']         = 'Durum';
$lang['index_action_th']         = 'Eylem';
$lang['index_active_link']       = 'Aktif';
$lang['index_inactive_link']     = 'Pasif';
$lang['index_create_user_link']  = 'Yeni Bir Üye';
$lang['index_create_group_link'] = 'Yeni Bir Grup';

// Deactivate User
$lang['deactivate_heading']                  = 'Pasif Üye';
$lang['deactivate_subheading']               = 'Kullanıcıyı devredışı bırakmak istiyor musun \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Evet:';
$lang['deactivate_confirm_n_label']          = 'Hayır:';
$lang['deactivate_submit_btn']               = 'Gönder';
$lang['deactivate_validation_confirm_label'] = 'Onayla';
$lang['deactivate_validation_user_id_label'] = 'Kullanıcı ID';

// Create User
$lang['create_user_heading']                           = 'Yeni Üye';
$lang['create_user_subheading']                        = 'Detaylı Bilgi İçin Lütfen Kayıt Olun';
$lang['create_user_fname_label']                       = 'Ad:';
$lang['create_user_lname_label']                       = 'Soyad:';
$lang['create_user_company_label']                     = 'Şirket Adı:';
$lang['create_user_email_label']                       = 'E-Posta:';
$lang['create_user_phone_label']                       = 'Telefon:';
$lang['create_user_password_label']                    = 'Şifre:';
$lang['create_user_password_confirm_label']            = 'Şifre Tekrar:';
$lang['create_user_submit_btn']                        = 'Yeni Üye';
$lang['new_user_submit_btn']                           = 'Gönder';
$lang['signup_user_submit_btn']                        = 'Kaydol';
$lang['create_user_validation_fname_label']            = 'Ad';
$lang['create_user_validation_lname_label']            = 'Soyad';
$lang['create_user_validation_email_label']            = 'E-Posta Adresi';
$lang['create_user_validation_phone1_label']           = 'Ev Telefonu';
$lang['create_user_validation_phone2_label']           = 'Cep Telefonu';
$lang['create_user_validation_phone3_label']           = 'İşyeri Telefonu';
$lang['create_user_validation_company_label']          = 'Şirket Adı';
$lang['create_user_validation_password_label']         = 'Şifre';
$lang['create_user_validation_password_confirm_label'] = 'Şifre Onayı';

// Edit User
$lang['edit_user_heading']                           = 'Üye Düzenle';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'Ad:';
$lang['edit_user_lname_label']                       = 'Soyad:';
$lang['edit_user_company_label']                     = 'Firma Adı:';
$lang['edit_user_email_label']                       = 'E-Posta:';
$lang['edit_user_phone_label']                       = 'Telefon:';
$lang['edit_user_password_label']                    = 'Şifre: (Şifre değişimi)';
$lang['edit_user_password_confirm_label']            = 'Şifreyi Onayla: (Şifre değişimi)';
$lang['edit_user_groups_heading']                    = 'Grup Üyesi';
$lang['edit_user_submit_btn']                        = 'Üye Kaydet';
$lang['edit_user_validation_fname_label']            = 'Ad';
$lang['edit_user_validation_lname_label']            = 'Soyad';
$lang['edit_user_validation_email_label']            = 'E-Posta Adres';
$lang['edit_user_validation_phone1_label']           = 'Birinci Telefon';
$lang['edit_user_validation_phone2_label']           = 'İkinci Telefon';
$lang['edit_user_validation_phone3_label']           = 'Üçüncü Telefon';
$lang['edit_user_validation_company_label']          = 'Firma Adı';
$lang['edit_user_validation_groups_label']           = 'Grup';
$lang['edit_user_validation_password_label']         = 'Şifre';
$lang['edit_user_validation_password_confirm_label'] = 'Şifrey Onayı';

// Create Group
$lang['create_group_title']                  = 'Yeni Grup';
$lang['create_group_heading']                = 'Yeni Grup';
$lang['create_group_subheading']             = 'Aşağıdaki grup bilgilerini giriniz.';
$lang['create_group_name_label']             = 'Grup İsmi:';
$lang['create_group_desc_label']             = 'Açıklama:';
$lang['create_group_submit_btn']             = 'Yeni Grup';
$lang['create_group_validation_name_label']  = 'Grup İsmi';
$lang['create_group_validation_desc_label']  = 'Açıklama';

// Edit Group
$lang['edit_group_title']                  = 'Grubu Düzenle';
$lang['edit_group_saved']                  = 'Grubu Kaydet';
$lang['edit_group_heading']                = 'Grubu Düzenle';
$lang['edit_group_subheading']             = 'Aşağıdaki grup bilgilerini giriniz.';
$lang['edit_group_name_label']             = 'Grup İsmi:';
$lang['edit_group_desc_label']             = 'Açıklama:';
$lang['edit_group_submit_btn']             = 'Grubu Kaydet';
$lang['edit_group_validation_name_label']  = 'Grup ismi';
$lang['edit_group_validation_desc_label']  = 'Açıklama';

// Şifreyi Değiştir
$lang['change_password_heading']                               = 'Şifreyi Değiştir';
$lang['change_password_old_password_label']                    = 'Eski şifre:';
$lang['change_password_new_password_label']                    = 'Yeni Şifre (minimum %s karakter olmalıdır):';
$lang['change_password_new_password_confirm_label']            = 'Yeni Şifreyi Onayla:';
$lang['change_password_submit_btn']                            = 'Değiştir';
$lang['change_password_validation_old_password_label']         = 'Eski şifre';
$lang['change_password_validation_new_password_label']         = 'Yeni Şifre';
$lang['change_password_validation_new_password_confirm_label'] = 'Yeni Şifreyi Onayla';

// Şifremi Unuttum
$lang['forgot_password_heading']                 = 'Şifremi Unuttum';
$lang['forgot_password_subheading']              = 'Geçerli değil E-Posta';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Gönder';
$lang['forgot_password_validation_email_label']  = 'E-Posta Adres';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_email_identity_label']    = 'E-Posta';
$lang['forgot_password_email_not_found']         = 'E-Posta Kayıtlı değildir.';

// Reset Password
$lang['reset_password_heading']                               = 'Şifreyi Değiştir';
$lang['reset_password_new_password_label']                    = 'Yeni Şifre (minimum %s karakter olmalıdır):';
$lang['reset_password_new_password_confirm_label']            = 'Yeni Şifreyi Onayla:';
$lang['reset_password_submit_btn']                            = 'Değiştir';
$lang['reset_password_validation_new_password_label']         = 'Yeni Şifre';
$lang['reset_password_validation_new_password_confirm_label'] = 'Yeni Şifreyi Onayla';

//Contact Form
$lang['contact_form_validation_name_label']          = 'Ad';
$lang['contact_form_validation_email_label']         = 'E-Posta';
$lang['contact_form_validation_phone_label']         = 'Telefon';
$lang['contact_form_validation_address_label']       = 'Adres';
$lang['contact_form_validation_subject_label']       = 'Konu';

