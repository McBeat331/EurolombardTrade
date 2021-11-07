const validateForm = (function() {

    function validate(inputElement, validationsArray) {
        const validations = validationsArray;
        let messages = [];

        function isNumber(input) {
            return !isNaN(parseFloat(input.value)) && isFinite(input.value);
        }

        function isNumberSecondary(input) {
            var value = input.value;
            var regEx = /[^0-9|.|,]/g;
            var prepearedValue = value.replace(regEx, "")

            return prepearedValue;
        }

        function isPhoneNumber(input) {
            var regex =/^(\+{0,})(\d{0,})([(]{1}\d{1,3}[)]{0,}){0,}(\s?\d+|\+\d{2,3}\s{1}\d+|\d+){1}[\s|-]?\d+([\s|-]?\d+){1,2}(\s){0,}$/gm;
            return regex.test(input.value);
        }

        function isEmail(input) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            return regex.test(input.value);
        }

        function isNotEmpty(input) {
            let isNotEmpty = input.value.replace(/\s/g,"").length ? true : false;
            let isNotWrongVal = input.value == "placeholder" ? false : true;
            return isNotEmpty && isNotWrongVal;
        }

        function isRadioChecked(input) {
            return input.querySelectorAll('input:checked').length ? true : false;
        }

        function isChecked(input) {
            return input.checked ? true : false;
        }

        function isShort(input) {
            let value = input.value;
            let splitArr = value.split('');
            return splitArr.length <= 3 ? false : true;
        }



        // ---------------------

        for (let i = 0; i < validations.length; i++) {

            switch (validations[i]) {
                case 'required':
                    if ( !isNotEmpty(inputElement) ) {
                        messages.push(inputElement.dataset.errorText)
                    }
                    break;

                case 'isNumber':
                    if ( !isNumber(inputElement) ) {
                        messages.push(inputElement.dataset.errorText)
                    }
                    break;

                case 'isNumberSecondary':
                    if ( !isNumberSecondary(inputElement) ) {
                        messages.push(inputElement.dataset.errorText)
                    }
                    break;

                case 'isPhoneNumber':
                    if ( !isPhoneNumber(inputElement) ) {
                        messages.push(inputElement.dataset.errorText)
                    }
                    break;

                case 'isEmail':
                    if ( !isEmail(inputElement) ) {
                        messages.push(inputElement.dataset.errorText);
                    }
                    break;

                case 'requiredRadio':
                    if ( !isRadioChecked(inputElement) ) {
                        messages.push(inputElement.dataset.errorText)
                    }
                    break;

                case 'requiredCheck':
                    if ( !isChecked(inputElement) ) {
                        messages.push(inputElement.dataset.errorText)
                    }
                    break;

                case 'isShort':
                    if ( !isShort(inputElement) ) {
                        messages.push(inputElement.dataset.errorText);
                    }
                    break;

                default: console.error('invalid input data-validate value')

            }
        }
        console.log(messages.length ? messages : null)
        return messages.length ? messages : null;
    }

    function showWarning(inputElement, messages, textColor) {
        inputElement.classList.add('js_containsError');
        let warningList = $('<ul class="js_warning-list"></ul>');

        for (let i = 0; i < messages.length; i++) {
            let listElement = $("<li></li>").text(messages[i]);
            textColor ? listElement.css('color', textColor) : null;
            warningList.append(listElement)
        }

        if (inputElement.nextElementSibling) {
            inputElement.nextElementSibling.tagName == 'LABEL' ?
                $(inputElement.nextElementSibling).after(warningList) :
                $(inputElement).after(warningList);
        } else {
            $(inputElement).after(warningList);
        }
    }

    function isValid(formElement) {
        const form = formElement instanceof jQuery ? formElement[0] : formElement;
        const inputs = form.querySelectorAll('[data-validate]');
        const checkboxesCheckedLength = form.querySelectorAll('[type=checkbox][data-validate-checkbox]:checked').length;
        const checkboxes = form.querySelectorAll('[type=checkbox][data-validate-checkbox]:not(:disabled)');

        let errorsCounter = 0;

        for (let i = 0; i < inputs.length; i++) {
            let errorMessages = [];
            let textColor = inputs[i].dataset.textColor;

            $(inputs[i]).removeClass("js_containsError");
            $(inputs[i]).siblings('.js_warning-list').remove();

            let validationsArray = [];
            let inputData = inputs[i].dataset.validate ? inputs[i].dataset.validate.split(' ') : false;
            // ---------
            inputs[i].value ? inputs[i].value = inputs[i].value.trim() : null;
            // ---------

            validationsArray = inputData ? inputData : null;
            // inputs[i].required ? validationsArray.push('required') : null;

            if (validationsArray.length) {
                let validationResult = validate(inputs[i], validationsArray);
                validationResult ? errorMessages = validationResult : null;
            }

            if (errorMessages.length) {
                showWarning(inputs[i], errorMessages, textColor);
                errorsCounter++;
            }
        }

        if ( checkboxes.length ) {
            const lastCheckbox = checkboxes[checkboxes.length - 1];

            function isValidCheckboxes() {
                $(lastCheckbox).siblings('.js_warning-list').remove();

                if ( !checkboxesCheckedLength ) {
                    let errorMessages = [];
                    errorMessages.push(lastCheckbox.dataset.errorText);

                    showWarning(lastCheckbox, errorMessages);
                    errorsCounter++;
                }
            }
            isValidCheckboxes();
        }


        return errorsCounter > 0 ? false : true;
        console.log('end for');
    }

    // ---------------
    return {
        isValid: isValid,
    }
})();

export {validateForm};