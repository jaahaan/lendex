<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem>Service Point</BreadcrumbItem>
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
                                @on-keyup="getSearchCustomer"
                                ><Icon type="ios-search" slot="prepend"></Icon
                            ></Input>
                        </FormItem>

                        <FormItem>
                            <Button
                                type="primary"
                                @click="$router.push('/add_service_point')"
                                >Add Point</Button
                            >
                        </FormItem>
                    </Form>
                </Col>
                <Col :xs="24" :sm="24" :md="24" :lg="24" class="body">
                    <ul>
                        <li class="li tr">
                            <p>No.</p>
                            <p>Title</p>
                            <p>Point</p>
                            <p>Action</p>
                        </li>
                        <draggable
                            :list="data1"
                            @change="log"
                            :disabled="!enabled"
                            class="list-group"
                            ghost-class="ghost"
                            @start="dragging = true"
                            @end="dragging = false"
                        >
                            <li
                                class="li active"
                                v-for="(data, index) in data1"
                            >
                                <p>{{ index + 1 }}</p>
                                <p>{{ data.title.title }}</p>
                                <p>{{ data.point }}</p>
                                <p>
                                    <Button
                                        type="warning"
                                        size="small"
                                        ghost
                                        @click="showEdit(index)"
                                        >Edit</Button
                                    >
                                    <Button
                                        type="error"
                                        size="small"
                                        ghost
                                        @click="showRemove(index)"
                                        >Remove</Button
                                    >
                                </p>
                            </li>
                        </draggable>

                        <li class="li" v-if="data1.length == 0">
                            <h2>Loading...</h2>
                        </li>
                    </ul>
                </Col>
            </Row>
        </div>
        <Modal v-model="deleteModal" width="360">
            <p slot="header" style="color: #f60; text-align: center">
                <Icon type="close"></Icon>
                <span> Delete {{ UpdateValue.name }}</span>
            </p>
            <div>
                <div style="margin-bottom: 20px">
                    Are you sure you want delete {{ UpdateValue.name }}
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
    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    components: {
        name: "simple",
        display: "Simple",
        order: 0,
        draggable,
    },
    data() {
        return {
            enabled: true,
            search: "",
            page: 1,
            pageOption: [5, 10, 20, 50, 100],
            pageSize: 20,
            addModal: false,
            deleteModal: false,
            loading: false,
            sending: false,
            isCollapsed: false,

            UpdateValue: {
                indexNumber: null,
                id: null,
                name: "",
            },

            data1: [],
            newData: [],
            childRouteId: 0,
            parentName: "",
            detailsColum: [
                {
                    title: "-----",
                    key: "name",
                },
                {
                    title: "-----",
                    slot: "value",
                },
            ],
            detailsItem: {
                title: "",
                data: [],
            },
            type: "submenu",
            // sortableList:['submenu','child-submenu','menu'],
            new_list: [],
        };
    },
    computed: {},
    methods: {
        newList() {
            this.new_list = [];
            return this.data1.forEach((data, i) => {
                this.new_list.push(data.order_no);
            });
        },
        onSortChange() {
            // this.type = this.sortData.value
            this.page = 1;
            this.getService();
        },
        log: function (e) {
            this.newData = [];
            this.data1.forEach((data, i) => {
                let obj = {
                    id: data.id,
                    order_no: this.new_list[i],
                };
                this.newData.push(obj);
                // this.newList[i].order=data.id
            });
            this.resetRoutePosition();
        },

        async resetRoutePosition() {
            // return;
            this.data1 = [];
            const response = await this.callApi(
                "put",
                "/app/resetServicePointPosition",
                this.newData
            );
            if (response.status == 200) {
                this.s("Updated Successfully");
                this.getService();
            } else this.swr();
        },

        clearFilters() {
            this.filter = {
                name: "",
                contact: "",
                city: "",
                zone: "",
            };
        },

        getSearchCustomer() {
            this.page = 1;
            this.getService();
        },
        showEdit(index) {
            this.$router.push(`/edit_service_point/${this.data1[index].id}`);
        },
        showRemove(index) {
            this.UpdateValue.name = this.data1[index].point;
            // this.UpdateValue.type=this.data1[index].type
            this.UpdateValue.id = this.data1[index].id;
            this.UpdateValue.indexNumber = index;
            this.deleteModal = true;
        },

        async remove() {
            this.sending = true;
            let ob = {
                id: this.UpdateValue.id,
            };
            const response = await this.callApi(
                "delete",
                `/app/delete_service_point`,
                ob
            );
            if (response.status == 200) {
                this.s("Great!", "Removed successfully!");

                this.deleteModal = false;
                this.UpdateValue.password = "";
                this.getService();
            } else {
                this.e("Oops!", "Something went wrong, please try again!");
            }
            this.sending = false;
        },
        async getService() {
            this.loading = true;
            const response = await this.callApi(
                "get",
                `/app/get_service_point?search=${this.search}`
            );
            if (response.status == 200) {
                this.data1 = response.data;
                // this.prevData = response.data
                this.newList();
                // this.data1=response.data.data;
                // this.pagination=response.data;
            } else this.e("Oops!", "Something went wrong, please try again!");
            this.loading = false;
        },
    },
    async created() {
        await this.getService();
    },
};
</script>

<style scoped>
.tr {
    background-color: rgb(48, 46, 46);
    color: rgb(223, 219, 219);
}
.li {
    list-style-type: none;
    /* width: 100%; */
    display: flex;
    border: 1px solid rgb(85, 82, 82);
    justify-content: space-around;
    align-items: center;
    /* flex:1; */
    gap: 15px;
    text-align: center;
    padding: 5px;
    margin: 8px auto;
}
.li:hover {
    cursor: move;
}
.li p {
    font-size: 16px;
    flex-basis: 180px;
    width: 150px;
    word-break: break-all;
    /* min-width: 150px; */
}
/* .li div{
        margin-right: 0;
        justify-self: flex-end;
    } */
.li p Button {
    margin: 0 3px 2px 0;
}
.li p Button:hover {
    cursor: pointer;
}
.active:active {
    background-color: #021e27 !important;
    color: #fff;
    width: 100%;
    cursor: move;
    border: 1px solid black;
}
</style>
