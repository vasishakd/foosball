<template>
    <div class="home-page">
        <div class="home-page__inner">
            <h1 class="home-page__title">
                New game
            </h1>
            <multiselect
                v-model="selectedPlayers"
                class="home-page__players-select"
                :options="players"
                :multiple="true"
                :searchable="false"
                :close-on-select="false"
                :show-labels="false"
                placeholder="Choose players"
                :clear-on-select="false"
                label="name"
                track-by="id"
                :max-height="290"
            >
                <template v-slot:caret>
                    <div
                        class="home-page__players-select-caret"
                    >
                        <svg
                            class="home-page__players-select-icon"
                            width="16"
                            height="16"
                        >
                            <use xlink:href="#icon-arrow-down" />
                        </svg>
                    </div>
                </template>
                <template v-slot:option="{option}">
                    <span class="home-page__players-select-option">
                        <span class="home-page__players-select-checkbox">
                            <svg
                                class="home-page__players-select-check"
                                width="18"
                                height="18"
                            >
                                <use xlink:href="#icon-check" />
                            </svg>
                        </span>
                        {{ option.name }}
                    </span>
                </template>
                <template v-slot:selection="{values}">
                    <span
                        v-if="values.length"
                        class="multiselect__placeholder"
                    >
                        {{ values.length }} players selected
                    </span>
                </template>
            </multiselect>
            <div class="home-page__range-slider js--range-slider" />
            <button
                class="home-page__randomize-btn main-btn main-btn--blue"
                type="button"
                @click="randomizePlayers"
            >
                Randomize 🎲
            </button>
            <main-popup
                title="Lucky guys  🎉"
                :is-opened.sync="wonPlayersPopupIsOpened"
            >
                <div class="home-page__won-players">
                    <ul class="home-page__won-players-list">
                        <li
                            v-for="player in wonPlayers"
                            :key="player.id"
                            class="home-page__won-player"
                        >
                            <div class="home-page__won-player-img-box">
                                <img
                                    :src="player.image"
                                    :alt="player.name"
                                    class="home-page__won-player-img"
                                >
                            </div>
                            <div class="home-page__won-player-text-box">
                                <strong class="home-page__won-player-name">
                                    {{ player.name }}
                                </strong>
                                <p class="home-page__won-player-slogan">
                                    {{ player.slogan }}
                                </p>
                            </div>
                            <div class="home-page__won-player-rating-box">
                                <b class="home-page__won-player-rating">
                                    {{ player.rating }}
                                </b>
                                <p class="home-page__won-player-rating-text">
                                    rating
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="home-page__popup-action-box">
                    <button
                        class="home-page__restart-btn main-btn main-btn--white"
                        type="button"
                        @click="randomizePlayers"
                    >
                        Randomize again
                    </button>
                    <a
                        :href="urls.game"
                        class="home-page__start-btn main-btn main-btn--yellow"
                    >
                        Start the game
                    </a>
                </div>
            </main-popup>
        </div>
        <nav class="main-menu">
            <ul class="main-menu__list">
                <li class="main-menu__item">
                    <a
                        href="#!"
                        class="main-menu__url main-menu__url--active"
                    >
                        <svg
                            class="main-menu__url-icon"
                            width="24"
                            height="24"
                        >
                            <use xlink:href="#icon-circle" />
                        </svg>
                        Home
                    </a>
                </li>
                <li class="main-menu__item">
                    <a
                        href="#!"
                        class="main-menu__url"
                    >
                        <svg
                            class="main-menu__url-icon"
                            width="24"
                            height="24"
                        >
                            <use xlink:href="#icon-star" />
                        </svg>
                        Stats
                    </a>
                </li>
                <li class="main-menu__item">
                    <a
                        href="#!"
                        class="main-menu__url"
                    >
                        <svg
                            class="main-menu__url-icon"
                            width="24"
                            height="24"
                        >
                            <use xlink:href="#icon-rectangle" />
                        </svg>
                        Games
                    </a>
                </li>
                <li class="main-menu__item">
                    <a
                        href="#!"
                        class="main-menu__url"
                    >
                        <svg
                            class="main-menu__url-icon"
                            width="24"
                            height="24"
                        >
                            <use xlink:href="#icon-circle" />
                        </svg>
                        Account
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect';
import noUiSlider from 'nouislider';
import axios from 'axios';
import MainPopup from './main-popup.vue';

export default {
    name: 'HomePage',
    components: {
        Multiselect,
        MainPopup,
    },
    props: {
        actions: Object,
        urls: Object,
        players: Array,
    },
    data() {
        return {
            selectedPlayers: [],
            playersCount: 1,
            wonPlayers: [],
            wonPlayersPopupIsOpened: false,
        };
    },
    mounted() {
        this.initRangeSlider();
    },
    methods: {
        initRangeSlider() {
            const rangeSlider = document.querySelector('.js--range-slider');

            noUiSlider.create(rangeSlider, {
                start: 1,
                step: 1,
                animate: false,
                range: {
                    min: 1,
                    max: 4,
                },
                connect: [
                    true,
                    false,
                ],
                pips: {
                    mode: 'count',
                    values: 4,
                },
            });

            rangeSlider.noUiSlider.on('change.one', (values) => {
                this.playersCount = +values[0];
            });
        },
        randomizePlayers() {
            axios.get(this.actions.randomize, {
                params: {
                    players: this.selectedPlayers,
                    playersCount: this.playersCount,
                },
            })
                .then((response) => {
                    this.wonPlayers = response.data.data.players;
                    this.wonPlayersPopupIsOpened = true;
                })
                .catch((error) => {
                    if (!error.response) {
                        alert('Ошибка сети. Пожалуйста, проверьте ваше подключение.');
                    } else {
                        alert(error.response.data.message);
                    }
                });
        },
    },
};
</script>

<style lang="scss">
@import "~vue-multiselect/dist/vue-multiselect.min.css";
@import "~nouislider/distribute/nouislider.min.css";
</style>
