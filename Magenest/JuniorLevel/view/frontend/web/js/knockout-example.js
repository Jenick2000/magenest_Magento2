define(
    ['ko', 'jquery', 'uiComponent', 'Magento_Ui/js/modal/alert'],
    function (ko, $, Component, alert) {
        'use strict'
        return Component.extend({

            firstName: ko.observable('Hi !'),
            lastName: ko.observable(''),
            fullName: ko.observable(),
            convertToFullName: function () {

                if (this.firstName() === '') {
                    alert({
                        title: $.mage.__('Erorr'),
                        content: $.mage.__('First Name is required !'),
                        actions: {
                            always: function () {
                            }
                        }
                    });
                    return false;
                }
                if (this.lastName() === '') {
                    alert({
                        title: $.mage.__('Erorr'),
                        content: $.mage.__('Last Name is required !'),
                        actions: {
                            always: function () {
                            }
                        }
                    });
                    return false;
                }

                let strFirstName = this.firstName().split(' ');
                let strLastName = this.lastName().split(' ');
                let firstName = '';
                let lastName = '';
                for (let i = 0; i < strFirstName.length; i++) {
                    let f = strFirstName[i].substr(0, 1).toUpperCase();
                    let l = strFirstName[i].substr(1).toLowerCase();
                    let fl = f + l;
                    firstName += fl + ' ';
                }
                for (let i = 0; i < strLastName.length; i++) {
                    let f = strLastName[i].substr(0, 1).toUpperCase();
                    let l = strLastName[i].substr(1).toLowerCase();
                    let fl = f + l;
                    lastName += fl + ' ';
                }
                let fullName = firstName + lastName;
                this.fullName(fullName);
            },
            standardize: function () {
                let NameInput = this.firstName() + this.lastName();
                if (this.firstName() === '') {
                    alert({
                        title: $.mage.__('Erorr'),
                        content: $.mage.__('First Name is required !'),
                        actions: {
                            always: function () {
                            }
                        }
                    });
                    return false;
                }
                if (this.lastName() === '') {
                    alert({
                        title: $.mage.__('Erorr'),
                        content: $.mage.__('Last Name is required !'),
                        actions: {
                            always: function () {
                            }
                        }
                    });
                    return false;
                }
                for (let i = 0; i < NameInput.length; i++) {
                    let iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?";
                    if (iChars.indexOf(NameInput.charAt(i)) !== -1) {

                        alert({
                            title: $.mage.__('Erorr'),
                            content: $.mage.__('Name must is string not contain special characters  ~`!#$%^&*+=-[]\\\';,/{}|\":<>?'),
                            actions: {
                                always: function () {
                                }
                            }
                        });
                        return false;
                    }
                    if (NameInput.charAt(i) !== ' ') {
                        if (!isNaN(NameInput.charAt(i))) {           //if the string is a number, do the following
                            alert({
                                title: $.mage.__('Erorr'),
                                content: $.mage.__('Name must is string not contain number !'),
                                actions: {
                                    always: function () {
                                    }
                                }
                            });
                            return false;
                        }
                    }
                }

                let strFirstName = this.firstName().split(' ');
                let strLastName = this.lastName().split(' ');
                let firstName = '';
                let lastName = '';
                for (let i = 0; i < strFirstName.length; i++) {
                    let f = strFirstName[i].substr(0, 1).toUpperCase();
                    let l = strFirstName[i].substr(1).toLowerCase();
                    let fl = f + l;
                    firstName += fl + ' ';
                }
                for (let i = 0; i < strLastName.length; i++) {
                    let f = strLastName[i].substr(0, 1).toUpperCase();
                    let l = strLastName[i].substr(1).toLowerCase();
                    let fl = f + l;
                    lastName += fl + ' ';
                }
                let fullName = firstName + lastName;
                this.fullName(fullName);
            },

        });


    });