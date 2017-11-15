/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

//CKEDITOR.replace( 'editor1', {
  //extraPlugins: 'imageuploader'
//});

CKEDITOR.editorConfig = function( config ) {
    config.enterMode = CKEDITOR.ENTER_BR;
    //config.extraPlugins = 'imageuploader';

};
CKEDITOR.dtd.$removeEmpty['i'] = false