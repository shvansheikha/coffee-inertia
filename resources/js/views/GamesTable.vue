<template>
    <div>
        <div class="w-full bg-white text-sm text-left cursor-pointer rounded-md shadow-md">
            <div
                class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

                <div class="text-center px-3 py-3 md:w-1/12">
                    #
                </div>

                <div class="px-3 py-3 md:w-2/12">
                    Title
                </div>

                <div class="px-3 py-3 md:w-1/12">
                    Category
                </div>

                <div class="px-3 py-3 md:w-1/12">
                    Amount
                </div>

                <div class="md:w-6/12 items-center flex justify-between">
                    <div class="py-3 md:w-2/5 items-center flex justify-center">
                        Started At
                    </div>

                    <div class="py-3 md:w-1/5 items-center flex justify-center">
                        Stop
                    </div>

                    <div class="py-3 md:w-1/5 items-center flex justify-center">
                        Edit
                    </div>

                    <div class="py-3 md:w-1/5 items-center flex justify-center">
                        Delete
                    </div>
                </div>

            </div>

            <div v-for="(game, index) in gamesList"
                 class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium"
                 :class="(index === gamesList.length -1 )?'md:hover:rounded-b-md':'border-b'">

                <div class="hidden md:block text-center px-3 py-3 md:w-1/12">
                    {{ index + 1 }}
                </div>

                <div class="px-3 py-3 md:w-2/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Title:</span>
                    <span>{{ game.title }}</span>
                </div>

                <div class="px-3 py-3 md:w-1/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Category:</span>
                    <span>{{ game.group }}</span>
                </div>

                <div class="px-3 py-3 md:w-1/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Amount:</span>
                    <span>{{ game.amount }}</span>
                </div>

                <div class="md:w-6/12 flex m-2 md:m-0 rounded-md border md:border-none">

                    <div
                        class="w-2/5 px-3 py-2 rounded-l-md md:rounded-none bg-blue-500 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-gray-800 md:hover:text-blue-500 uppercase">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Started AT:</span>
                        <span v-if="(game.started_at_mapped !== null)">
                            {{ game.started_at_mapped }}
                        <span class="text-blue-500">({{ game.timer }})</span>
                        </span>
                        <span v-else>-</span>
                    </div>

                    <div
                        v-if="!game.open"
                        @click="startGame(game)"
                        class="w-1/5 px-3 py-2 rounded-l-md md:rounded-none bg-blue-500 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-gray-800 md:hover:text-blue-500 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                        </svg>
                    </div>

                    <div
                        v-else
                        @click="stopModal(game)"
                        class="w-1/5 px-3 py-2 rounded-l-md md:rounded-none bg-blue-500 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-gray-800 md:hover:text-blue-500 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                        </svg>
                    </div>

                    <div
                        @click="updateForm(game)"
                        class="w-1/5 px-3 py-2 rounded-l-md md:rounded-none bg-blue-500 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-gray-800 md:hover:text-blue-500 uppercase">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>

                    <div
                        @click="confirmDelete(game)"
                        class="w-1/3 px-3 py-2 rounded-r-md md:rounded-none bg-gray-800 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-red-500 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <Modal :showing="modalShowing" @close="modalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Delete Game</h2>
            <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.title }}</span>?
            </span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                    @click="deleteGame(deleteItem.id)">
                    Yes
                </button>

                <button
                    class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="modalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

        <Modal :showing="updateModalShowing" @close="updateModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Update Game</h2>

            <div class="mt-8 rounded-md md:flex items-center pb-4">
                <input type="text"
                       v-model="form.title"
                       class="mr-4 mt-4 md:mt-0 form-control block w-full md:w-2/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Title">

                <select
                    v-model="form.group_id"
                    class="form-select appearance-none mr-4 mt-4 md:mt-0 form-control block w-full md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option v-for="group in groupsList"
                            v-bind:value="group.id"
                            :selected="group.id === updateItem.group_id">
                        {{ group.title }}
                    </option>
                </select>

                <input type="text"
                       name="amount"
                       v-model="form.amount"
                       class="mr-4 mt-4 md:mt-0 form-control block w-full md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Amount">
            </div>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                    @click="updateGame(updateItem.id)">
                    Update
                </button>

                <button
                    class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="updateModalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

        <Modal :showing="stopModalShowing" @close="stopModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Stop Game</h2>

            <div class="mt-8 rounded-md md:flex items-center pb-4">
                <DropDown @selected="selectCard" :options="cardsList"/>
            </div>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                    @click="stopGame(stopItem)">
                    Stop
                </button>

                <button
                    class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="stopModalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

    </div>

