<template>
    <v-row>
        <v-col cols="12">
            <h3>Food menu</h3>
        </v-col>
        <v-row cols="8">
            <v-col v-for="n in 6" :key="n" class="d-flex child-flex" cols="4">
                <v-img
                    :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                    :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                    aspect-ratio="1"
                    class="grey lighten-2"
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
            </v-col>
        </v-row>
        <v-col cols="4" align="center">
            <v-img
                :src="`/img/chef.jpg`"
                aspect-ratio="1"
                class="grey lighten-2"
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
                    selecting random food ...
                </v-card-title>

                <v-card-text>
                    
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
                dialogRoulette : false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            ramdomSelect(){
                this.dialogRoulette = true
            }
        },
    }
</script>
