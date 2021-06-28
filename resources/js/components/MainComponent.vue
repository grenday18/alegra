<template>
    <v-app>
        <v-navigation-drawer app v-model="drawer">
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="text-h6">
                        Restaurant
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        Application
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <!-- ================ MENU LINKS  ======================= -->
            <v-list dense nav rounded>
                <router-link  v-for="(route,itemkey) in routes"
                    :to="{name:route.namePath}"
                    tag="div"
                    class="item-link"
                    v-bind:key="itemkey">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>{{route.icon}}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{route.name}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>

            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="cyan lighten-2" dense dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>Alegra</v-toolbar-title>

            <v-spacer></v-spacer>
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
            </template>
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main>
            <v-container fluid panel>
                <router-view ></router-view>
            </v-container>
        </v-main>

        <v-footer app>
            <!-- -->
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                routes:[
                    {
                        name:'Food Menu',
                        namePath:'menu',
                        icon:'mdi-view-dashboard'
                    },
                    {
                        name:'Orders',
                        namePath:'orders',
                        icon:'mdi-clipboard-text'
                    },
                    {
                        name:'Ingredients',
                        namePath:'ingredients',
                        icon:'mdi-cookie'
                    },
                    {
                        name:'Purchases',
                        namePath:'purchases',
                        icon:'mdi-currency-usd'
                    }
                ],
                drawer: true,
            }
        },
    }
</script>
<style scoped>
    .panel{
        padding: 30px 20px;
    }
    .item-link:hover{
        background: #e8e8e8;
        border-radius: 5px;
    }
    .router-link-exact-active.active{
        background: #4dd0e180;
        border-radius: 5px;
    }
</style>
