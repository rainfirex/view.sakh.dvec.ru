<template>
    <div>
        <div class="content">
            <div class="form">
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label>Подключение к базе:</label>
                        <select class="form-control" v-model="base" :disabled="isLoading">
                            <option :value="b.id" v-for="(b, index) in bases" :key="b.id">{{ b.title }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Список отделений:</label>
                        <select class="form-control" v-model="division" :disabled="isLoading">
                            <option :value="d" v-for="(d, index) in divisions" :key="index">{{ d }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Дата:</label>
                        <input type="datetime-local" class="form-control" v-model="date" :disabled="isLoading">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" :disabled="isLoading">Запрос</button>
                    </div>
                </form>
            </div>

            <div class="error mb-2" v-if="errorMSG">{{ errorMSG }}</div>

            <ul class="table-links"
                v-if="arrayGP.length > 0 || arrayOSB.length > 0 || arrayPeny.length > 0 || arrayShtraf.length > 0 || arrayCountError.length > 0">
                <li v-if="arrayGP.length > 0">
                    <a href="#gp">Сверка ГП.SQL ({{ arrayGP.length }})</a>
                </li>
                <li v-if="arrayOSB.length > 0">
                    <a href="#osb">?? ({{ arrayOSB.length }})</a>
                </li>
                <li v-if="arrayPeny.length > 0">
                    <a href="#pany">Сверка Пени.sql ({{ arrayPeny.length }})</a>
                </li>
                <li v-if="arrayShtraf.length > 0">
                    <a href="#shtraf">Сверка Штраф.sql ({{ arrayShtraf.length }})</a>
                </li>
                <li v-if="arrayCountError.length > 0">
                    <a href="#count_error">Сверка финансов кол-во ошибок.sql ( {{ arrayCountError.length }})</a>
                </li>
            </ul>
        </div>

        <div class="content-table pt-4" v-if="arrayGP.length > 0" id="gp">
            <TableGP @selectItem="selectItem = $event" />
        </div>

        <div class="content-table pt-4" v-if="arrayOSB.length > 0" id="osb">
            <TableOSB @selectItem="selectItem = $event" />
        </div>

        <div class="content-table pt-4" v-if="arrayPeny.length > 0" id="pany">
            <TablePany @selectItem="selectItem = $event" />
        </div>

        <div class="content-table pt-4" v-if="arrayShtraf.length > 0" id="shtraf">
            <TableShtraf @selectItem="selectItem = $event"  />
        </div>

        <div class="content-table pt-4" v-if="arrayCountError.length > 0" id="count_error">
            <TableCountError  />
<!--            @selectItem="selectItem = $event"-->
        </div>

        <ButtonTop />

        <Loading v-if="isLoading" />

        <ViewItem :selectItem="selectItem" @close="selectItem = {}"/>

    </div>

</template>

<script>
    import TableGP from "../components/TableGP";
    import TableOSB from "../components/TableOSB";
    import TablePany from "../components/TablePany";
    import TableShtraf from "../components/TableShtraf";
    import TableCountError from "../components/TableCountError";
    import Loading from "../components/Loading";
    import ButtonTop from "../components/ButtonTop";
    import ViewItem from "../components/ViewItem";
    export default {
        name: "Main",
        components: { TableGP, TableOSB, TablePany, TableShtraf, TableCountError, Loading, ButtonTop, ViewItem },
        data() {
            return {
                isLoading: false,

                bases: [],
                base: '1',
                date: '',
                division: 'Анивский участок',
                divisions: [
                    'Южно-Сахалинский участок',
                    'Анивский участок',
                    'Долинский участок',
                    'Корсаковский участок',
                    'Тымовский участок',
                    'Углегорский участок',
                    'Поронайский участок',
                    'Александровск-Сахалинский участок'
                ],

                errorMSG: '',
                selectItem: {}
            }
        },
        computed: {
            arrayCountError() {
                return this.$store.getters.getArrayCountError;
            },
            arrayShtraf() {
                return this.$store.getters.getArrayShtraf;
            },
            arrayPeny() {
                return this.$store.getters.getArrayPeny;
            },
            arrayOSB() {
                return this.$store.getters.getArrayOSB;
            },
            arrayGP() {
                return this.$store.getters.getArrayGP;
            }
        },
        mounted() {
            this.getBases();
        },
        created() {
            this.setDefaultCurrentDate();

            document.addEventListener('keyup', (e) => {
                if (e.key === 'Escape') {
                    this.selectItem = {};
                }
            });
        },
        methods: {
            getBases() {
                this.isLoading = true;
                axios.get(`/api/bases`)
                    .then(response => {
                        this.bases = response.data.bases;
                    })
                    .catch(e => { this.errorMSG = e.response.data.message; })
                    .finally(() => { this.isLoading = false; });
            },
            setDefaultCurrentDate() {
                Number.prototype.AddZero = function(b,c){
                    let  l= (String(b|| 10).length - String(this).length)+1;
                    return l> 0? new Array(l).join(c|| '0')+this : this;
                };
                //'2020-08-18T10:10'
                const d = new Date();
                this.date = [
                    d.getFullYear(), (d.getMonth() + 1).AddZero(), d.getDate().AddZero()
                    ].join('-') + 'T' + [d.getHours().AddZero(), d.getMinutes().AddZero()].join(':');
            },
            submit() {
                this.$store.dispatch('setArrayGP', []);
                this.$store.dispatch('setArrayOSB', []);
                this.$store.dispatch('setArrayPeny', []);
                this.$store.dispatch('setArrayShtraf', []);
                this.$store.dispatch('setArrayCountError', []);

                this.getGP();
            },
            getGP() {
                this.isLoading = true;
                this.errorMSG = '';
                axios.get(`/api/handler/gp/bd-${ this.base }/division-${ this.division }/date-${ this.date }`)
                    .then(response => {
                        if (response.data.success) {
                            this.$store.dispatch('setArrayGP', response.data.arrayGP);
                        } else {
                            this.errorMSG = response.data.message;
                        }
                    })
                    .catch(e => { this.errorMSG = e.response.data.message; })
                    .finally(() => {
                        this.isLoading = false;
                        this.getOSB();
                    });
            },
            getOSB() {
                this.isLoading = true;
                this.errorMSG = '';
                axios.get(`/api/handler/osb/bd-${ this.base }/division-${ this.division }/date-${ this.date }`)
                    .then(response => {
                        if (response.data.success) {
                            this.$store.dispatch('setArrayOSB', response.data.arrayOSB);
                        } else {
                            this.errorMSG = response.data.message;
                        }
                    })
                    .catch(e => { this.errorMSG = e.response.data.message; })
                    .finally(() => {
                        this.isLoading = false;
                        this.getPeny();
                    });
            },
            getPeny() {
                this.isLoading = true;
                this.errorMSG = '';
                axios.get(`/api/handler/peny/bd-${ this.base }/division-${ this.division }/date-${ this.date }`)
                    .then(response => {
                        if (response.data.success) {
                            this.$store.dispatch('setArrayPeny', response.data.arrayPeny);
                        } else {
                            this.errorMSG = response.data.message;
                        }
                    })
                    .catch(e => { this.errorMSG = e.response.data.message; })
                    .finally(() => {
                        this.isLoading = false;
                        this.getShtraf();
                    });
            },
            getShtraf() {
                this.isLoading = true;
                this.errorMSG = '';
                axios.get(`/api/handler/shtraf/bd-${ this.base }/division-${ this.division }/date-${ this.date }`)
                    .then(response => {
                        if (response.data.success) {
                            this.$store.dispatch('setArrayShtraf', response.data.arrayShtraf);
                        } else {
                            this.errorMSG = response.data.message;
                        }
                    })
                    .catch(e => { this.errorMSG = e.response.data.message; })
                    .finally(() => {
                        this.isLoading = false;
                        this.getCountError();
                    });
            },
            getCountError() {
                this.isLoading = true;
                this.errorMSG = '';
                axios.get(`/api/handler/count-error/bd-${ this.base }/division-${ this.division }/date-${ this.date }`)
                    .then(response => {
                        if (response.data.success) {
                            this.$store.dispatch('setArrayCountError', response.data.arrayCountError);
                        } else {
                            this.errorMSG = response.data.message;
                        }
                    })
                    .catch(e => { this.errorMSG = e.response.data.message; })
                    .finally(() => {
                        this.isLoading = false;
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .table-links{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        font-size: 14px;
        background-color: #4d4f50;
        color: #ffffff;
        border-radius: 4px;
        padding: 10px;

        a{
            margin-bottom: 5px;
            padding: 5px;
        }
        li:after{
            content: '|';
            color: #ffffff;
        }
        li:last-child:after{content: '';}
    }
    .form {
        max-width: 500px;
        text-align: center;
        margin: 10px auto;
    }
    .content-table{
        width: 100%;
        background: #ffffff;
        overflow: auto;
    }
    .error {
        color: #ff5f5f;
        border: solid 1px #ff5f5f;
        padding: 10px;
        text-align: left;
        overflow: hidden;
    }
</style>

<style lang="scss">
    .sectionControl{
        line-height: 50px;
        vertical-align: middle;
        justify-content: center;
        justify-items: center;
        justify-self: center;
        align-content: center;
        align-items: center;
        align-self: center;
    }

    .btn-control {
        color: #fff !important;
        background-color: #76a5d0 !important;
        border-color: #6cace4 !important;
        width: 90px;

        &:hover {
            background-color: #5b8cb1 !important;
            border-color: #9baab9 !important;
        }
        &:focus {
            background-color: #6c9dc1  !important;
            border-color: #4982c2 !important;
            box-shadow: 0 0 0 0.2rem rgb(32 98 156 / 50%)  !important;
        }
    }

    tr {
        cursor: pointer;
        transition: 0.5s;
    }
    tr:hover{
        background-color: #dedede;

    }

    tr.active{
        background: #007bff;
        color: #fff;
    }
</style>
