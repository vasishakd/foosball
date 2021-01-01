<template>
    <div class="registration-page">
        <div class="registration-page__inner">
            <h1 class="registration-page__title">
                Sign up
            </h1>
            <p class="registration-page__description">
                You have chance to create new account if you really want to.
            </p>
            <form
                method="post"
                class="registration-page__form"
                novalidate
                @submit.prevent="submitRegistrationForm"
            >
                <label class="main-input registration-page__input">
                    <input
                        v-model="fields.name"
                        type="text"
                        name="name"
                        autocomplete="name"
                        :class="[
                            'main-input__input',
                            {'main-input__input--error': fieldsErrors.name},
                        ]"
                        placeholder="Full name"
                        @change="validateField(fields.name, 'name')"
                    >
                    <svg
                        :class="[
                            'main-input__icon',
                            {'main-input__icon--error': fieldsErrors.name},
                        ]"
                        width="24"
                        height="24"
                    >
                        <use xlink:href="#icon-user" />
                    </svg>
                </label>
                <label class="main-input registration-page__input">
                    <input
                        v-model="fields.email"
                        type="email"
                        name="email"
                        autocomplete="username"
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
                        <use xlink:href="#icon-mail" />
                    </svg>
                </label>
                <label class="main-input registration-page__input">
                    <input
                        v-model="fields.password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
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
                    class="main-btn main-btn--yellow registration-page__register-btn"
                >
                    Sign up
                </button>
            </form>
            <div class="registration-page__sign-in-box">
                <p class="registration-page__sign-in-text">
                    Already have account?
                </p>
                <a
                    :href="urls.login"
                    class="registration-page__sign-in-link"
                >Go here</a>
            </div>
        </div>
    </div>
</template>

<script>
// eslint-disable-next-line import/extensions
import { postData } from '../services';
import { notEmpty } from '../utilities/rules.js';

export default {
    name: 'RegistrationPage',
    props: {
        logo: String,
        actions: Object,
        urls: Object,
    },
    data() {
        return {
            fields: {
                name: '',
                email: '',
                password: '',
            },
            fieldsErrors: {
                name: false,
                email: false,
                password: false,
            },
        };
    },
    methods: {
        submitRegistrationForm() {
            this.validateField(this.fields.name, 'name');
            this.validateField(this.fields.email, 'email');
            this.validateField(this.fields.password, 'password');

            if (this.checkFieldsErrors()) return;

            postData(this.actions.registration, {
                email: this.fields.email,
                password: this.fields.password,
            }, () => {
                window.location.href = this.urls.home;
            });
        },
        validateField(fieldValue, fieldName) {
            this.fieldsErrors[fieldName] = !notEmpty(fieldValue);
        },
        checkFieldsErrors() {
            return !!Object.values(this.fieldsErrors).filter((field) => field).length;
        },
    },
};
</script>
