<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Clan Secret Keys
            </h2>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">The different secret keys that point to this clan</h3>
        </header>

        <form @submit.prevent="add()">
            <div class="mt-6 mb-6">
                <label for="discord_webhook" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
                <input v-model="secretForm.nickname" type="text" id="discord_webhook" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deputy" required>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
        </form>

        <div class="mt-6" v-if="!isLoading">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nickname
                        </th>
                        <th scope="col" class="px-6 py-3 green">
                            Secret Key
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Options</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="key in keys" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ key.nickname }}
                            </th>
                            <td class="px-6 py-4">
                                {{ key.key }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>
import {useToast} from "vue-toastification";

export default {
    name: "ClanWebhooks",
    props: ['clanid', 'ikeys'],
    data() {
        return {
            isLoading: false,
            keys: this.ikeys,
            secretForm: {
                nickname: ''
            }
        }
    },
    setup() {
        const toast = useToast();
        return { toast }
    },
    methods: {
        add() {
            axios.post('/api/clan-secret', {
                nickname: this.secretForm.nickname,
                clan_id: this.clanid
            })
            .then((response) => {
                this.toast.success(response.data.data);
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
