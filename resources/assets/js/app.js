/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import $ from 'jquery';
import Dropzone from './dropzone';

$(function () {
    new Dropzone('#dropzone-form', {
        uploadMultiple: true,
        createImageThumbnails: false,
        previewTemplate: '<div class="uploaded-image"><span data-dz-name></span> <strong class="dz-size" data-dz-size></strong><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div></div>',
    });
});
