<template>
    <v-col cols="12">
        <v-col cols="12">
            <h3>Orders</h3>
        </v-col>
        <!--===================== Tabs ========================= -->
        <v-col cols="12">
            <v-tabs v-model="filter">
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
                v-on:getData="getData($event)"
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
                    { text: 'Food', value: 'food' },
                    { text: 'Code', value: 'code' },
                    { text: 'Hours', value: 'hours' },
                    { text: 'Date', value: 'date' },
                    { text: 'State', value: 'state' },
                ],
                filter:0,
                data:[],
                // vars of paginate
                last_page:1,
                current_page:1,
                per_page:0,
            }
        },
        watch: {
            filter(val){
                this.current_page = 1
                this.getData(this.current_page)
            }
        },
        mounted() {
            this.getData(this.current_page);
        },
        methods:{
            getData(page){
                let filter = this.states[this.filter].value
                axios.get("/api/orders?filter="+filter+"&page="+page,{
                }).then(response => {
                    if(response.status === 200) {
                        this.data       = this.convertData(response.data.data)
                        this.last_page  =   response.data.last_page
                        this.current_page = response.data.current_page
                        this.per_page   =   response.data.per_page
                    }else{
                        console.log("ah ocurrido un error")
                    }
                }).catch(e => {
                    console.log(e)
                });
            },
            convertData(data){
                let dataReturn = [];
                data.forEach(function(val) {
                    let date = new Date(val.created_at)
                    let model = {
                        food  : val.foods.name,
                        code  : val.id,
                        date  : date.toLocaleDateString(),
                        hours : date.getHours()+":"+date.getMinutes(),
                        state : val.state
                    }
                    dataReturn.push(model)
                });
                return dataReturn;
            }
        },
        components: {tableRsc},

    }
</script>
