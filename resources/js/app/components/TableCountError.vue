<template>
    <div>
        <div class="form-group row">
            <div class="offset-md-1 col-sm-2 text-center">
                <p><b>Таблица: CountError</b> {{ page.current }} / {{ page.count }}</p>
                <p>Сверка финансов кол-во ошибок.sql</p>
            </div>
            <div class="col-sm-2 text-center sectionControl">
                <button class="btn btn-control" @click="prevPage">Назад</button>
                <button class="btn btn-control" @click="nextPage">Дальше</button>
            </div>

            <div class="col-sm-6 row sectionControl">
                <div class="col-sm-2 text-right">Поиск</div>
                <div class="col-sm-8"><input class="form-control" type="text" v-model="search" placeholder="Введите участок или ОСН"></div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>C_DIVISION"</th>
                <th>ОСН</th>
                <th>N_YEAR</th>
                <th>N_MONTH</th>
                <th>CNT</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in arr" :key="index" @click="$emit('selectItem', item); currIndex = index;" :class="{'active': index === currIndex}">
                <td>{{ item.C_DIVISION }}</td>
                <td>{{ item['\'ОСН\''] }}</td>
                <td>{{ item.N_YEAR }}</td>
                <td>{{ item.N_MONTH }}</td>
                <td>{{ item.CNT }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "TableCountError",
        data() {
            return {
                currIndex: null,
                search: '',
                page: {
                    current: 1, //тек. страница,
                    count: 0,
                    length: 20 // Элементов на странице
                }
            }
        },
        mounted() {
            this.page.count = Math.ceil(this.$store.getters.getArrayCountError.length / this.page.length);
        },
        computed: {
            arr() {
                if (this.search.length >= 3) {
                    return this.$store.getters.getArrayCountError.filter(item => {
                        if (item.C_DIVISION.toLowerCase().indexOf(this.search) !== -1) {
                            return true;
                        }
                        else if (item['\'ОСН\''].toLowerCase().indexOf(this.search) !== -1) {
                            return true;
                        } else
                            return false;
                    });
                    // return this.$store.getters.getArrayCountError.filter((item) => (item.C_DIVISION.toLowerCase().indexOf(this.search) !== -1));
                } else {
                    return this.$store.getters.getArrayCountError.filter((row, index) => {
                        let start = (this.page.current - 1) * this.page.length;
                        let end = this.page.current * this.page.length;
                        if (index >= start && index < end) return true;
                    });
                }
            }
        },
        methods: {
            prevPage() {
                if (this.page.current > 1) {
                    this.page.current -= 1
                }
            },
            nextPage() {
                if ((this.page.current * this.page.length) < this.$store.getters.getArrayCountError.length) {
                    this.page.current += 1;
                }
            },
        }
    }
</script>
