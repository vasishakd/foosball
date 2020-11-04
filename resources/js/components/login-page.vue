<template>
    <div class="login-page">
        <div class="login-page__inner">
            <img
                :src="logo"
                alt="FFC logo"
                class="login-page__logo"
                loading="lazy"
                width="210"
                height="88"
            >
            <h1 class="login-page__title">
                Login
            </h1>
            <form
                method="post"
                action="/"
                class="login-page__form"
                novalidate
                @submit.prevent="submitLoginForm"
            >
                <label class="main-input login-page__input">
                    <input
                        v-model="fields.email"
                        type="email"
                        :class="[
                            'main-input__input',
                            {'main-input__input--error': fieldsErrors.email},
                        ]"
                        placeholder="Email"
                        @change="validateField(fields.email, 'email')"
                    >
                    <svg
                        :class="[
                            'main-input__icon',
                            {'main-input__icon--error': fieldsErrors.email},
                        ]"
                        width="24"
                        height="24"
                    >
                        <use xlink:href="#icon-user" />
                    </svg>
                </label>
                <label class="main-input login-page__input">
                    <input
                        v-model="fields.password"
                        type="password"
                        :class="[
                            'main-input__input',
                            {'main-input__input--error': fieldsErrors.password},
                        ]"
                        placeholder="Password"
                        @change="validateField(fields.password, 'password')"
                    >
                    <svg
                        :class="[
                            'main-input__icon',
                            {'main-input__icon--error': fieldsErrors.password},
                        ]"
                        width="24"
                        height="24"
                    >
                        <use xlink:href="#icon-lock" />
                    </svg>
                </label>
                <button
                    type="submit"
                    class="main-btn main-btn--black login-page__login-btn"
                >
                    Sign in
                </button>
            </form>
            <div class="login-page__sign-up-box">
                <p class="login-page__sign-up-text">
                    You are new?
                </p>
                <a
                    :href="urls.signUpPage"
                    class="login-page__sign-up-link"
                >Sign up</a>
            </div>
        </div>
    </div>
</template>

<script>
import { postData } from '../services/index.js';
import { notEmpty } from '../utilities/rules.js';

export default {
    name: 'LoginPage',
    props: {
        logo: String,
        actions: Object,
        urls: Object,
    },
    data() {
        return {
            fields: {
                email: '',
                password: '',
            },
            fieldsErrors: {
                email: false,
                password: false,
            },
        };
    },
    methods: {
        submitLoginForm() {
            this.validateField(this.fields.email, 'email');
            this.validateField(this.fields.password, 'password');

            if (this.checkFieldsErrors()) {
                return;
            }

            postData(this.actions.login, {
                email: this.fields.email,
                password: this.fields.password,
            }, () => {
                window.location.href = this.urls.homePage;
            });
        },
        validateField(fieldValue, fieldName) {
            this.$set(this.fieldsErrors, [fieldName], !notEmpty(fieldValue));
        },
        checkFieldsErrors() {
            let hasErrors = false;

            for (const field in this.fieldsErrors) {
                if (this.fieldsErrors[field]) {
                    hasErrors = true;
                }
            }

            return hasErrors;
        },
    },
};
</script>
