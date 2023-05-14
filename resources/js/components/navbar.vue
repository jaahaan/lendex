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
    z,
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
