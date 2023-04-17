<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem>Service Title</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Row>
                <Col span="24">
                    <Form ref="formInline" inline>
                        <FormItem>
                            <Input
                                type="text"
                                v-model="search"
                                placeholder="Search..."
                                @on-keyup="getServiceTitle"
                            >
                                <Icon type="ios-search" slot="prepend"></Icon>
                            </Input>
                        </FormItem>
                        <FormItem>
                            <Button
                                type="primary"
                                @click="$router.push('/add_service_title')"
                            >
                                Add Service Title</Button
                            >
                        </FormItem>
                    </Form>
                </Col>
                <Col span="24">
                    <Table
                        border
                        :loading="loading"
                        :columns="columns1"
                        :data="data1"
                    >
                        <template slot-scope="{ index }" slot="details">
                            <Button
                                type="warning"
                                size="small"
                                ghost
                                @click="showView(index)"
                                >Show Details</Button
                            >
                        </template>
                        <template slot="loading">
                            <h4 class="table-loading">
                                <i
                                    class="ivu-load-loop ivu-icon ivu-icon-ios-loading"
                                ></i
                                ><span style="margin-left: 10px"
                                    >Loading Data...</span
                                >
                            </h4>
                        </template>
                    </Table>
                </Col>
            </Row>
        </div>

        <Modal v-model="deleteModal" width="360">
            <p slot="header" style="color: #f60; text-align: center">
                <Icon type="close"></Icon>
                <span> Delete {{ UpdateValue.account_name }}</span>
            </p>
            <div>
                <div style="margin-bottom: 20px">
                    Are you sure you want delete {{ UpdateValue.account_name }}
                </div>
                <div>
                    <Form label-position="top">
                        <FormItem
                            label="Please Enter Your Password"
                            :error="UpdateValue.passwordError"
                        >
                            <Input
                                type="password"
                                v-model="UpdateValue.password"
                                placeholder="Password"
                            ></Input>
                        </FormItem>
                    </Form>
                </div>
            </div>
            <div slot="footer">
                <Button
                    type="error"
                    size="large"
                    long
                    :loading="sending"
                    @click="remove"
                >
                    <span v-if="!loading">Delete</span>
                    <span v-else>Deleting...</span>
                </Button>
            </div>
        </Modal>

        <Modal
            v-model="viewModal"
            :title="detailsItem.title"
            :footer-hide="true"
        >
            <div class="_item_details">
                <Table
                    border
                    :columns="detailsColum"
                    :data="detailsItem.data"
                    :show-header="false"
                ></Table>
            </div>
        </Modal>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: "",
            viewModal: false,
            deleteModal: false,
            loading: false,
            sending: false,
            isCollapsed: false,
            UpdateValue: {
                indexNumber: null,
                id: null,
                name: "",
                type: "",
                password: "",
                passwordError: "",
            },
            columns1: [
                {
                    title: "ID",
                    key: "id",
                    width: 110,
                },

                {
                    title: "Title",
                    key: "title",
                    minWidth: 150,
                },

                {
                    title: "Action",
                    key: "action",
                    width: 150,
                    align: "center",
                    render: (h, params) => {
                        return h("div", [
                            h(
                                "Button",
                                {
                                    props: {
                                        type: "warning",
                                        size: "small",
                                        ghost: true,
                                    },
                                    style: {
                                        marginRight: "5px",
                                    },
                                    on: {
                                        click: () => {
                                            this.showEdit(params.index);
                                        },
                                    },
                                },
                                "Edit"
                            ),
                            h(
                                "Button",
                                {
                                    props: {
                                        type: "error",
                                        size: "small",
                                        ghost: true,
                                    },
                                    on: {
                                        click: () => {
                                            this.showRemove(params.index);
                                        },
                                    },
                                },
                                "Delete"
                            ),
                        ]);
                    },
                },
            ],
            detailsColum: [
                {
                    title: "-----",
                    key: "name",
                },
                {
                    title: "-----",
                    key: "value",
                },
            ],
            detailsItem: {
                title: "",
                data: [
                    {
                        name: "Account Type",
                        value: "-----",
                    },
                    {
                        name: "Account Name",
                        value: "-----",
                    },
                    {
                        name: "Account Number",
                        value: "-----",
                    },
                    {
                        name: "Bank Name",
                        value: "------",
                    },
                    {
                        name: "Routing Number",
                        value: "-----",
                    },
                    {
                        name: "Branch Name",
                        value: "-----",
                    },
                    {
                        name: "Gateway StoreName",
                        value: "------",
                    },
                    {
                        name: "gateway_store_id",
                        value: "----",
                    },
                    {
                        name: "Branch Name",
                        value: "-----",
                    },
                    {
                        name: "Opening Balance",
                        value: "-----",
                    },
                ],
            },
            data1: [],
            allStoreList: [],

            accountTypeList: [
                "Cash",
                "Card",
                "Mobile Banking",
                "Bank",
                "Payment Gateway",
            ],
        };
    },
    computed: {
        rotateIcon() {
            return ["menu-icon", this.isCollapsed ? "rotate-icon" : ""];
        },
        menuitemClasses() {
            return ["menu-item", this.isCollapsed ? "collapsed-menu" : ""];
        },
    },
    methods: {
        showEdit(index) {
            this.$router.push(`/edit_service_title/${this.data1[index].id}`);
        },
        showView(index) {
            this.detailsItem.title = this.data1[index].title;
            this.detailsItem.data = [];
            let ob = {
                name: "id",
                value: this.data1[index].id,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Type",
                value: this.data1[index].type,
            };
            this.detailsItem.data.push(ob);

            ob = {
                name: "Name",
                value: this.data1[index].name,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Title",
                value: this.data1[index].title,
            };
            this.detailsItem.data.push(ob);

            ob = {
                name: "Parent ID",
                value: this.data1[index].parent_id,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "path",
                value: this.data1[index].path,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "icon",
                value: this.data1[index].icon,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Active",
                value: this.data1[index].is_show == 1 ? "YES" : "NO",
            };
            this.detailsItem.data.push(ob);

            this.viewModal = true;
        },
        showRemove(index) {
            this.UpdateValue.name = this.data1[index].title;
            // this.UpdateValue.type=this.data1[index].type
            this.UpdateValue.id = this.data1[index].id;
            this.UpdateValue.indexNumber = index;
            this.deleteModal = true;
        },
        async remove() {
            this.UpdateValue.passwordError = "";
            if (
                this.UpdateValue.password == "" ||
                this.UpdateValue.password.trim() == ""
            ) {
                this.UpdateValue.passwordError = "Password is required";
                return;
            }
            this.sending = true;
            let ob = {
                id: this.UpdateValue.id,
                customerName: this.UpdateValue.customerName,
                password: this.UpdateValue.password,
            };
            const response = await this.callApi(
                "delete",
                `/app/delete_router_new/${this.UpdateValue.id}`,
                ob
            );
            if (response.status == 200) {
                this.s("Great!", "Router removed successfully!");
                this.sending = false;
                this.deleteModal = false;
                this.UpdateValue.password = "";
                this.getServiceTitle();
            } else if (response.status == 422) {
                this.sending = false;
                this.UpdateValue.passwordError = response.data.message;
            } else {
                this.sending = false;
                this.deleteModal = false;
                this.e("Oops!", "Something went wrong, please try again!");
            }
        },
        async getServiceTitle() {
            this.loading = true;
            const response = await this.callApi(
                "get",
                `/app/get_service_title?search=${this.search}`
            );
            if (response.status == 200) {
                this.data1 = response.data;
            } else this.e("Oops!", "Something went wrong, please try again!");
            this.loading = false;
        },
    },

    async created() {
        await this.getServiceTitle();
    },
};
</script>
<style scoped>
.account_details_p {
    width: 100%;
    display: inline-block;
    text-align: start;
    font-size: 16px;
    font-weight: 600;
}
</style>
