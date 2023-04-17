<template>
    <div>
        <ul class="header_left_connt">
            <!-- <div class="link">
                <li style="cursor: pointer" @click="openSearchModal">Search</li>
            </div> -->
            <li class="header_left_connt_time">
                <h2>{{ time }}</h2>
                <p>{{ date }}</p>
            </li>

            <li class="header_left_connt_user">
                <div>
                    <Dropdown style="margin-left: 20px">
                        <Icon class="user_icon" type="md-person" />
                        <DropdownMenu slot="list">
                            <DropdownItem
                                ><router-link to="/my_account"
                                    >Account</router-link
                                ></DropdownItem
                            >
                            <DropdownItem
                                ><a href="/logout">Logout</a></DropdownItem
                            >
                        </DropdownMenu>
                    </Dropdown>
                </div>
                <div>
                    <h3>{{ authUser.name }}</h3>
                    <p>{{ authUser.userType }}</p>
                </div>
            </li>
        </ul>

        <Modal
            v-model="searchObject.modal"
            width="700"
            :footer-hide="true"
            :closable="false"
        >
            <div class="central-search">
                <Form ref="formValue" inline>
                    <Row :gutter="24">
                        <Col span="18">
                            <FormItem style="width: 100%">
                                <Select
                                    ref="centralSearch"
                                    :placeholder="
                                        searchObject.type == 'Products'
                                            ? 'Search Products...'
                                            : 'Search Pages...'
                                    "
                                    v-model="searchObject.value"
                                    filterable
                                    clearable
                                    :remote-method="getSearchData"
                                    @on-clear="clearSearch"
                                    @on-change="onSearchChange"
                                >
                                    <template
                                        v-if="searchObject.type == 'Products'"
                                    >
                                        <Option
                                            v-for="(
                                                item, i
                                            ) in searchObject.data"
                                            :value="item.id"
                                            :key="i"
                                        >
                                            <div>
                                                <Row :gutter="24">
                                                    <Col span="24"
                                                        >{{ item.productName }}
                                                        {{ item.model }}</Col
                                                    >
                                                    <Col span="12">{{
                                                        item.variation
                                                            | variationFormat
                                                    }}</Col>
                                                    <Col span="12"
                                                        >Stock:{{
                                                            item.stock
                                                        }}</Col
                                                    >
                                                </Row>
                                                <Divider />
                                            </div>
                                        </Option>
                                    </template>
                                    <template
                                        v-else-if="
                                            searchObject.type != 'Products'
                                        "
                                    >
                                        <Option
                                            v-for="(
                                                item, i
                                            ) in searchObject.data"
                                            :value="item.id"
                                            :key="i"
                                            >{{ item.title }}</Option
                                        >
                                    </template>
                                </Select>
                            </FormItem>
                        </Col>
                        <Col span="6">
                            <FormItem style="width: 100%">
                                <Select
                                    v-model="searchObject.type"
                                    @on-change="clearSearch"
                                >
                                    <Option value="Products">Products</Option>
                                    <Option value="Pages">Pages</Option>
                                </Select>
                            </FormItem>
                        </Col>
                    </Row>
                </Form>
            </div>
        </Modal>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            date: "",
            time: "",

            isSearching: false,
            totalNotification: 0,
            isNotificationMenu: false,

            searchObject: {
                value: "",
                type: "Pages",
                modal: false,
                data: [],
            },
            notiDetails: [],
        };
    },
    computed: {
        ...mapGetters({
            allNotiFalg: "allNotiFalg",
            oneNotiFalg: "oneNotiFalg",
            newOrdersCount: "newOrdersCount",
        }),
    },
    methods: {
        openSearchModal() {
            this.searchObject = {
                value: "",
                type: "Pages",
                modal: true,
                data: [],
            };
        },
        clearSearch() {
            this.searchObject.value = "";
            this.searchObject.data = "";
        },
        onSearchChange() {
            if (this.searchObject.type == "Products") return;
            if (this.searchObject.data.length == 0) return;

            let index = this.searchObject.data.findIndex(
                (d) => d.id == this.searchObject.value
            );
            if (index == -1) return;

            let link = this.searchObject.data[index].path;

            this.$router.push(link);

            this.searchObject.value = "";
            this.searchObject.data = "";
            this.searchObject.modal = false;
            this.$refs.centralSearch.clearSingleSelect();
        },
        async getSearchData(query = "") {
            if (query == "" || this.isSearching == true) return;
            this.isSearching = true;
            const response = await this.callApi(
                "get",
                `/app/central/search?search=${query}&type=${this.searchObject.type}`
            );
            if (response.status == 200) {
                this.searchObject.data = response.data;
            } else this.swr();
            this.isSearching = false;
        },
        async newOrder() {
            const res = await this.callApi("get", `/app/newOrder`);
            if (res.status == 200) {
                this.newOrdertotal = res.data;
            }
        },
        authStoreName() {
            if (!this.authUser && !this.authUser.store_id) return "";
            if (this.authUser && this.authUser.userType == "Admin") return "";
            if (!this.allStores.length) return "";
            let index = this.allStores.findIndex(
                (d) => d.id == this.authUser.store_id
            );
            return this.allStores[index].branch_name;
        },
        openNotiOptionMenu(index) {
            if (!this.isNotiOptionMenu) this.isNotiOptionMenuIndex = index;
            this.isNotiOptionMenu = !this.isNotiOptionMenu;
        },
        closeNotiMenu() {
            this.isNotificationMenu = false;
            this.isNotiOptionMenu = false;
        },
        async openNotiMenu() {
            // this.isNotificationMenu = true
            if (!this.isNotificationMenu) {
                const res = await this.callApi(
                    "get",
                    "/app/getNotiDetails?limit=5"
                );
                if (res.status == 200) {
                    this.notiDetails = res.data;
                } else {
                    this.swr();
                }
            }
            this.isNotificationMenu = !this.isNotificationMenu;
        },

        async deleteNoti(index) {
            // this.isNotificationMenu = true
            const res = await this.callApi("post", "/app/deleteNoti", {
                id: this.notiDetails[index].id,
            });
            if (res.status == 200) {
                this.notiDetails = res.data;
            } else {
                this.swr();
            }
        },
        async updateNoti(index) {
            // this.isNotificationMenu = true
            if (this.notiDetails[index].seen == 1) return;
            const res = await this.callApi("post", "/app/updateNoti?limit=5", {
                id: this.notiDetails[index].id,
            });
            if (res.status == 200) {
                if (this.notiDetails[index].seen == 0) {
                    if (this.total > 0) this.total--;
                }
                this.notiDetails = res.data;
            } else {
                this.swr();
            }
        },
        async updateAllNoti() {
            // this.isNotificationMenu = true
            const res = await this.callApi("post", "/app/updateAllNoti");
            if (res.status == 200) {
                this.total = 0;
                let dd = [];
                for (let d in res.data) {
                    dd.push(res.data[d]);
                    if (d > 5) break;
                }
                this.notiDetails = dd;
            } else {
                this.swr();
            }
        },
        getTime() {
            let date = new Date();
            let hours = date.getHours();
            let minutes = date.getMinutes();

            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            let AmorPm = hours > 12 ? "PM" : "AM";
            if (hours > 12) {
                hours = hours - 12;
            }
            this.time = hours + ":" + minutes + AmorPm;

            setTimeout(() => {
                this.getTime();
            }, 1000);
        },
        getDate() {
            let date = new Date();
            let month = date.getMonth() + 1;
            if (month < 10) {
                month = "0" + month;
            }
            let year = date.getFullYear();
            let day = date.getDate();
            this.date = day + "-" + month + "-" + year;
        },
    },
    created() {
        this.getTime();
        this.getDate();
        // this.newOrder();
    },
};
</script>

<style scoped>
.central-search .ivu-form-item {
    margin-bottom: 0px;
}
.central-search .ivu-divider-horizontal {
    margin: 5px 0;
}

#lblCartCount {
    font-size: 12px;
    background: #000000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px;
}
.badge {
    padding-left: 9px;
    padding-right: 9px;
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
    background-color: #c67605;
}
</style>
