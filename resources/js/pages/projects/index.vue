<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem>Projects</BreadcrumbItem>
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
                                @on-keyup="getProjects"
                            >
                                <Icon type="ios-search" slot="prepend"></Icon>
                            </Input>
                        </FormItem>
                        <FormItem>
                            <Button
                                type="primary"
                                @click="$router.push('/add_project')"
                            >
                                Add Project</Button
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
                        <template slot-scope="{ index }" slot="image">
                            <div class="demo-upload-list">
                                <img :src="`${http + data1[index].image}`" />
                                <div class="demo-upload-list-cover">
                                    <Icon
                                        type="ios-eye-outline"
                                        @click.native="
                                            handleView(
                                                `${http + data1[index].image}`
                                            )
                                        "
                                    ></Icon>
                                </div>
                            </div>
                        </template>
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
        <Modal title="View Image" v-model="visible">
            <img :src="modalImageUrl" v-if="visible" style="width: 100%" />
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
            },
            columns1: [
                {
                    title: "Image",
                    slot: "image",
                    width: 110,
                },
                {
                    title: "Project Name",
                    key: "project_name",
                    width: 110,
                },
                {
                    title: "Title",
                    key: "title",
                    minWidth: 150,
                },
                {
                    title: "Subtitle",
                    key: "title",
                    minWidth: 150,
                },

                {
                    title: "Description",
                    slot: "details",
                    minWidth: 150,
                },

                {
                    title: "Action",
                    key: "action",
                    width: 200,
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
                        name: "Project Name",
                        value: "-----",
                    },
                    {
                        name: "Title",
                        value: "-----",
                    },
                    {
                        name: "Subtitle",
                        value: "-----",
                    },
                    {
                        name: "How To Complete",
                        value: "------",
                    },
                    {
                        name: "Idea Generate",
                        value: "-----",
                    },
                    {
                        name: "Reasearch Sketching",
                        value: "-----",
                    },
                    {
                        name: "Launced Project",
                        value: "------",
                    },
                    {
                        name: "Result Summery",
                        value: "----",
                    },
                    {
                        name: "Description",
                        value: "-----",
                    },
                    {
                        name: "Clients",
                        value: "-----",
                    },

                    {
                        name: "Duration",
                        value: "-----",
                    },
                    {
                        name: "Date",
                        value: "-----",
                    },
                ],
            },
            data1: [],
            modalImageUrl: "",
            visible: false,
            http: "http://127.0.0.1:8000/attachments/",
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
        handleView(item) {
            this.modalImageUrl = item;
            this.visible = true;
        },
        showEdit(index) {
            this.$router.push(`/edit_project/${this.data1[index].id}`);
        },
        showView(index) {
            this.detailsItem.data = [];
            this.detailsItem.title = this.data1[index].type;
            let ob = {
                name: "Project Name",
                value: this.data1[index].project_name,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Title",
                value: this.data1[index].title,
            };
            this.detailsItem.data.push(ob);

            ob = {
                name: "Subtitle",
                value: this.data1[index].subtitle,
            };
            this.detailsItem.data.push(ob);

            ob = {
                name: "How To Complete",
                value: this.data1[index].howToComplete,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Idea Generate",
                value: this.data1[index].ideaGenerate,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Reasearch Sketching",
                value: this.data1[index].reasearchSketching,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Launced Project",
                value: this.data1[index].launcedProject,
            };
            this.detailsItem.data.push(ob);
            ob = {
                name: "Result Summery",
                value: this.data1[index].ResultSummery,
            };
            this.detailsItem.data.push(ob);

            ob = {
                name: "Description",
                value: this.data1[index].description,
            };

            this.detailsItem.data.push(ob);
            ob = {
                name: "Clients",
                value: this.data1[index].clients,
            };

            this.detailsItem.data.push(ob);

            ob = {
                name: "Duration",
                value: this.data1[index].duration,
            };

            this.detailsItem.data.push(ob);
            ob = {
                name: "Date",
                value: this.data1[index].date,
            };

            this.detailsItem.data.push(ob);

            this.viewModal = true;
        },
        showRemove(index) {
            this.UpdateValue.name = this.data1[index].project_name;
            this.UpdateValue.id = this.data1[index].id;
            this.UpdateValue.indexNumber = index;
            this.deleteModal = true;
        },
        async handleRemove() {
            let name;
            name = this.formValue.image;
            this.formValue.image = "";

            const res = await this.callApi("post", "/app/delete_image", {
                imageName: name,
            });
        },
        async remove() {
            this.sending = true;
            let name = this.data1[this.UpdateValue.indexNumber].image;
            const res = await this.callApi("post", "/app/delete_image", {
                imageName: name,
            });
            let ob = {
                id: this.UpdateValue.id,
            };
            const response = await this.callApi(
                "delete",
                `/app/delete_project`,
                ob
            );
            if (response.status == 200) {
                this.s("Great!", "Removed successfully!");
                this.getProjects();
            } else {
                this.e("Oops!", "Something went wrong, please try again!");
            }
            this.deleteModal = false;
            this.sending = false;
        },
        async getProjects() {
            this.loading = true;
            const response = await this.callApi(
                "get",
                `/app/get_project?search=${this.search}`
            );
            if (response.status == 200) {
                this.data1 = response.data;
            } else this.e("Oops!", "Something went wrong, please try again!");
            this.loading = false;
        },
    },

    async created() {
        await this.getProjects();
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
