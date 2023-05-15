<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem to="/projects">Projects</BreadcrumbItem>
                <BreadcrumbItem>Add Project</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Form>
                <Row :gutter="24">
                    <Col span="12">
                        <FormItem
                            label="Title"
                            :error="errorMessages.title"
                            :required="true"
                        >
                            <Input
                                type="text"
                                placeholder="Title"
                                v-model="formValue.title"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem
                            label="Subtitle"
                            :error="errorMessages.subtitle"
                            :required="true"
                        >
                            <Input
                                type="text"
                                placeholder="Subtitle"
                                v-model="formValue.subtitle"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem
                            label="Project Name"
                            :error="errorMessages.projectName"
                            :required="true"
                        >
                            <Input
                                type="text"
                                placeholder="Project Name"
                                v-model="formValue.projectName"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem label="Clients">
                            <Input
                                type="text"
                                placeholder="clients"
                                v-model="formValue.clients"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="24">
                        <h4 style="margin-bottom: 10px">Description</h4>
                    </Col>
                    <Col span="24">
                        <div class="quil-editor" style="min-height: 150px">
                            <quill-editor
                                ref="myQuillEditor"
                                v-model="formValue.description"
                                :autosize="{ minRows: 15, maxRows: 20 }"
                                :options="editorOption"
                                @change="onEditorChange($event)"
                            ></quill-editor>
                        </div>
                    </Col>

                    <Col span="12">
                        <FormItem label="Duration">
                            <Input
                                type="text"
                                placeholder="Duration"
                                v-model="formValue.duration"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem label="Date">
                            <DatePicker
                                type="date"
                                v-model="formValue.date"
                                placeholder="Date"
                                class="d-block"
                            ></DatePicker>
                        </FormItem>
                    </Col>
                    <Col span="24">
                        <div class="demo-upload-list" v-if="formValue.image">
                            <img :src="`${http + formValue.image}`" />
                            <div class="demo-upload-list-cover">
                                <Icon
                                    type="ios-trash-outline"
                                    @click.native="handleRemove"
                                ></Icon>
                                <Icon
                                    type="ios-trash-outline"
                                    @click.native="
                                        handleView(`${http + formValue.image}`)
                                    "
                                ></Icon>
                            </div>
                        </div>

                        <div class="mt-3 mb-3" v-else-if="!formValue.image">
                            <Upload
                                ref="formValueUploads"
                                type="drag"
                                :headers="crfObj"
                                :on-success="handleSuccess"
                                :format="['jpg', 'jpeg', 'png']"
                                :max-size="20048"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/app/upload"
                                class="upload"
                            >
                                <div class="camera-icon">
                                    <Icon type="ios-camera" size="20"></Icon>
                                    Upload Image
                                </div>
                            </Upload>
                        </div>
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
                        <Button @click="$router.push('/projects')"
                            >Cancel</Button
                        >
                    </Col>
                </Row>
            </Form>
        </div>
        <Modal title="View Image" v-model="visible">
            <img :src="modalImageUrl" v-if="visible" style="width: 100%" />
        </Modal>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            sending: false,
            formValue: {
                image: "",
                title: "",
                subtitle: "",
                description: "",
                projectName: "",
                clients: "",
                duration: "",
                date: "",
            },
            errorMessages: {
                title: "",
                subtitle: "",
                projectName: "",
            },
            editorOption: {},
            http: "http://127.0.0.1:8000/attachments/",
            modalImageUrl: "",
            visible: false,
        };
    },
    methods: {
        handleView(item) {
            this.modalImageUrl = item;
            this.visible = true;
        },
        handleSuccess(res, file) {
            res = `${res}`;
            this.formValue.image = res;
        },
        handleError(res, file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc: `${
                    file.errors.file.length
                        ? file.errors.file[0]
                        : "Something went wrong!"
                }`,
            });
        },
        handleFormatError(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select jpg or png.",
            });
        },
        handleMaxSize(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },
        async handleRemove() {
            let name;
            name = this.formValue.image;
            this.formValue.image = "";

            const res = await this.callApi("post", "/app/delete_image", {
                imageName: name,
            });
        },
        onEditorChange({ quill, html, text }) {
            this.formValue.description = html;
        },
        async save() {
            let validation = true;

            this.clearErrorMessages();

            if (this.formValue.title.trim() == "") {
                this.errorMessages.title = "Title is required!";
                validation = false;
            }
            if (this.formValue.subtitle.trim() == "") {
                this.errorMessages.subtitle = "Subtitle is required!";
                validation = false;
            }
            if (this.formValue.projectName.trim() == "") {
                this.errorMessages.projectName = "Project Name is required!";
                validation = false;
            }
            if (validation == false)
                return this.$Message.error("Validation Fail!");

            this.loading = true;
            const res = await this.callApi(
                "post",
                "/app/add_project",
                this.formValue
            );
            if (res.status === 201) {
                this.loading = false;
                this.ss("Added successfully!");
                this.$router.push("/projects");
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
                title: "",
                percentage: "",
            };
        },
    },

    async created() {},
};
</script>
