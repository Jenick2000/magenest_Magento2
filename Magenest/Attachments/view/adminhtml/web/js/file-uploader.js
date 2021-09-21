define([
    'jquery',
    'Magento_Ui/js/form/element/file-uploader'
], function ($, fileUploader) {
    'use strict';

    return fileUploader.extend({

        onFileUploaded: function (event, data) {
            console.log(data)
            let self = this;
            let result = data.result;
            if(result.file !== undefined) {
                let file = result.file.split('.');
                this.source.data.file_name = file[0];
                this.source.data.file_extension = file[1];
                this.source.data.file_label = file[0];
                $('input[name="file_name"]').val(file[0]);
                $('input[name="file_extension"]').val(file[1]);
                $('input[name="file_label"]').val(file[0]);
            }
            this._super();
        }
    });
});
