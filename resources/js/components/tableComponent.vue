<template>
    <div class="table-rsc">
        <table>
            <thead>
                <tr>
                    <th v-if="marker" width="30px"></th>
                    <th v-else width="30px">#</th>
                    <th v-for="(header,i) in headers" :key="i">
                        {{header.text}}
                    </th>
                    <th v-if="states">Estado</th>
                    <th v-if="actions">Acciones</th>  
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,i) in datos" :key="i">
                    <td v-if="marker">
                        <slot name="marker" v-bind:item="item" /> 
                    </td>
                    <td v-else>{{count+i+1}}</td>
                    <td v-for="(header,i) in headers" :key="i">
                        {{item[header.value]}}
                    </td>
                    <td v-if="states" class="center">
                        <slot name="state" v-bind:item="item" />
                    </td>
                    <td v-if="actions" class="actions center">
                        <slot name="action" v-bind:item="item" />
                    </td>
                </tr>
            </tbody>
        </table>
    
        <div v-if="!datos" class="table-no-data">
            No data found
        </div>
        <div class="dataTables_paginate paging_simple_numbers float-right">
            <ul class="pagination">
                <li v-if="calcPrevius()">
                    <span class="page-link" @click="$emit('getData',current_page-1)">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </li>
                <li v-for="(button,i) in buttons" :key="i" :class="button.class">
                    <span class="page-link" @click="$emit('getData',button.value)">{{button.value}}</span>
                </li>
                <li v-if="calcNext()">
                    <span class="page-link" @click="$emit('getData',current_page+1)">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: ['headers','datos','actions','marker','states','last_page','current_page','per_page'],
    data () {
      return {
            pag_actual :0,
            pag_previus :0,
            pag_next:0,
            buttons:[]
      }
    },
    computed:{
        count () {
            return this.per_page*(this.current_page-1)
        },
    },
    watch:{
        datos: function(){
            this.generateButtons()
        }
    },
    mounted(){
        this.generateButtons()
    },
    methods:{
        // function to generate pagination buttons 
        generateButtons(){
            // initial var
            let last = this.last_page
            let actual = this.current_page
            let buttons = []
            if(last > 1){
                buttons[0] = {value: 1 , class:'paginate_button page-item'}
                if(last > 7){
                    if(actual <= 4){
                        buttons[1] = {value:2 , class:'paginate_button page-item'}
                        buttons[2] = {value:3 , class:'paginate_button page-item'}
                        buttons[3] = {value:4 , class:'paginate_button page-item'}
                    }else{
                        buttons[1] = {value: '...' , class:'paginate_button page-item'}
                        buttons[2] = {value: actual-1 , class:'paginate_button page-item'}
                        buttons[3] = {value: actual , class:'paginate_button page-item'}
                    }
                    buttons[4] = {value: actual +1, class:'paginate_button page-item'}
                    buttons[5] = {value: '...' , class:'paginate_button page-item'}
                    buttons[6] = {value: last , class:'paginate_button page-item'}
                }
                else{
                    for (let i = 1; i <= last; i++) {
                        buttons[i-1] = {value: i , class:'paginate_button page-item'}
                    }
                }
                for (let i = 0; i < buttons.length; i++) {
                    if(buttons[i].value == actual){
                        buttons[i] = {value: actual , class:'paginate_button page-item active'}
                    }
                }
                this.pag_actual = actual
                this.pag_previus = actual-1
                this.pag_next = actual + 1
                this.buttons = buttons
            }
            this.buttons = buttons
        },
        // function to assign the active class
        activeClase(value){
            if(value == this.current_page){
                return "paginate_button page-item active"
            }
            else{
                return "paginate_button page-item"
            }
        },
        // function to calculate previous page active
        calcPrevius(){
            if(this.current_page == 1){
                return false
            }
            return true
        },
        // function to calculate next page active
        calcNext(){
            if(this.current_page == this.last_page){
                return false
            }
            return true
        }
    }
}
</script>
<style scoped>
    table{
        width: 100%;
    }
    thead{
        width: 100% ;
        margin: 0;
        padding: 0;
        background: rgb(244, 247, 248);
    }
    td{
        max-width: 350px;
        padding: 10px 12px;
    }
    th{
        padding: 10px 12px;
    }
    th:first-child {
        border-radius: 14px 0px 0px 0px;
    }
    th:last-child {
        border-radius: 0px 14px 0px 0px;
    }
    tr:nth-child(even) {
        background-color: #f9fcfd;
    }
    .table-no-data{
        height: 40px;
        text-align: center;
        background-color: rgba(0, 0, 0, 0.05);
        padding: 10px;
        border-radius: 7px;
    }
    .paging_simple_numbers{
        margin-top: 20px;
    }
    .vs-table__th__content{
        text-align: center;
    }
    .actions {
        display: flex;
    }
    .center{
        text-align: center;
    }
        .chip{
        color: #fff;
        border-radius: 16px;
        font-size: 12px;
        padding: 5px 10px;
    }
    .chip.primary{
        background: #1867c0 !important;
    }
    .chip.red{
        background: #f44336 !important;
    }
    .chip.green{
        background: #4caf50!important;
    }
</style>