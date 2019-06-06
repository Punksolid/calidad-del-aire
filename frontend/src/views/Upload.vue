<template>
  <div class="about">
    <el-form ref="form" :model="form" label-width="120px" label-position="top" align="center">
      <el-form-item label="Password">
        <el-input placeholder="Please input password" v-model="password"></el-input>
      </el-form-item>
      <el-form-item label="Formulario de Subida">
        <el-upload
          class="upload-demo w-auto"
          drag
          :action="upload_password_url"
          :file-list="fileList"
          multiple
        >
          <i class="el-icon-upload"></i>
          <div class="el-upload__text">
            Arrastra un archivo o
            <em>haz click en aquí</em>
          </div>
          <div class="el-upload__tip" slot="tip">Se permiten archivos .XML peso menor a los 500kb</div>
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
      password: "",
      upload_url:
        process.env.VUE_APP_BACKEND_URL +
        "/api/v1/registries/upload",
      form: {
        excel: null
      },
      handlePreview: true,
      handleRemove: false,
      fileList: []
    };
  },
  methods: {
    onSubmit() {
      console.log(this.form);
    }
  },
  computed: {
    upload_password_url: function() {
      return this.upload_url + "?password=" + this.password;
    }
  }
};
</script>
