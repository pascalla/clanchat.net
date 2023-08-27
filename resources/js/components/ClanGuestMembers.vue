<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Clan Guests
                <span class="bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Experimental</span>
            </h2>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Show broadcasts from these approved guest members. They should be using the "Guest Secret Keys"</h3>
        </header>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <form @submit.prevent="add()">
                    <div class="mt-6 mb-6">
                        <label for="discord_webhook" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input v-model="secretForm.nickname" type="text" id="discord_webhook" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Costcutters" required>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                </form>
            </div>

            <div>
                <div class="mt-6" v-if="!isLoading">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Options</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="key in keys" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ key.name }}
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" data-modal-toggle="deleteGuestMemberModal" v-on:click="pendingDelete = key" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="deleteGuestMemberModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this key?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-toggle="deleteGuestMemberModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <button v-on:click="remove()" data-modal-toggle="deleteGuestMemberModal" type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {useToast} from "vue-toastification";

export default {
    props: ['clanid', 'ikeys'],
    data() {
        return {
            isLoading: false,
            keys: this.ikeys,
            secretForm: {
                nickname: ''
            },
            pendingDelete: null,
        }
    },
    setup() {
        const toast = useToast();
        return { toast }
    },
    methods: {
        add() {
            axios.post('/api/clan-guest', {
                name: this.secretForm.nickname,
                clan_id: this.clanid,
            })
                .then((response) => {
                    this.toast.success(response.data.data);
                    this.secretForm.nickname = '';
                    this.getGuests();
                })
                .catch((error) => {
                    this.toast.error(error.response.data);
                })
        },
        remove() {
            axios.delete('/api/clan-guest/' + this.pendingDelete.id)
                .then((response) => {
                    this.toast.success(response.data.data);
                })
                .catch((error) => {
                    this.toast.error(error.response.data);
                })
                .finally(() => {
                    this.pendingDelete = null;
                    this.getGuests();
                })
        },
        getGuests() {
            axios.get('/api/clan-guest/' + this.clanid)
                .then((response) => {
                    this.keys = response.data.data;
                })
                .catch((error) => {
                    this.toast.error(error.response.data);
                })
        }
    }
}
</script>

<style scoped>

</style>

coul
