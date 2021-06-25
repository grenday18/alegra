<template>
    <v-col cols="12">
        <v-col cols="12">
            <h3>Orders</h3>
        </v-col>
        <!--===================== Tabs ========================= -->
        <v-col cols="12">
            <v-tabs>
                <v-tab v-for="(state,key) in states" v-bind:key="key">
                    {{state.name}}
                </v-tab>
            </v-tabs>
        </v-col>
        <!--===================== Table ========================= -->
        <v-col cols="12">
            <tableRsc 
                :headers="tableHeaders"
                :datos="data"
                :last_page="last_page"
                :current_page="current_page"
                :per_page="per_page"
                :states="true"
            >
            </tableRsc>
        </v-col>
    </v-col>
</template>
<script>
    import tableRsc from './tableComponent'
    export default {
        data () {
            return {
                states:[
                    { name:"All", value:''},
                    { name:"cooking", value:'cooking'},
                    { name:"complete", value:'complete'},
                ],
                tableHeaders: [
                    { text: 'order', value: 'name' },
                    { text: 'date', value: 'created_at' },
                ],
                data:[],
                // vars of paginate
                last_page:0,
                current_page:1,
                per_page:0,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getData(){

            }
        },
        components: {tableRsc},

    }
</script>