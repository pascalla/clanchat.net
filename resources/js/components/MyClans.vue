<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                My Clans
            </h2>
        </header>

        <div class="flex items-center justify-center  rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" v-if="isLoading">
            <div role="status">
                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="mt-6" v-if="!isLoading">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Clan name
                        </th>
                        <th scope="col" class="px-6 py-3 green">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">View</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Delete</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="clan in clans" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ clan.name }}
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex items-center" v-if="clan.status == 'ACTIVE'">
                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Active
                                </div>
                                <div class="flex items-center" v-if="clan.status == 'INACTIVE'">
                                    <div class="h-2.5 w-2.5 rounded-full bg-orange-300 mr-2"></div> Inactive
                                </div>
                                <div class="flex items-center" v-if="clan.status == 'OFFLINE'">
                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> Offline
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a :href="this.clanUrl + clan.id" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                            </td>
                            <td>
                                <button type="button" data-modal-toggle="deleteClanModal" v-on:click="pendingDelete = clan" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="deleteClanModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteClanModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this clan?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-toggle="deleteClanModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <button v-on:click="removeClan()" data-modal-toggle="deleteClanModal" type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
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
    data() {
        return {
            isLoading: true,
            clans: [],
            clanUrl: '/clan/',
            pendingDelete: null,
        }
    },
    setup() {
        const toast = useToast();
        return { toast }
    },
    mounted() {
        this.emitter.on("added-clan", added => {
            this.getClans();
        });
    },
    created() {
        this.getClans();
    },
    methods: {
        getClans: function() {
            axios.get('/api/clan')
                .then((response) => {
                    this.clans = response.data.data;
                })
                .catch((error) => {
                    this.toast.error("There was an error fetching your clans.")
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },
        removeClan() {
            axios.delete('/api/clan/' + this.pendingDelete.id)
                .then((response) => {
                    this.toast.success(response.data.data);
                })
                .catch((error) => {
                    this.toast.error(error.response.data);
                })
                .finally(() => {
                    this.pendingDelete = null;
                    this.getClans();
                })
        },
    }
}
</script>

