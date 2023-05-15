<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem to="/service">Service</BreadcrumbItem>
                <BreadcrumbItem>Add Service Point</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Form>
                <Row :gutter="16">
                    <Col :xs="24" :sm="24" :md="12" :lg="12">
                        <FormItem
                            label="Title"
                            :error="errorMessages.title_id"
                            :required="true"
                        >
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
                            @click="addTitle"
                            style="margin-right: 10px"
                        >
                            <span v-if="!loading">Add</span>
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
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            sending: false,
            parentMenu: [],
            formValue: {
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
        async addTitle() {
            let validation = true;

            this.clearErrorMessages();
            if (this.formValue.title_id == "") {
                this.errorMessages.title_id = "Title is required!";
                validation = false;
            }

            if (this.formValue.point.trim() == "") {
                this.errorMessages.point = "Point is required!";
                validation = false;
            }

            if (validation == false)
                return this.$Message.error("Validation Fail!");

            this.loading = true;
            const res = await this.callApi(
                "post",
                "/app/add_service_point",
                this.formValue
            );
            if (res.status === 200 || res.status == 201) {
                this.loading = false;
                this.ss("New Title added successfully!");
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
                title_id: "",
                point: "",
            };
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
        await this.changeParentMenu();
    },
};
</script>
