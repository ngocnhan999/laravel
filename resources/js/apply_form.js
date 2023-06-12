var WCSEO = WCSEO || {},
    focused = false;
WCSEO.showMessage = function (element, msg) {
    if ($(element).parent().find('.error').length > 0) {
        $(element).parent().find('.error').html(msg);
        $(element).addClass('has-error');
        $(element).parent().find('.error').show();
    }
};
WCSEO.setFocus = function (element) {
    if (focused == false) {
        focused = true;
        $(element).focus();
    }
};

WCSEO.hideMessage = function (element) {
    if ($(element).parent().find('.error').length > 0) {
        $(element).removeClass('has-error');
        $(element).parent().find('.error').delay(3000).hide();
    }
};

WCSEO.isEmail = function (a) {
    var b = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return b.test(a);
};

WCSEO.isPhoneNumber = function (b) {
    var flag = false;
    b = b.replace('(+84)', '0');
    b = b.replace('+84', '0');
    b = b.replace('0084', '0');
    b = b.replace(/ /g, '');
    if (b !== '') {
        var firstNumber = b.substring(0, 2);
        if ((firstNumber === '09' || firstNumber === '08' || firstNumber === '05' || firstNumber === '03' || firstNumber === '07') && b.length === 10) {
            if (b.match(/^\d{10}/)) {
                flag = true;
            }
        }
    }
    return flag;
};

WCSEO.validURL = function (str) {
    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
    return !!pattern.test(str);
}

var formElementsInit = function () {
    //Select2 select
    var feSelect2 = function () {
        if ($(".select2-basic").length > 0) {
            $('.select2-basic').select2({
                minimumResultsForSearch: Infinity
            });
        }
        if ($(".select2-search").length > 0) {
            $('.select2-search').select2({
                width: '100%'
            });
        }
        if ($(".select-search").length > 0) {
            $('.select-search').select2({
                width: '100%'
            });
        }
        if ($(".select2-tags").length > 0) {
            $('.select2-tags').select2({
                tokenSeparators: [','],
            });
        }
    }
    var feInputmask = function () {
        if ($('.inputmask').length > 0) {
            $('.inputmask').inputmask();
        }
    }

    var feDatePicker = function () {
        if ($('.datePicker').length > 0) {
            $('.datePicker').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true,
                changeMonth: true,
                changeYear: true
            });
        }
    }


    //END Select2 select
    //Auto numeric input
    var feAutoNumeric = function () {
        if ($(".autoNumeric").length > 0) {
            $('.autoNumeric').autoNumeric('init');
        }

    }
    //END auto numeric input

    return {
        init: function () {
            feSelect2();
            feAutoNumeric();
            feInputmask();
            feDatePicker();
        }
    }
}();

