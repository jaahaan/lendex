<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem>Statistics Count</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Row>
                <Col span="24">
                    <Form ref="formInline" inline>
                        <FormItem>
                            <Button
                                type="primary"
                                @click="$router.push('/update_StatisticsCount')"
                            >
                                Update Statistics Count</Button
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
                    title: "Happy Clients",
                    key: "happy_clients",
                    minWidth: 150,
                },
                {
                    title: "Project Complete",
                    key: "project_complete",
                    minWidth: 150,
                },

                {
                    title: "Years of Experience",
                    key: "years_of_experience",
                    minWidth: 150,
                },
            ],

            data1: [],
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
            this.$router.push(
                `/update_StatisticsCount/${this.data1[index].id}`
            );
        },
        showRemove(index) {
            this.UpdateValue.name = this.data1[index].company;
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
                `/app/delete_StatisticsCount`,
                ob
            );
            if (response.status == 200) {
                this.s("Great!", "Removed successfully!");
                this.deleteModal = false;
                this.getStatisticsCount();
            } else {
                this.e("Oops!", "Something went wrong, please try again!");
            }
            this.sending = false;
        },
        async getStatisticsCount() {
            this.loading = true;
            const response = await this.callApi(
                "get",
                `/app/get_StatisticsCount?search=${this.search}`
            );
            if (response.status == 200) {
                this.data1 = response.data;
            } else this.e("Oops!", "Something went wrong, please try again!");
            this.loading = false;
        },
    },

    async created() {
        await this.getStatisticsCount();
    },
};
</script>
<style scoped>
.acStatisticsCount_details_p {
    width: 100%;
    display: inline-block;
    text-align: start;
    font-size: 16px;
    font-weight: 600;
}
</style>
