<template>
    <div>
        <div class="item-container" v-if="selectItem.C_DIVISION">
            <div style="float: right">
                <button class="btn btn-danger" @click="$emit('close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <p>{{ selectItem.C_DIVISION }}, лицевой счет: {{ selectItem['Лицевой счет'] }}, дата: {{ mountName(selectItem.N_MONTH) }} {{ selectItem.N_YEAR }}г.</p>
                <p>{{ n0o0 }}, {{ n1o1 }}, {{ n2o2 }}, {{ n3o3 }}, {{ n4o4 }}, {{ n5o5 }}, {{ n6o6 }}, {{ n9o9 }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ViewItem",
        props: {
            selectItem: {
                type: Object,
                default: { }
            }
        },
        computed: {
            n0o0() {
                return `n0 - o0 = ${this.selectItem['N0'] - this.selectItem['O0']}`;
            },
            n1o1() {
                return `n1 - o1 = ${this.selectItem['N1'] - this.selectItem['O1']}`;
            },
            n2o2() {
                return `n2 - o2 = ${this.selectItem['N2'] - this.selectItem['O2']}`;
            },
            n3o3(){
                return `n3 - o3 = ${this.selectItem['N3'] - this.selectItem['O3']}`;
            },
            n4o4(){
                return `n4 - o4 = ${this.selectItem['N4'] - this.selectItem['O4']}`;
            },
            n5o5(){
                return `n5 - o5 = ${this.selectItem['N5'] - this.selectItem['O5']}`;
            },
            n6o6(){
                return `n6 - o6 = ${this.selectItem['N6'] - this.selectItem['O6']}`;
            },
            n9o9(){
                return `n9 - o9 = ${this.selectItem['N9'] - this.selectItem['O9']}`;
            },
        },
        methods: {
            mountName(mountNumber) {
                const mounts = [
                    'Январь',
                    'Февраль',
                    'Март',
                    'Апрель',
                    'Май',
                    'Июнь',
                    'Июль',
                    'Август',
                    'Сентябрь',
                    "Октябрь",
                    'Ноябрь',
                    'Декабрь'
                ];

                return mounts[mountNumber -1];
            }
        }
    }
</script>

<style lang="scss" scoped>
.item-container{
    /*display: flex;*/
    top: 0;
    left: 0;
    background-color: #f5f3f3e3;
    color: #4d4f50;
    width: 100%;
    position: fixed;
    min-height: 30px;
    padding: 10px;
    box-shadow: 1px 1px 5px #929292;
    transition: 0.5s;
    &:hover {
        background-color: #f5f3f3;
    }
}
</style>
