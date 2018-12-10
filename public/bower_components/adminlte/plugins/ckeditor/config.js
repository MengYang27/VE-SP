/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.extraPlugins = 'kcfinder';
	
	
    config.filebrowserBrowseUrl = '/guava/guava_admin/public/bower_components/adminlte/ckeditor/plugins/kcfinder/browse.php?opener=ckeditor&type=files';

    config.filebrowserImageBrowseUrl = '/guava/guava_admin/public/bower_components/adminlte/ckeditor/plugins/kcfinder/browse.php?opener=ckeditor&type=images';

    config.filebrowserFlashBrowseUrl = '/guava/guava_admin/public/bower_components/adminlte/ckeditor/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';

    config.filebrowserUploadUrl = '/guava/guava_admin/public/bower_components/adminlte/ckeditor/plugins/kcfinder/upload.php?opener=ckeditor&type=files';

    config.filebrowserImageUploadUrl = '/guava/guava_admin/public/bower_components/adminlte/ckeditor/plugins/kcfinder/upload.php?opener=ckeditor&type=images';

    config.filebrowserFlashUploadUrl = '/guava/guava_admin/public/bower_components/adminlte/ckeditor/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';	
	
};
