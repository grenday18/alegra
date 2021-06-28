<template>
    <v-col cols="12">
        <v-col cols="12">
            <h3>Ingredients</h3>
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
                tableHeaders: [
                    { text: 'Ingredient', value: 'name' },
                    { text: 'Stock', value: 'stock' },
                ],
                data:[],
                // vars of paginate
                last_page:1,
                current_page:1,
                per_page:0,
            }
        },
        mounted() {
            this.getData();
        },
        methods:{
            getData(){
                axios.get("/api/ingredients",{
                }).then(response => {
                    if(response.status === 200) {
                        this.data = response.data.data
                    }else{
                        console.log("ah ocurrido un error")
                    }
                }).catch(e => {
                    console.log(e)
                });
            },
        },
        components: {tableRsc},

    }
</script>
