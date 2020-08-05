'use strict';
document.addEventListener('DOMContentLoaded', function(){
    //Functions
    const get = (selector, node = undefined) => (node && node.querySelector(selector)) || document.querySelector(selector);

    function createErrors(errors, collectionTags) {
        Object.keys(errors).forEach((key, index) => {
            if(errors[key] !== '') {
                collectionTags[index].textContent = errors[key];
                collectionTags[index].style.display = 'block';
            } else {
                collectionTags[index].style.display = 'none';
            }
        })
    }

    function createMessage(parentElement, message) {
        const node = document.createElement('h2');
              node.classList.add('text-success', 'text-center');
              node.textContent = message;
        parentElement.appendChild(node);
    }

    function removeElements(parentElement) {
        while (parentElement.firstChild) {
            parentElement.removeChild(parentElement.firstChild);
        };
    }

    function checkRequire(reqField, errorArr, keyError) {
        if(!reqField || reqField.length === 0) {
            return errorArr[keyError] = 'This field is require';
        }
    }

    function checkLength(value, min, max, errorArr, keyError) {
        if(!errorArr[keyError]) {
            if(value.length < min || value.length > max) {
                const fieldName = keyError.substr(5, keyError.length)
                                          .split(/\\W+|(?=[A-Z])|_/g)
                                          .join(' ');
                return errorArr[keyError] = `${fieldName} ${min}-${max} character`;
            }
        }
    }

    function checkEmail(email, errorArr, keyError) {
        if(!errorArr[keyError]) {
            const mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!email.match(mailFormat)) {
                return errorArr[keyError] = 'Email invalid';
            }
        }
    }

    function checkPassword(password, errorArr, keyError) {
        if(!errorArr[keyError]) {
            const passwordFormat = /^[0-9a-zA-Z]+$/;
            if(!password.match(passwordFormat)) {
                return errorArr[keyError] = 'Password invalid';
            }
        }
    }

    function checkPhone(phone, errorArr, keyError) {
        if(!errorArr[keyError]) {
            const phoneFormat = /^\d{10}$/;
            if(!phone.match(phoneFormat)) {
                return errorArr[keyError] = 'Phone invalid';
            }
        }
    }
    //Functions//

    //Constants
    const errorsTags = document.querySelectorAll('.text-error');
    const formWrapper = get('.form-wrapper');
    const formBtn = get('.form-submit');
    const firstName = get('.first-name');
    const lastName = get('.last-name');
    const email = get('.email');
    const password = get('.password');
    const phone = get('.phone');
    const terms = get('.terms');
    //Constants//



    formBtn.addEventListener('click', function(e) {
        e.preventDefault();
        let errors = {
            'errorFirstName': '',
            'errorLastName': '',
            'errorEmail': '',
            'errorPassword': '',
            'errorPhone': '',
            'errorTerms': '',
        };

        checkRequire(firstName.value.trim(), errors, 'errorFirstName');
        checkLength(firstName.value.trim(), 2, 15, errors, 'errorFirstName');

        checkRequire(lastName.value.trim(), errors, 'errorLastName');
        checkLength(lastName.value.trim(), 3, 20, errors, 'errorLastName');

        checkRequire(email.value.trim(), errors, 'errorEmail');
        checkEmail(email.value.trim(), errors, 'errorEmail');

        checkRequire(password.value.trim(), errors, 'errorPassword');
        checkPassword(password.value.trim(), errors, 'errorPassword');
        checkLength(password.value.trim(),6, 12, errors, 'errorPassword');

        checkRequire(phone.value.trim(), errors, 'errorPhone');
        checkPhone(phone.value.trim(), errors, 'errorPhone');

        checkRequire(terms.checked, errors, 'errorTerms');

        if(Object.values(errors).every(error => (error === ''))) {
            const headers = {
                    "Content-Type": "application/json",
                    "Access-Control-Origin": "*"
                 }
                const formData = {
                    "first_name": firstName.value.trim(),
                    "last_name": lastName.value.trim(),
                    "email": email.value.trim(),
                    "password": password.value.trim(),
                    "phone": phone.value.trim(),
                    "terms": terms.checked,
                }
                
                fetch("formController/index.php", {
                    method: "POST",
                    headers: headers,
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if(response.statusText === 'OK' && response.status === 200) {
                        return response.json();
                    } else if(response.statusText === 'Validate Error') {
                        return response.json().then(Promise.reject.bind(Promise));
                    }
                })
                .then(data => {
                    console.log(data);
                    removeElements(formWrapper);
                    createMessage(formWrapper, data);
                })
                .catch(errors => {
                    console.log(errors);
                    createErrors(errors, errorsTags);
                })
        } else {
            createErrors(errors, errorsTags);
        }
    });
});