</template>

<script>
import Modal from "../utility/Modal.vue";
import DropDown from "../utility/DropDown.vue";

export default {
    name: 'GamesTable',
    components: {DropDown, Modal},
    props: {
        gamesList: {},
        groupsList: {},
        cardsList: {}
    },
    data() {
        return {
            deleteItem: null,
            stopItem: null,
            modalShowing: false,
            updateItem: null,
            updateModalShowing: false,
            stopModalShowing: false,
            selectedCard: null,
            form: {
                id: null,
                title: null,
                amount: null,
                group_id: null
            }
        }
    },
    mounted() {
        setInterval(() => {
            this.startTimer()
        }, 1000);
    },
    methods: {
        startTimer: function () {
            if (this.gamesList != null) {

                this.gamesList.forEach(function (game) {
                    if (game.started_at != null) {
                        const timeNow = new Date().getTime();
                        const created_at = new Date(game.started_at);
                        const timeDifference = timeNow - created_at;
                        const millisecondsInOneSecond = 1000;
                        const millisecondsInOneMinute = millisecondsInOneSecond * 60;
                        const millisecondsInOneHour = millisecondsInOneMinute * 60;
                        const millisecondsInOneDay = millisecondsInOneHour * 24;
                        const differenceInDays = timeDifference / millisecondsInOneDay;
                        const remainderDifferenceInHours = (timeDifference % millisecondsInOneDay) / millisecondsInOneHour;
                        const remainderDifferenceInMinutes = (timeDifference % millisecondsInOneHour) / millisecondsInOneMinute;
                        const remainderDifferenceInSeconds = (timeDifference % millisecondsInOneMinute) / millisecondsInOneSecond;
                        const remainingDays = Math.floor(differenceInDays);
                        const remainingHours = Math.floor(remainderDifferenceInHours);
                        const remainingMinutes = Math.floor(remainderDifferenceInMinutes);
                        const remainingSeconds = Math.floor(remainderDifferenceInSeconds);
                        game.timer = "";
                        if (remainingDays > 0) {
                            game.timer += remainingDays + ":";
                        }

                        if (remainingHours > 0) {
                            game.timer += remainingHours + ":"
                        }

                        game.timer += remainingMinutes + ":" + remainingSeconds
                    }
                });
            }
        },

        confirmDelete(item) {
            this.deleteItem = item;
            this.modalShowing = true;
        },

        deleteGame(id) {
            this.$inertia.delete('games/' + id, {
                preserveState: false,
                onSuccess: () => {
                    this.deleteItem = null;
                    this.modalShowing = false;
                }
            })
        },

        updateForm(item) {
            this.updateItem = item;
            this.form.id = item.id;
            this.form.title = item.title;
            this.form.amount = item.amount;
            this.form.group_id = item.group_id;
            this.updateModalShowing = true;
        },

        updateGame(id) {
            this.$inertia.put('games/' + id, this.form, {
                preserveState: false,
                onSuccess: () => {
                    this.form.id = null;
                    this.form.title = null;
                    this.form.amount = null;
                    this.form.group_id = null;
                    this.updateItem = null;
                    this.updateModalShowing = false;
                }
            })
        },

        startGame(game) {
            this.$inertia.put('/start-game/' + game.id);
        },

        stopModal(game) {
            this.stopItem = game;
            this.stopModalShowing = true;
        },

        stopGame(game) {
            this.$inertia.put('/stop-game/' + game.id + '/' + this.selectedCard, null, {
                preserveState: false,
                onSuccess: () => {
                    this.stopModalShowing = false;
                }
            });
        },

        selectCard(object) {
            this.selectedCard = object;
        }
    }
}
</script>
