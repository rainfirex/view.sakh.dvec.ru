<template>
    <div>
        <div class="form-group row">
            <div class="offset-md-1 col-sm-2 text-center">
                <p><b>Таблица: Shtraf</b> {{ page.current }} / {{ page.count }}</p>
                <p>!Сверка Штраф.sql</p>
            </div>
            <div class="col-sm-2 text-center sectionControl">
                <button class="btn btn-control" @click="prevPage">Назад</button>
                <button class="btn btn-control" @click="nextPage">Дальше</button>
            </div>

            <div class="col-sm-6 row sectionControl">
                <div class="col-sm-2 text-right">Поиск</div>
                <div class="col-sm-8"><input class="form-control" type="text" v-model="search" placeholder="Введите лицевой счет"></div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>C_DIVISION"</th>
                <th>Лицевой счет</th>
                <th>N_YEAR</th>
                <th>N_MONTH</th>
                <th>N0</th>
                <th>N1</th>
                <th>N2</th>
                <th>N3</th>
                <th>N4</th>
                <th>N5</th>
                <th>N6</th>
                <th>N7</th>
                <th>N8</th>
                <th>N9</th>
                <th>O0</th>
                <th>O1</th>
                <th>O2</th>
                <th>O3</th>
                <th>O4</th>
                <th>O5</th>
                <th>O6</th>
                <th>O9</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in arr" :key="index" @click="$emit('selectItem', item); currIndex = index;" :class="{'active': index === currIndex}">
                <td>{{ item.C_DIVISION }}</td>
                <td>{{ item['Лицевой счет'] }}</td>
                <td>{{ item.N_YEAR }}</td>
                <td>{{ item.N_MONTH }}</td>
                <td>{{ item.N0 }}</td>
                <td>{{ item.N1 }}</td>
                <td>{{ item.N3 }}</td>
                <td>{{ item.N4 }}</td>
                <td>{{ item.N5 }}</td>
                <td>{{ item.N6 }}</td>
                <td>{{ item.N6 }}</td>
                <td>{{ item.N7 }}</td>
                <td>{{ item.N8 }}</td>
                <td>{{ item.N9 }}</td>
                <td>{{ item.O0 }}</td>
                <td>{{ item.O1 }}</td>
                <td>{{ item.O2 }}</td>
                <td>{{ item.O3 }}</td>
                <td>{{ item.O4 }}</td>
                <td>{{ item.O5 }}</td>
                <td>{{ item.O6 }}</td>
                <td>{{ item.O9 }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "TableShtraf",
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
            this.page.count = Math.ceil(this.$store.getters.getArrayShtraf.length / this.page.length);
        },
        computed: {
            arr() {
                if (this.search.length >= 9) {
                    return this.$store.getters.getArrayShtraf.filter((item) => (item['Лицевой счет'].indexOf(this.search) !== -1));
                } else {
                    return this.$store.getters.getArrayShtraf.filter((row, index) => {
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
                if ((this.page.current * this.page.length) < this.$store.getters.getArrayShtraf.length) {
                    this.page.current += 1;
                }
            },
        }
    }
</script>
<!--mb-sm-1 mb-lg-0-->
