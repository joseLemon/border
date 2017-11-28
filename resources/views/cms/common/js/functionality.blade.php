<script>
    $(document).ready(function() {
        initReadFiles();
    });

    function initReadFiles() {
        $('.input-file-img').change(readFile);
        $('.input-file-doc').change(readFileDoc);

        $('.img-container .remove-img').click(function () {
            console.log('remove');
            var button = $(this),
                preview = button.closest('.preview'),
                input = preview.next().find('input'),
                check = input.next();

            preview.removeClass('active').find('img').attr('src', '');
            input.val('').data('value', '');
            check.val('removed');
        });


        $('.input-file-cms.document .remove-file').click(function () {
            var button = $(this),
                documentContainer = button.closest('.document'),
                input = documentContainer.find('.input-file-doc'),
                label_text = input.closest('label').find('.label_text'),
                check = input.next();

            documentContainer.removeClass('active');
            label_text.text('Elegir documento');
            input.removeClass('loaded-file');
            input.val('');
            check.val('removed');
            button.addClass('hidden');
        });
    }

    function readFile() {
        if (this.files && this.files[0]) {

            var FR = new FileReader(),
                input = $(this),
                preview = input.closest('.img_upload_container').find('.preview'),
                previewImg = preview.find('img');

            FR.addEventListener("load", function (e) {
                previewImg.attr('src',e.target.result);
            });

            FR.readAsDataURL(this.files[0]);

            preview.addClass('active');

            input.data('value', '');
        }
    }

    function readFileDoc() {
        var input = $(this),
            label_text = input.closest('label').find('.label_text'),
            documentContainer = input.closest('.input-file-cms.document'),
            removeBtn = documentContainer.find('.remove-file').removeClass('hidden');
        if (this.files && this.files[0]) {

            var FR = new FileReader();

            FR.addEventListener("load", function (e) {
                if(input.val() != '') {
                    input.addClass('loaded-file');
                    label_text.text(input.val().split('\\').pop());
                } else {
                }
            });

            FR.readAsDataURL(this.files[0]);

            documentContainer.addClass('active');
        } else {
            label_text.text('Elegir documento');
            input.removeClass('loaded-file');
            documentContainer.removeClass('active');
            removeBtn.addClass('hidden');
        }
    }
</script>