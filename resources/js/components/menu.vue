<template>
    <v-row>
        <v-col cols="12">
            <h3>Food menu</h3>
        </v-col>
        <v-col cols="8">
            <v-row class="foods">
                <v-col v-for="(food,key) in foods" :key="key" class="" cols="4">
                    <v-img
                        :src="food.img"
                        aspect-ratio="1"
                        @click="showRecipe(key)"
                    >
                        <template v-slot:placeholder>
                            <v-row
                                class="fill-height ma-0"
                                align="center"
                                justify="center"
                            >
                                <v-progress-circular
                                indeterminate
                                color="grey lighten-5"
                                ></v-progress-circular>
                            </v-row>
                        </template>
                    </v-img>
                    <div>
                        <h5>{{food.name}}</h5>
                    </div>
                </v-col>
            </v-row>
        </v-col>
        <v-col cols="4" align="center">
            <v-img
                :src="`/img/chef.jpg`"
                aspect-ratio="1"
            >
                <template v-slot:placeholder>
                    <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                    >
                        <v-progress-circular
                        indeterminate
                        color="grey lighten-5"
                        ></v-progress-circular>
                    </v-row>
                </template>
            </v-img>
            <div>
                <v-btn x-large color="success" dark @click="ramdomSelect()">
                    Make an order
                </v-btn>
            </div>
        </v-col>
        <v-dialog v-model="dialogRoulette" width="500">
            <v-card>
                <v-card-title class="text-h5 ">
                    Your order is ... Nº {{foodCode}}
                </v-card-title>

                <v-card-text>
                    <v-img
                        :src="foodImg"
                        aspect-ratio="1"
                    >
                    </v-img>
                    <h5 class="text-center">{{food}}</h5>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="dialogRoulette = false">
                    I accept
                </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialogIngredients" width="500">
            <v-card>
                <v-card-title class="text-h5 ">
                    Ingredients for "{{selected.food}}"
                </v-card-title>

                <v-card-text>
                    <v-row>
                        <v-col cols="6">
                            <ul>
                                <li v-for="ingredient in selected.ingredients">
                                    ({{ingredient.quantity}} und.) {{ingredient.name}}
                                </li>
                            </ul>
                        </v-col>
                        <v-col cols="6">
                            <v-img
                                :src="selected.img"
                                aspect-ratio="1"
                            >
                            </v-img>
                        </v-col>
                    </v-row>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="dialogRoulette = false">
                    I accept
                </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    export default {
        data () {
            return {
                selected:{
                    food : '',
                    img:'',
                },
                foods:[],
                food: '',
                foodImg:'',
                foodCode : '',
                dialogRoulette : false,
                dialogIngredients: false,
            }
        },
        mounted() {
            this.getFoods()
        },
        methods:{
            getFoods(){
                axios.post("/api/foods",{
                }).then(response => {
                    if(response.status === 200) {
                        this.foods = response.data
                    }else{
                        console.log("ah ocurrido un error")
                    }
                }).catch(e => {
                    console.log(e)
                });
            },
            ramdomSelect(){
                axios.post("/api/orders",{
                }).then(response => {
                    if(response.status === 200) {
                        this.food     = response.data.food
                        this.foodImg  = response.data.img
                        this.foodCode = response.data.code
                        this.dialogRoulette = true
                    }else{
                        console.log("ah ocurrido un error")
                    }
                }).catch(e => {
                    console.log(e)
                });
            },
            showRecipe(index){
                let food = this.foods[index]
                axios.get("/api/foods/"+food.id,{
                }).then(response => {
                    if(response.status === 200) {
                        this.dialogIngredients = true
                        this.selected = {
                            food : food.name,
                            img : food.img,
                            ingredients: response.data.ingredients
                        }
                    }else{
                        console.log("ah ocurrido un error")
                    }
                }).catch(e => {
                    console.log(e)
                });
            }
        },
    }
</script>
<style>
    .foods .v-image .v-responsive__content:hover{
        background: #6cb2eb57;
    }
</style>
