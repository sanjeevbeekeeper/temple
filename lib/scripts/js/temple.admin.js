// This code is for the Profile Picture selection from the Media Uploader Button.
// After the user select the picture, the picture location will be stored in json and output in the value field.
jQuery(document).ready(function($){
    var mediaUploader;
    $('#upload-button').on('click',function(e){
        e.preventDefault();
        if(mediaUploader){
            mediaUploader.open();
            return; // stop the script
            }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture', // Media Library Window title
            button: {
                text: 'Choose Picture' // Media Library blue button title
                },
            multiple: false // user cannot select multiple files and select only one picture, hence false.
            });
        // if the user select the image fire this
        mediaUploader.on('select', function(){
            // after user select the image first element, convert that to json
            attachment = mediaUploader.state().get('selection').first().toJSON();
            // take that attachment and place it in the val.
            $('#hidden_profile_picture').val(attachment.url);
            // this is to upload the image dynamically
            $('#dynamic_profile_picture img').attr('src', attachment.url);
            });
        mediaUploader.open();
        });


    // Profile Picture remove button
    $ ('#remove_picture').on('click', function(e){
        e.preventDefault();
        var answer = confirm("Do you want to Delete the Profile Picture?");
        if (answer == true ){
            $('#hidden_profile_picture').val('');
            $('.temple_form_container').submit();
            }
        return;
        });
    });
