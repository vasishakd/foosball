<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Random player
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto px-1 py-5 sm:px-6 lg:px-8">
                <multiselect
                        v-model="activePlayers"
                        :options="players"
                        :multiple="true"
                        track-by="id"
                        label="name"
                        :close-on-select="false"
                        :max-height="1000"
                >
                </multiselect>

                <div class="flex">
                    <button
                            @click="getRandomPlayers"
                            class="black w-1/3 mx-auto text-white font-bold py-2 px-4 rounded my-4"
                            :disabled="!activePlayers.length"
                    >
                        Random
                    </button>
                </div>

                <ul v-if="randomPlayers" class="flex flex-wrap -mx-2">
                    <li v-for="item in randomPlayers" class="w-1/2 my-2 px-2">
                        <span class="text-center block border black rounded py-2 px-4 text-white">
                            {{ item.name }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../Layouts/AppLayout";
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            AppLayout,
            Multiselect
        },

        props: {
            defaultPlayers: Array,
        },

        data() {
            return {
                activePlayers: [],
                randomPlayers: [],
                players: this.defaultPlayers,
            }
        },

        methods: {
            getRandomPlayers() {
                this.randomPlayers = this.activePlayers.sort(() => 0.5 - Math.random()).slice(0, 4);
            },
        },
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .multiselect__tag,.multiselect__option--highlight,.multiselect__option--highlight::after {
        background: #3c3f44;
    }

    .black {
        background: #3c3f44;
        border-color: #3c3f44;
    }
</style>