<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Match
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto px-1 py-5 sm:px-6 lg:px-8">
                <multiselect
                        :searchable="false"
                        v-model="activePlayers"
                        :options="players"
                        :multiple="true"
                        track-by="id"
                        label="name"
                        :close-on-select="false"
                        :max-height="1000"
                >
                </multiselect>

                <div class="flex flex-wrap -mx-2">
                    <div v-for="amount in 4" class="w-1/2 my-2 text-center">
                        <button
                                @click="getRandomPlayers(amount)"
                                class="btn-color w-3/4 text-white py-2 px-4 rounded my-1"
                                :disabled="!activePlayers.length"
                        >
                            {{ amount }}
                        </button>
                    </div>
                </div>

                <ul v-if="randomPlayers.length" class="flex flex-wrap -mx-2">
                    <li v-for="item in randomPlayers" class="w-1/2 my-2 px-2">
                        <label class="checkbox-container">
                            <input
                                    v-model="winners"
                                    :value="item.id"
                                    type="checkbox"
                                    class="hidden"
                                    :disabled="winners.length >= winnersNumber && winners.indexOf(item.id) === -1"
                            >
                            <span class="checkbox-button text-center block black rounded py-2 px-4 text-white">
                                {{ item.name }}
                            </span>
                        </label>
                    </li>
                </ul>

                <div v-if="randomPlayers.length" class="flex">
                    <button
                            @click="sendWinners"
                            class="btn-color w-1/3 mx-auto text-white py-2 px-4 rounded my-4"
                            :disabled="winners.length < winnersNumber"
                    >
                        Winner{{ winnersNumber > 1 ? 's' : ''}}
                    </button>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../Layouts/AppLayout";
    import Multiselect from 'vue-multiselect';
    import axios from 'axios';


    export default {
        components: {
            AppLayout,
            Multiselect,
        },

        props: {
            defaultPlayers: Array,
        },

        data() {
            return {
                activePlayers: [],
                randomPlayers: [],
                winners: [],
                players: this.defaultPlayers,
                showMessage: false,
            }
        },

        methods: {
            shuffle(array) {
                let m = array.length, t, i;

                // While there remain elements to shuffle…
                while (m) {

                    // Pick a remaining element…
                    i = Math.floor(Math.random() * m--);

                    // And swap it with the current element.
                    t = array[m];
                    array[m] = array[i];
                    array[i] = t;
                }

                return array;
            },

            getRandomPlayers(number) {
                this.winners = [];
                let players = this.activePlayers;
                this.randomPlayers = this.shuffle(players).slice(0, number);
            },

            sendWinners() {
                axios.post(route('winners.store'), {
                    winners: this.winners,
                    players: this.randomPlayers,
                }).then(response => {
                    alert('Successful');
                }).catch(err => {
                    alert('Error');
                })
            },
        },

        computed: {
            winnersNumber() {
                return this.randomPlayers.length / 2;
            }
        },
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .multiselect__tag {
        background: #3c3f44;
    }

    .multiselect__option--highlight,.multiselect__option--highlight::after {
        background: #4b5563;
    }

    .multiselect__option--selected {
        background: #20cd92;
        color: #ffffff;
    }
</style>

<style scoped>
    .checkbox-container input:checked ~ .checkbox-button {
        background-color: #20cd92;
    }

    .black {
        background: #3c3f44;
        border-color: #3c3f44;
    }

    .black:hover {
        background: #373a3d;
    }

    .btn-color {
        background: #4b5563;
    }
</style>