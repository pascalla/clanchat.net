<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Clan Settings
            </h2>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Settings for what to send to Discord</h3>

            <form @submit.prevent="update()">
                <div class="mt-6 mb-6">
                    <label for="discord_webhook" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discord Webhook</label>
                    <input v-model="settings.discord_webhook" type="text" id="discord_webhook" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://discordapp.com/..." required>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="clan_chat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clan Chat</label>
                        <select v-model="settings.clan_chat" id="clan_chat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="collection_log" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Collection Log</label>
                        <select v-model="settings.collection_log" id="collection_log" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="drops" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Drops</label>
                        <select v-model="settings.drops" id="drops" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="level_up" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level Up</label>
                        <select v-model="settings.level_up" id="drops" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="quests" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quest Completions</label>
                        <select v-model="settings.quests" id="quests" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="pets" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pets</label>
                        <select v-model="settings.pets" id="pets" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="pbs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personal Bests</label>
                        <select v-model="settings.pbs" id="pbs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="pvp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PVP</label>
                        <select id="pvp" v-model="settings.pvp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="combat_achievements" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Combat Achievements</label>
                        <select id="combat_achievements" v-model="settings.combat_achievements" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="clue_drop" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clue Drops</label>
                        <select id="clue_drop" v-model="settings.clue_drop" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="achievement_diary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Achievement Diary</label>
                        <select id="achievement_diary" v-model="settings.diary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="attendance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Join/Leave</label>
                        <select id="attendance" v-model="settings.attendance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="icons" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Show Player Icons</label>
                        <select id="icons" v-model="settings.icons" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label for="clan_icons" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Show Clan Rank Icons
                            <span class="bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">New</span>
                        </label>
                        <select id="clan_icons" v-model="settings.clan_icons" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="true">Enabled</option>
                            <option value="false">Disabled</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="broadcast_icons" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Show Broadcast Icons
                        <span class="bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">New</span>
                    </label>
                    <select id="broadcast_icons" v-model="settings.broadcast_icons" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="true">Enabled</option>
                        <option value="false">Disabled</option>
                    </select>
                </div>


                <button type="submit" class="text-white bg-blue-700 mt-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </form>
        </header>
    </section>
</template>

<script>
import {useToast} from "vue-toastification";

export default {
    props: ['clanid', 'isettings', 'istatus'],
    data() {
        return {
            isLoading: true,
            settings: {
                discord_webhook: '',
                clan_chat: "true",
                collection_log: "true",
                drops: "true",
                level_up: "true",
                quests: "true",
                pets: "true",
                pbs: "true",
                pvp: "true",
                attendance: "true",
                combat_achievements: "true",
                clue_drop: "true",
                diary: "true",
                icons: "true",
                clan_icons: "true",
                broadcast_icons: "true"
            }
        }
    },
    setup() {
        const toast = useToast();
        return { toast }
    },
    created() {
        this.isettings.forEach((setting) => {
            this.settings[setting.key] = setting.value;
        });
    },
    methods: {
        update: function() {
            axios.post('/api/clan-settings', {
                ...this.settings,
                clan_id: this.clanid
            })
            .then((response) => {
                this.toast.success(response.data.data, {
                    timeout: 2000
                });
            })
            .catch((error) => {
                this.toast.error(error.response.data)
            });
        }
    }
}
</script>

<style scoped>

</style>
