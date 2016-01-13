/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'tr';
	config.uiColor = '#AADC6E';
	  //Dosya Yöneticisi
    config.filebrowserBrowseUrl = '/fileman/index.html';// Öntanımlı Dosya Yöneticisi
    config.filebrowserImageBrowseUrl = '/fileman/index.html?type=image'; // Sadece Resim Dosyalarını Gösteren Dosya Yöneticisi
    config.removeDialogTabs = 'link:upload;image:upload'; // Upload işlermlerini dosya Yöneticisi ile yapacağımız için upload butonlarını kaldırıyoruz
    //---------
};
