<template>
    <transition
        v-if="isOpened"
        name="fade"
    >
        <div class="main-popup-wrapper">
            <div class="main-popup">
                <div class="main-popup__header">
                    <button
                        class="main-popup__close-btn"
                        type="button"
                        aria-label="Close popup"
                        @click="closePopup"
                    >
                        <svg
                            class="main-popup__close-icon"
                            width="20"
                            height="20"
                        >
                            <use xlink:href="#icon-cross" />
                        </svg>
                    </button>
                    <h4 class="main-popup__title">
                        {{ title }}
                    </h4>
                </div>
                <div class="main-popup__content">
                    <slot />
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: 'MainPopup',
    props: {
        title: String,
        isOpened: Boolean,
    },
    methods: {
        closePopup() {
            this.$emit('update:isOpened', false);
        },
    },
};
</script>
