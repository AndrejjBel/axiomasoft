const checkLabel = () => {
    const inputs = document.querySelectorAll('.agreement input')
    if ( inputs ) {
        inputs.forEach((item) => {
            item.addEventListener('change', (e) => {
                if ( item.checked == true ) {
                    item.previousElementSibling.children[0].style.display = 'none'
                    item.previousElementSibling.children[1].style.display = 'block'
                    item.previousElementSibling.children[2].style.color = ''
                } else {
                    item.previousElementSibling.children[0].style.display = ''
                    item.previousElementSibling.children[1].style.display = 'none'
                }
            })
        });

    }

}
checkLabel()

const selectOptions = () => {
    const select = document.querySelector('.contact-form-modal__content__form__select')
    if ( select ) {
        const icon = document.querySelector('.contact-form-modal__content__form__select__icon')
        const options = document.querySelector('.contact-form-modal__content__form__select__options')
        const optionsItem = options.querySelectorAll('.contact-form-modal__content__form__select__options__item')
        const results = document.querySelector('.contact-form-modal__content__form__select__results')
        const text = document.querySelector('.contact-form-modal__content__form__select__text')
        const input = document.querySelector('#interested')
        const textDefolt = 'What are you interested in?'

        text.addEventListener('click', (e) => {
            icon.classList.toggle('active')
            options.classList.toggle('active')
        })
        optionsItem.forEach((item, i) => {
            item.addEventListener('click', (e) => {
                item.classList.toggle('current')
                item.children[1].classList.toggle('active')
                resultsOptions(optionsItem, text, input, textDefolt);
            })
        });

    }
}
selectOptions()

function resultsOptions(items, results, input, textDefolt) { // , results, input
    let resOptions = [];
    items.forEach((item, i) => {
        if ( item.classList.contains('current') ) {
            resOptions.push(item.innerText);
        }
    });
    if ( resOptions.length > 0 ) {
        results.innerText = resOptions.join(', ');
        input.value = resOptions.join(', ');
    } else {
        results.innerText = textDefolt;
        input.value = '';
    }
}

const contactFormSend = () => {
    const formStartProject = document.getElementById('form-start-project')
    if ( formStartProject ) {
        const formSubmit = document.getElementById('form-start-project-submit')

        formSubmit.addEventListener( 'click', (e) => {
            e.preventDefault();
            const nonce = document.getElementById('axiomasoft').value
            let formData = new FormData(formStartProject);
            formData.append('action', 'form_start');
            formData.append('nonce', nonce);
            jQuery(document).ready( function($){
                $.ajax({
                    url: "/wp-admin/admin-ajax.php",
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                        // Вывод текста в процессе отправки
                    },
                    success: function (data) {
                        // console.dir(data);
                        data = JSON.parse(data)
                        if ( data.class == 'success' ) {
                            document.querySelector('.contact-form-modal').classList.remove('active')
                            document.querySelector('#form-success').classList.add('active')
                        } else if ( data.class == 'errors' ) {
                            if ( data.email_error ) {
                                document.querySelector('#email').style.border = '1px solid #FF1313'
                                document.querySelector('#fill').classList.add('active')
                            } else if ( data.email_error_nocorrect ) {
                                document.querySelector('#email').style.border = '1px solid #FF1313'
                                document.querySelector('#check').classList.add('active')
                            }
                            if ( data.message_error ) {
                                document.querySelector('#message').style.border = '1px solid #FF1313'
                                document.querySelector('#textarea-warning').classList.add('active')
                            }
                            if ( data.privacy_policy_error ) {
                                document.querySelector('.privacy-policy-text').style.color = '#FF1313'
                            }

                        }
                    },
                    error: function (jqXHR, text, error) {
                        // console.log('Ошибка!!!');
                        document.querySelector('.contact-form-modal').classList.remove('active')
                        document.querySelector('#form-error').classList.add('active')
                    }
                });
            });
        })

        document.querySelector('#email').addEventListener( 'input', (e) => {
            document.querySelector('#email').style.border = ''
            document.querySelector('#fill').classList.remove('active')
            document.querySelector('#check').classList.remove('active')
        })
        document.querySelector('#message').addEventListener( 'input', (e) => {
            document.querySelector('#message').style.border = ''
            document.querySelector('#textarea-warning').classList.remove('active')
        })
    }
}
contactFormSend()
