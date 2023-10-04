<script type="module">
/* v4 */
      import {
        Uppy,
        Dashboard,
        Webcam,
        XHRUpload,
        Tus,
        Form
      } from "https://releases.transloadit.com/uppy/v3.2.1/uppy.min.mjs";

    const uppy = new Uppy({ debug: true, autoProceed: false })
        .use(Dashboard, {  
            inline: true,
            formData:true,
            target: '#drag-drop-area'})
        .use(Form, {
            target: '#formDataExample',
            resultName: 'uppyResult',
            getMetaFromForm: true,
            addResultToForm: true,
            submitOnSuccess: false,
            triggerUploadOnSubmit: true,
        })
        .use(Webcam, { target: Dashboard })
        .use(XHRUpload, {
            endpoint: 'http://localhost/backend/catalogos/upload.php',  
            fieldName: 'files[]', 
            method:'post'
            });

    uppy.on("success", (fileCount) => {
        console.log(`${fileCount} files uploaded`);
    });

</script>
<!-- To support older browsers, you can use the legacy bundle which adds a global `Uppy` object.  -->
<script nomodule src="https://releases.transloadit.com/uppy/v3.2.1/uppy.legacy.min.js">
<script>
    {
        const { Dashboard, Webcam } = Uppy;
        const uppy = new Uppy.Uppy({ debug: true, autoProceed: false })
        .use(Dashboard, { 
                inline: true,
                formData:true,
                height: 470,
                target: '#drag-drop-area'})
        .use(Webcam, { target: Dashboard })
        .use(Uppy.XHRUpload, {
            endpoint: 'http://localhost/backend/catalogos/upload.php',  
            fieldName: 'files[]', 
            method:'post'});
    

         uppy.use(Uppy.Form, {
            target: '#formDataExample',
            resultName: 'uppyResult',
            getMetaFromForm: true,
            addResultToForm: true,
            submitOnSuccess: false,
            triggerUploadOnSubmit: true,
        });

        uppy.on("success", function (fileCount) {
          console.log(`${fileCount} files uploaded`);
        });
    }
