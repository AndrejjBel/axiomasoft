<div class="modal contact-form-modal" data-modal="start-project">
    <svg class="contact-form-modal__close js-modal-close" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.9143 20.0002L30.7532 11.1613L29.339 9.74707L20.5001 18.5859L11.6614 9.74722L10.2472 11.1614L19.0859 20.0002L10.2471 28.839L11.6613 30.2532L20.5001 21.4144L29.339 30.2533L30.7533 28.8391L21.9143 20.0002Z" fill="#2B2B2B" fill-opacity="0.5"/>
    </svg>
    <h3 class="contact-form-modal__title galderglynn-CdRg">Start the project</h3>
    <p class="contact-form-modal__subtitle">Please share your ideas, challenges or questions below and we'll get back to you shortly</p>
    <div class="contact-form-modal__content">
        <form id="form-start-project" class="contact-form-modal__content__form">
            <div class="contact-form-modal__content__form__group">
                <input class="input-form" type="text" name="first-name" value="" placeholder="First name">
                <input class="input-form" type="text" name="last-name" value="" placeholder="Last name">
            </div>

            <div class="contact-form-modal__content__form__group">
                <div class="required-input">
                    <input id="email" class="input-form" type="text" name="email" value="" placeholder="E-mail*">
                    <span id="fill" class="required-input__warning">Fill the  E-mail</span>
                    <span id="check" class="required-input__warning">Check the E-mail</span>
                </div>
                <input class="input-form phone-inputs" type="text" name="phone" value="" placeholder="Phone number">
            </div>

            <div class="contact-form-modal__content__form__group">
                <input class="input-form" type="text" name="job-title" value="" placeholder="Job title">
                <input class="input-form" type="text" name="company" value="" placeholder="Company">
            </div>

            <div class="contact-form-modal__content__form__select">
                <svg class="contact-form-modal__content__form__select__icon" width="8" height="6" viewBox="0 0 8 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 6L0.500001 -6.55671e-07L8 0L4.25 6Z" fill="#2B2B2B"/>
                </svg>
                <span class="contact-form-modal__content__form__select__text">What are you interested in?</span>
                <!-- <div class="contact-form-modal__content__form__select__results"></div> -->
                <input id="interested" type="hidden" name="interested" value="">
                <div class="contact-form-modal__content__form__select__options">
                    <?php axiomasoft_services_contact_list(); ?>
                </div>
            </div>

            <div class="contact-form-modal__content__form__textarea">
                <textarea id="message" name="message" rows="6" cols="80" placeholder="Message*"></textarea>
                <span id="textarea-warning" class="contact-form-modal__content__form__textarea__warning">Fill the message</span>
            </div>

            <div class="contact-form-modal__content__form__group">

            <div class="agreement">
                <div class="agreement__item">
                    <label for="privacy-policy">
                        <svg class="checked-no" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="5" stroke="rgba(43, 43, 43, 0.5)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg class="checked-yes" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="20" height="20" rx="4" fill="#2B2B2B"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.70711 11.2892C8.31658 10.8986 7.68342 10.8986 7.29289 11.2892C6.90237 11.6797 6.90237 12.3128 7.29289 12.7034L10.9996 16.41L17.7105 9.70755C18.1013 9.31728 18.1017 8.68411 17.7114 8.29334C17.3211 7.90257 16.688 7.90217 16.2972 8.29245L11.0004 13.5825L8.70711 11.2892Z" fill="white"/>
                        </svg>
                        <span class="privacy-policy-text">I have read and accepted the Terms & Conditions and Privacy Policy*</span>
                    </label>
                    <input type="checkbox" id="privacy-policy" name="privacy-policy" value="yes" />
                </div>

                <div class="agreement__item">
                    <label for="subscribe">
                        <svg class="checked-no" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="5" stroke="rgba(43, 43, 43, 0.5)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg class="checked-yes" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="20" height="20" rx="4" fill="#2B2B2B"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.70711 11.2892C8.31658 10.8986 7.68342 10.8986 7.29289 11.2892C6.90237 11.6797 6.90237 12.3128 7.29289 12.7034L10.9996 16.41L17.7105 9.70755C18.1013 9.31728 18.1017 8.68411 17.7114 8.29334C17.3211 7.90257 16.688 7.90217 16.2972 8.29245L11.0004 13.5825L8.70711 11.2892Z" fill="white"/>
                        </svg>
                        <span>Subscribe to our latest insights & events</span>
                    </label>
                    <input type="checkbox" id="subscribe" name="subscribe" value="yes" />
                </div>
            </div>

            <div class="contact-form-modal__content__form__button">
                <button id="form-start-project-submit" class="site-btn" type="button" name="button">Send</button>
            </div>

            </div>

        </form>
    </div>
</div>