(function ($) {
    "use strict";

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        formElementsInit.init();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            formElementsInit.init();
        });

        var handleValidationError = function (errors, form) {
            let message = '';
            $.each(errors, (index, item) => {
                message += item + '<br />';
            });

            $(form).find('.text-success').html('').hide();
            $(form).find('.text-danger').html('').hide();

            $(form).find('.text-danger').html(message).show();
        };

        var showError = function (message) {
            $('.contact-error-message').html(message).show();
        };

        var showSuccess = function (message) {
            $('.contact-success-message').html(message).show();
        };

        var handleErrorContact = function (data) {
            if (typeof (data.errors) !== 'undefined' && data.errors.length) {
                handleValidationError(data.errors);
            } else {
                if (typeof (data.responseJSON) !== 'undefined') {
                    if (typeof (data.responseJSON.errors) !== 'undefined') {
                        if (data.status === 422) {
                            handleValidationErrorContact(data.responseJSON.errors);
                        }
                    } else if (typeof (data.responseJSON.message) !== 'undefined') {
                        showError(data.responseJSON.message);
                    } else {
                        $.each(data.responseJSON, (index, el) => {
                            $.each(el, (key, item) => {
                                showError(item);
                            });
                        });
                    }
                } else {
                    showError(data.statusText);
                }
            }
        };

        var handleValidationErrorContact = function (errors) {
            let message = '';
            $.each(errors, (index, item) => {
                if (message !== '') {
                    message += '<br />';
                }
                message += item;
            });
            showError(message);
        };

        $('#txtPhone,input[type=tel]').keypress(function (evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        });

        $('.dobDatePicker').datepicker({
            format: 'dd/mm/yyyy',
            endDate: new Date('2004-12-31'),
            autoclose: true,
            viewMode: 'years',
            changeMonth: true,
            changeYear: true
        }).on('changeDate', function (selected) {
            if (selected) {
                $('span.errDob').html('');
            }
        });

        $(document).on('change', 'input#vietseeds_select', function (evt) {
            evt.preventDefault();
            if ($(this).val() == 1) {
                $('.extend_v').show().find('input').addClass('required');
            } else {
                $('.extend_v').hide().find('input').removeClass('required');
            }
        })

        $(document).on('click', 'a.removeSingleImage', function (evt) {
            evt.preventDefault();
            evt.stopPropagation();
            let obj = $(this),
                action_url = $(this).data('action'),
                action_type = $(this).data('type');
            $.ajax({
                'url': action_url,
                'type': 'POST',
                'data': {'_method': 'DELETE', 'type': action_type},
                'async': true,
                'dataType': 'json',
            }).done(function (data, statusText, xhr) {
                if (!data.error) {
                    if (data.data.type === 'house') {
                        $('.showSingleFileHouseUpload').hide().html('');
                        $('.singleFileHouseUpload').show();
                    } else if (data.data.type === 'people') {
                        $('.showSingleFilePeopleUpload').hide().html('');
                        $('.singleFilePeopleUpload').show();
                    } else if (data.data.type === 'family') {
                        $('.showSingleFileUpload').hide().html('');
                        $('.singleFileUpload').show();
                    } else if (data.data.type === 'letter') {
                        $('#hddFileLetter').val('');
                        $('.loadData').html('');
                        $('.introducingLetter').show();
                    } else {
                        let count = data.data.count;
                        if (count < 5) {
                            $('.showMultipleFileUpload').show();
                        }
                        obj.parents('.fbox-media3').remove()
                    }
                }
            }).fail(function (data) {

            });
            return false;
        });
        $("input,textarea").keyup(function (event) {
            event.preventDefault();
            if ($(this).val().trim().length !== 0) {
                WCSEO.hideMessage($(this));
                /*if (WCSEO.isPhoneNumber($(this).val()) === false) {
                    WCSEO.showMessage($(this), 'Số điện thoại không đúng định dạng.');
                    return;
                } else {

                }*/
            }
            if ($(this).hasClass('is_validate')) {
                let obj = $(this),
                    table = obj.parents('table.phone_numbers');
                if (WCSEO.isPhoneNumber($(this).val()) === false) {
                    WCSEO.showMessage($(this), 'Số điện thoại không đúng định dạng.');
                    return;
                } else {
                    if (table.length > 0) {
                        $(table).find('input.is_validate').each(function (index, value) {
                            let inputPhone = $(this);
                            WCSEO.hideMessage(obj);
                            if (!inputPhone.is(obj)) {
                                if (inputPhone.val().trim().length > 0 && inputPhone.val() === obj.val()) {
                                    WCSEO.showMessage(obj, 'Vui lòng không nhập trùng số điện thoại.');
                                }
                            } else {
                                WCSEO.hideMessage(obj);
                            }
                        });
                    }
                }
            }

            if ($(this).hasClass('is_validate_owner')) {
                let obj = $(this),
                    table = obj.parents('table.phone_numbers');
                if (table.length > 0) {
                    $(table).find('input.is_validate_owner').each(function (index, value) {
                        let inputPhone = $(this);
                        if (!inputPhone.is(obj) && inputPhone.val() === obj.val()) {
                            WCSEO.showMessage(obj, 'Vui lòng không nhập trùng tên Họ và tên.');
                        } else {
                            let txtLastName = $("#txtLastName").val();
                            if (inputPhone.val().indexOf(txtLastName) != -1) {
                                WCSEO.showMessage(inputPhone, 'Họ tên đệm hoặc tên không được nhập trùng tên bạn.');
                            }
                        }
                    });
                }
            }
        });
        $("select").change(function (event) {
            event.preventDefault();
            if ($(this).val().trim().length !== 0) {
                WCSEO.hideMessage($(this));
            }
        });

        $(document).on('change', '#sltYearRank', function (evt) {
            evt.preventDefault();
            if ($(this).val() == 6) {
                $('.totalAmount').show().find('label').addClass('required');
                $('.totalAmount').find('input').addClass('required');
            } else {
                $('.totalAmount').hide().find('label').removeClass('required');
                $('.totalAmount').find('input').removeClass('required');
            }
        });

        var navListItems = $('ul.tab-steps li.nav-item a.nav-link'),
            nextTabBtn = $('button.nextTabBtn'),
            prevTabBtn = $('button.btnPrev'),
            allNextBtn = $('.nextBtn'),
            prevBtn = $('button.prev');

        allNextBtn.click(function (evt) {
            evt.preventDefault();
            let curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                curStepTab = $('ul.tab-steps li.nav-item a.nav-link[href="#' + curStepBtn + '"]'),
                nextStepWizard = curStepTab.parent().next().children("a"),
                curInputs = curStep.find("input[type=text],input[type='url'],textarea[textarea]"),
                isValid = true,
                eleSetupContent = $(this).parents('.setup-content');

            isValid = WCSEO.isValidElementContentStepForm(eleSetupContent);

            if (isValid) {
                curStepTab.parent().find('.nav-button').hide()
                curStepTab.parent().next().find('.nav-button').show();
                nextStepWizard.removeAttr('disabled').trigger('click').addClass('active');
            }
        });

        nextTabBtn.click(function (evt) {
            evt.preventDefault();
            let curStep = $(this).closest(".setup-content"),
                isValid = true,
                currentTab = $(this).data('current'),
                nextStepBtn = $(this).data("next"),
                nextStepTab = $('ul.tab-steps li.nav-item a.nav-link[href="#' + nextStepBtn + '"]'),
                nextStepWizard = nextStepTab.parent('li'),
                eleSetupContent = $("#" + currentTab);

            isValid = WCSEO.isValidElementContentStepForm(eleSetupContent);

            if (isValid) {
                $(this).parent('.nav-button').hide();
                nextStepTab.removeAttr('disabled').trigger('click');
                nextStepWizard.addClass('active show').find('.nav-button').show();
                $("#hddCurrentTab").val(nextStepBtn);
            }
        });

        prevTabBtn.click(function (evt) {
            evt.preventDefault();
            let prevStepBtn = $(this).data('prev'),
                prevStepTab = $('ul.tab-steps li.nav-item a.nav-link[href="#' + prevStepBtn + '"]'),
                prevStepWizard = prevStepTab.parent('li');
            $(this).parent('.nav-button').hide();
            if (prevStepTab.length > 0) {
                prevStepTab.trigger('click');
                prevStepWizard.find('.nav-button').show();
                $("#hddCurrentTab").val(prevStepBtn);
            }
        });

        $(document).on('click', 'button.prev', function (evt) {
            evt.preventDefault();
            let tabPrev = $(this).data('prev'),
                prevStepTab = $('ul.tab-steps li.nav-item a.nav-link[href="#' + tabPrev + '"]');
            prevStepTab.trigger('click');

            $('html,body').animate({
                    scrollTop: $("#content").offset().top
                }, 'slow'
            );
        })
        // Remove Row
        $("table").on('click', 'a.removeRow', function (evt) {
            evt.preventDefault();
            let removeItem = $(this).parents('tr');
            if (removeItem.length > 0) {
                removeItem.remove();
            }
        });
        // On Change Select
        $(document).on('change', 'select.is_accepted', function (evt) {
            evt.preventDefault();
            let row = $(this).parents('tr'),
                isApplying = row.find('input.is_applying');
            if ($(this).val() === "0") {
                isApplying.prop('checked', false).attr('disabled', 'disabled')
            } else {
                isApplying.prop('checked', true).removeAttr('disabled')
            }
        });
    });


    WCSEO.isValidElementContentStepForm = function (eleSetupContent) {
        try {
            let isValid = true;
            eleSetupContent.find('input[type=number]').each(function () {
                WCSEO.hideMessage($(this));
                if ($(this).hasClass('required') === true) {
                    if ($(this).val().trim().length === 0) {
                        if ($(this).attr('data-required') !== undefined) {
                            WCSEO.showMessage($(this), $(this).attr('data-required'));
                        } else {
                            WCSEO.showMessage($(this), 'Vui lòng nhập thông tin!');
                        }
                        isValid = false;
                    }
                    /*else {
                        if (WCSEO.isPhoneNumber($(this).val()) === false) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số điện thoại không đúng định dạng.');
                        } else {
                            WCSEO.hideMessage($(this));
                        }
                    }

                    if ($(this).hasClass('is_validate')) {
                        let obj = $(this),
                            table = obj.parents('table.phone_numbers');
                        if (table.length > 0) {
                            $(table).find('input.is_validate').each(function (index, value) {
                                let inputPhone = $(this);
                                if (!inputPhone.is(obj)) {
                                    if (inputPhone.val().trim().length > 0 && inputPhone.val() === obj.val()) {
                                        WCSEO.showMessage(obj, 'Vui lòng không nhập trùng số điện thoại.');
                                        isValid = false;
                                    }
                                }
                            });
                        }
                    }*/
                }
                if ($(this).attr('numberonly') !== undefined && $(this).val().trim().length !== 0 && !($(this).is(':hidden'))) {
                    var reg = /^\d+$/;
                    // integer
                    if ($(this).attr('numberonly') === '1' && !reg.test($(this).val())) {
                        WCSEO.showMessage($(this), "Bạn cần nhập số.");
                        isValid = false;
                    }
                    // double or float
                    if ($(this).attr('numberonly') === '2' && (isNaN($(this).val()) || !parseFloat($(this).val()) > 0)) {
                        WCSEO.showMessage($(this), "Bạn cần nhập số.");
                        isValid = false;
                    }
                }
            });
            eleSetupContent.find('input[type=tel]').each(function () {
                WCSEO.hideMessage($(this));
                if ($(this).hasClass('required') === true) {
                    if ($(this).val().trim().length === 0) {
                        if ($(this).attr('data-required') !== undefined) {
                            WCSEO.showMessage($(this), $(this).attr('data-required'));
                        } else {
                            WCSEO.showMessage($(this), 'Vui lòng nhập thông tin!');
                        }
                        isValid = false;
                    } else {
                        if (!$(this).hasClass('highSchoolPhone')){
                            if (WCSEO.isPhoneNumber($(this).val()) === false) {
                                isValid = false;
                                WCSEO.showMessage($(this), 'Số điện thoại không đúng định dạng.');
                            } else {
                                WCSEO.hideMessage($(this));
                            }
                        }
                    }

                    if ($(this).hasClass('is_validate')) {
                        let obj = $(this),
                            table = obj.parents('table.phone_numbers');
                        if (table.length > 0) {
                            $(table).find('input.is_validate').each(function (index, value) {
                                let inputPhone = $(this);
                                if (!inputPhone.is(obj)) {
                                    if (inputPhone.val().trim().length > 0 && inputPhone.val() === obj.val()) {
                                        WCSEO.showMessage(obj, 'Vui lòng không nhập trùng số điện thoại.');
                                        isValid = false;
                                    }
                                } else {
                                    if (inputPhone.val().trim().length > 0 && inputPhone.val() == $("#txtPhone").val()) {
                                        WCSEO.showMessage(inputPhone, 'Số điện thoại không được trùng số cá nhân.');
                                        isValid = false;
                                    }
                                }
                            });
                        }
                    }
                }
            });
            eleSetupContent.find('input[type=text],input[type=hidden]').each(function () {
                WCSEO.hideMessage($(this));
                if ($(this).hasClass('required') === true) {
                    if ($(this).val().trim().length === 0) {
                        if ($(this).attr('data-required') !== undefined) {
                            if ($(this).attr('id') === 'dob') {
                                $('.errDob').html($(this).attr('data-required'));
                            }
                            WCSEO.showMessage($(this), $(this).attr('data-required'));
                        } else {
                            WCSEO.showMessage($(this), 'Vui lòng nhập thông tin!');
                        }
                        isValid = false;
                    } else {
                        if ($(this).hasClass('is_validate_owner')) {
                            let obj = $(this),
                                table = obj.parents('table.phone_numbers');
                            if (table.length > 0) {
                                $(table).find('input.is_validate_owner').each(function (index, value) {
                                    let inputPhone = $(this);
                                    if (!inputPhone.is(obj) && inputPhone.val() === obj.val()) {
                                        isValid = false;
                                        WCSEO.showMessage(obj, 'Vui lòng không nhập trùng tên Họ và tên.');
                                    } else {
                                        let txtLastName = $("#txtLastName").val();
                                        if (inputPhone.val().indexOf(txtLastName) != -1) {
                                            WCSEO.showMessage(inputPhone, 'Họ tên đệm hoặc tên không được trùng.');
                                            isValid = false;
                                        }
                                    }
                                });
                            }
                        }
                    }

                    if ($(this).attr('minlength') !== undefined) {
                        let minlength = parseInt($(this).attr('minlength'));
                        if (minlength < $(this).val().split(' ').length) {
                            WCSEO.showMessage($(this), 'Số ký tự tối thiểu ' + minlength);
                            isValid = false;
                        }
                    }
                    if ($(this).attr('maxlength') !== undefined) {
                        let maxlength = parseInt($(this).attr('maxlength'));
                        if (maxlength < $(this).val().length) {
                            WCSEO.showMessage($(this), 'Số ký tự cần nhỏ hơn ' + maxlength);
                            isValid = false;
                        }
                    }
                }
                if ($(this).val().trim().length > 0) {
                    if ($(this).attr('minwords') !== undefined) {
                        let minlength = parseInt($(this).attr('minwords'));
                        if ($(this).val().split(' ').length < minlength) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số ký tự tối thiểu ' + minlength + ' từ');
                        }
                    }
                    if ($(this).attr('maxwords') !== undefined) {
                        let maxlength = parseInt($(this).attr('maxwords'));
                        if ($(this).val().split(' ').length > maxlength) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số ký tự cần nhỏ hơn ' + maxlength + ' từ');
                        }
                    }
                }

                if ($(this).attr('numberonly') !== undefined && $(this).val().trim().length !== 0 && !($(this).is(':hidden'))) {
                    var reg = /^\d+$/;
                    // integer
                    if ($(this).attr('numberonly') === '1' && !reg.test($(this).val())) {
                        WCSEO.showMessage($(this), "Bạn cần nhập số.");
                        isValid = false;
                    }
                    // double or float
                    if ($(this).attr('numberonly') === '2' && (isNaN($(this).val()) || !parseFloat($(this).val()) > 0)) {
                        WCSEO.showMessage($(this), "Bạn cần nhập số.");
                        isValid = false;
                    }
                }
            });
            eleSetupContent.find('textarea').each(function () {
                WCSEO.hideMessage($(this));
                $('.errDob').html('');
                if ($(this).hasClass('required') === true) {
                    if ($(this).val().trim().length === 0) {
                        if ($(this).attr('data-required') !== undefined) {
                            if ($(this).attr('id') === 'dob') {
                                $('.errDob').html($(this).attr('data-required'));
                            }
                            WCSEO.showMessage($(this), $(this).attr('data-required'));
                        } else {
                            WCSEO.showMessage($(this), 'Vui lòng nhập thông tin!');
                        }
                        isValid = false;
                    }
                    if ($(this).attr('minwords') !== undefined) {
                        let minlength = parseInt($(this).attr('minwords'));
                        if ($(this).val().split(' ').length < minlength) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số ký tự tối thiểu ' + minlength + ' từ');
                        }
                    }
                    if ($(this).attr('maxwords') !== undefined) {
                        let maxlength = parseInt($(this).attr('maxwords'));
                        if ($(this).val().split(' ').length > maxlength) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số ký tự cần nhỏ hơn ' + maxlength + ' từ');
                        }
                    }
                }

                if ($(this).val().trim().length > 0) {
                    if ($(this).attr('minwords') !== undefined) {
                        let minlength = parseInt($(this).attr('minwords'));
                        if ($(this).val().split(' ').length < minlength) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số ký tự tối thiểu ' + minlength + ' từ');
                        }
                    }
                    if ($(this).attr('maxwords') !== undefined) {
                        let maxlength = parseInt($(this).attr('maxwords'));
                        if ($(this).val().split(' ').length > maxlength) {
                            isValid = false;
                            WCSEO.showMessage($(this), 'Số ký tự cần nhỏ hơn ' + maxlength + ' từ');
                        }
                    }
                }

            });
            eleSetupContent.find('select').each(function () {
                WCSEO.hideMessage($(this));
                if ($(this).hasClass('required') === true) {
                    if ($(this).val().trim().length === 0 || $(this).val() === '-1') {
                        WCSEO.showMessage($(this), 'Vui lòng chọn thông tin!');
                        isValid = false;
                    }
                }

                if ($(this).hasClass('yearly_rank')) {
                    if ($(this).val() == 6) {
                        let year_income = $('input.yearly_income');
                        if (year_income.val().trim().length === 0) {
                            isValid = false;
                            WCSEO.showMessage($('input.yearly_income'), 'Vui lòng chọn thông tin!');
                        } else {
                            if (parseInt(year_income.val().replaceAll(',', '')) < 50000000) {
                                isValid = false;
                                WCSEO.showMessage($('input.yearly_income'), 'Tổng thu nhập hàng năm phải lớn hơn hoặc bằng 50,000,000 VND');
                            }
                        }
                    }
                }
            });
            if (!isValid) {

                $('html,body').animate({
                        scrollTop: $("#content").offset().top
                    }, 'slow'
                );
            }
            return isValid;
        } catch (e) {
            console.log(e);
            return true;
        }
    }

})(jQuery);
