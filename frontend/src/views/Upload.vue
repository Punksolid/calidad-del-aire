<template>
    <div class="about">
        <h1>Upload Form</h1>
        <el-form ref="form" :model="form" label-width="120px">
            <el-form-item label="File">
                <el-upload
                    class="upload-demo"
                    drag
                    :action="upload_url"
                    
                    :file-list="fileList"
                    multiple>
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                    <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">Enviar</el-button>
                <el-button>Cancel</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
export default {
    name: "upload_excel",
    data() {
        return {
            upload_url:process.env.VUE_APP_BACKEND_URL + "/api/v1/registries/upload",
            form: {
                excel : null
            },
            handlePreview: true,
            handleRemove: false,
            fileList: []
        }
    },
    methods: {
        onSubmit() {
            console.log(this.form)
        }
    }
};
</script>