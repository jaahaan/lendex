<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem to="/StatisticsCount"
                    >Statistics Counts</BreadcrumbItem
                >
                <BreadcrumbItem>Edit Statistics Counts</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Form label-position="top">
                <Row :gutter="24">
                    <Col span="12">
                        <FormItem label="Happy Clients">
                            <Input
                                v-model="formValue.happy_clients"
                                type="text"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem label="Project Complete">
                            <Input
                                v-model="formValue.project_complete"
                                type="text"
                            ></Input>
                        </FormItem>
                    </Col>

                    <Col span="12">
                        <FormItem label="Years of Experience">
                            <Input
                                v-model="formValue.years_of_experience"
                                type="text"
                            ></Input>
                        </FormItem>
                    </Col>

                    <Col span="24">
                        <Button
                            type="primary"
                            :loading="loading"
                            @click="save"
                            style="margin-right: 10px"
                        >
                            <span v-if="!loading">Add</span>
                            <span v-else>Please wait...</span>
                        </Button>
                        <Button @click="$router.push('/StatisticsCount')"
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
            formValue: {
                id: 0,
                happy_clients: "",
                project_complete: "",
                years_of_experience: "",
            },
        };
    },
    methods: {
        async save() {
            this.loading = true;
            const res = await this.callApi(
                "put",
                "/app/update_StatisticsCount",
                this.formValue
            );
            if (res.status === 200 || res.status == 201) {
                this.loading = false;
                this.ss("Updated successfully!");
                this.$router.push("/StatisticsCount");
            } else if (this.status == 422) {
                for (let x in response.data) {
                    this.e(response.data[x]);
                }
            } else {
                this.loading = false;
                this.swr();
            }
        },

        async getDetail() {
            this.loading = true;
            const id = 1;
            const response = await this.callApi(
                "get",
                `/app/get_StatisticsCount/${id}`
            );
            if (response.status == 200) {
                this.formValue = response.data;
            } else this.swr();
            this.loading = false;
        },
    },
    async created() {
        await this.getDetail();
    },
};
</script>
