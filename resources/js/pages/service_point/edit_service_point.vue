<template>
    <div class="_content">
        <div>
            <div>
                <Breadcrumb>
                    <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                    <BreadcrumbItem to="/service">Service</BreadcrumbItem>
                    <BreadcrumbItem>Edit Service Point</BreadcrumbItem>
                </Breadcrumb>
            </div>
            <div class="common-page-card">
                <Form>
                    <Row :gutter="16">
                        <Col :xs="24" :sm="24" :md="12" :lg="12">
                            <FormItem label="Parent ID">
                                <Select
                                    v-model="formValue.title_id"
                                    placeholder="Select Title"
                                    filterable
                                    clearable
                                    @on-change="changeParentMenu"
                                >
                                    <Option
                                        v-for="(item, i) in parentMenu"
                                        :value="item.id"
                                        :key="i"
                                        >{{ item.title }}</Option
                                    >
                                </Select>
                            </FormItem>
                        </Col>
                        <Col :xs="24" :sm="24" :md="12" :lg="12">
                            <FormItem
                                :error="errorMessages.point"
                                :required="true"
                                label="Point"
                            >
                                <Input
                                    type="text"
                                    placeholder="Point"
                                    v-model="formValue.point"
                                ></Input>
                            </FormItem>
                        </Col>
                        <Col span="24">
                            <Button
                                type="primary"
                                :loading="loading"
                                @click="update"
                                style="margin-right: 10px"
                            >
                                <span v-if="!loading">Update</span>
                                <span v-else>Please wait...</span>
                            </Button>
                            <Button @click="$router.push('/service')"
                                >Cancel</Button
                            >
                        </Col>
                    </Row>
                </Form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            sending: false,
            parentMenu: [],
            formValue: {
                id: 0,
                title_id: "",
                point: "",
            },
            errorMessages: {
                title_id: "",
                point: "",
            },
        };
    },
    methods: {
        async update() {
            let validation = true;

            this.clearErrorMessages();

            if (this.formValue.point.trim() == "") {
                this.errorMessages.point = "Point is required!";
                validation = false;
            }

            if (validation == false)
                return this.$Message.error("Validation Fail!");

            this.loading = true;
            const res = await this.callApi(
                "put",
                "/app/update_service_point",
                this.formValue
            );
            if (res.status === 200 || res.status == 201) {
                this.loading = false;
                this.ss("Updated successfully!");
                this.$router.push("/service");
            } else if (this.status == 422) {
                for (let x in response.data) {
                    this.e(response.data[x]);
                }
            } else {
                this.loading = false;
                this.swr();
            }
        },
        clearErrorMessages() {
            this.errorMessages = {
                point: "",
            };
        },
        async getDetail() {
            this.loading = true;
            const response = await this.callApi(
                "get",
                `/app/get_service_point/${this.$route.params.id}`
            );
            if (response.status == 200) {
                this.formValue = response.data;
                this.changeParentMenu();
            } else this.swr();
            this.loading = false;
        },
        async changeParentMenu(query) {
            const response = await this.callApi(
                "get",
                `/app/get_service_title`
            );
            if (response.status == 200) {
                this.parentMenu = response.data;
            } else this.swr();
        },
    },
    async created() {
        await this.getDetail();
    },
};
</script>
