<template>
    <div class="columns">
        <div class="column" v-if="isLoading">Loading scoresheet...</div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Goals</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="player in players">
                    <tr v-bind:key="player.id">
                        <td>{{ player.id }}</td>
                        <td>{{ player.name }}</td>
                        <td>{{ player.goals }}</td>
                        <td>
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(player.id) }" @click="goal(player.id, true)">(+1) Goal</button>&nbsp;
                        <button class="button is-danger" v-bind:class="{ 'is-loading' : isDeleting(player.id) }" @click="deletePlayer(player.id)">Delete Player</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="column">
        <player-form @completed="addPlayer"></player-form>
        </div>
    </div>
        
    
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'
import PlayerForm from './PlayerForm.vue'
import Vue from 'vue'

export default {
    components: {
        PlayerForm
    },
    data() {
        return {
            isLoading: true,
            question: null,
            players: {}
        }
    },
    async created () {
        try {
            const response = await axios.get(API_BASE_URL + '/players')
            this.players = response.data.data
            this.isLoading = false
        } catch (e) {
            // handle the authentication error here
        }
    },
    methods: {
    
        addPlayer(player) {
            this.players.push(player)
        },
        isDeleting(id) {
            let index = this.players.findIndex(player => player.id === id)
            return this.players[index].isDeleting
        },
        async deletePlayer(id) {
            let index = this.players.findIndex(player => player.id === id)
            Vue.set(this.players[index], 'isDeleting', true)
            const response = await axios.delete(API_BASE_URL + '/players/' + id)
            this.players.splice(index, 1)
        },
        isCountUpdating(id) {
            let index = this.players.findIndex(player => player.id === id)
            return this.players[index].isCountUpdating
        },
        async goal(id) {
            let index = this.players.findIndex(player => player.id === id)
            Vue.set(this.players[index], 'isCountUpdating', true)
            const response = await axios.post(API_BASE_URL + '/players/' + id)
            this.players[index].goals = response.data.data.goals
            this.players[index].isCountUpdating = false
        }
    }
}
</script>
